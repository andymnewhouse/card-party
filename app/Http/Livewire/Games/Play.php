<?php

namespace App\Http\Livewire\Games;

use App\Events\GameStarted;
use App\Events\RefreshGame;
use App\States\Discard;
use App\States\Hand;
use Illuminate\Support\Str;
use Livewire\Component;

class Play extends Component
{
    public $editMode = false;
    public $game;
    public $gameId;
    public $goals;
    public $picked = false;
    public $selected;
    public $sort = '';

    public function mount($game)
    {
        $this->game = $game->load('players', 'game_type', 'currentRound');
        $this->gameId = $game->id;
        $this->goals = $game->currentRound->goals->toArray();
    }

    public function getListeners()
    {
        return [
            "echo-private:games.{$this->gameId},RefreshGame" => 'refreshGame',
            "echo-private:games.{$this->gameId},GameStarted" => 'refreshGame',
        ];
    }

    public function render()
    {
        return view('livewire.games.play', [
            'deck' => $this->game->currentRound->stock->where('location', 'deck'),
            'table' => $this->game->currentRound->stock->where('location', 'table'),
            'discard' => $this->game->currentRound->stock->where('location', 'discard')->sortBy('updated_at')->reverse(),
            'instructions' => $this->getInstructions(),
            'myHand' => $this->getMyHand(),
            'mySelected' => $this->getMySelected(),
            'players' => $this->game->players,
            'activePlayerId' => $this->game->currentRound->activePlayer->id,
        ]);
    }

    public function buy()
    {
        $this->game->currentRound->move('discard', 'hand');
        $this->game->currentRound->move('deck', 'hand');
        $this->game->currentRound->move('deck', 'hand');
        event(new RefreshGame($this->game->id));
    }

    public function getMyHand()
    {
        return $this->game->currentRound->stock()
            ->where('model_id', auth()->id())
            ->where('model_type', 'App\User')
            ->where('location', 'hand')
            ->with('card')
            ->get()
            ->map(function($stock) {
                $card = $stock->card;
                $card->stock_id = $stock->id;
                return $card;
            })
            ->when($this->sort !== '', function ($items) {
                if ($this->sort === 'asc') {
                    return $items->sortBy('number');
                } else {
                    return $items->sortByDesc('number');
                }
            });
    }

    public function getInstructions() 
    {
        if(!$this->game->currentRound->has_started) {
            return 'Please click the deck to start the game.';
        } else {
            $name = Str::before($this->game->currentRound->activePlayer->name, ' ');
            return "It is {$name}'s Turn.";
        }
    }

    public function layDown()
    {
        $this->editMode = true;
    }

    public function move($from, $to, $stockId = null)
    {
        if($this->game->currentRound->activePlayer->id === auth()->id()) {
            $this->game->currentRound->move($from, $to, $stockId);

            event(new RefreshGame($this->game->id));
        } else {
            dd('You are not the active player');
        }
    }

    public function place($index)
    {
        if($this->selected !== null) {
            $this->goals[$index]['cards'][] = $this->selected;
            $this->selected = null;
        }
    }

    public function refreshGame() 
    {
        $this->game = $this->game->fresh();
    }

    public function select($stockId)
    {
        $this->selected = $this->game->currentRound->stock->firstWhere('id', $stockId);
    }

    public function sort($way)
    {
        $this->sort = $way;
    }

    public function start()
    {
        $this->game->currentRound->has_started = true;
        $this->game->currentRound->save();

        $this->game->currentRound->move('deck', 'discard');

        event(new GameStarted($this->game->id));
    }
}
