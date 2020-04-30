<?php

namespace App\Http\Livewire\Games;

use App\Events\GameStarted;
use App\Events\RefreshGame;
use App\States\Discard;
use App\States\Hand;
use Livewire\Component;

class Play extends Component
{
    public $boxes;
    public $editMode = false;
    public $game;
    public $gameId;
    public $picked = false;
    public $selected;
    public $sort = '';

    public function mount($game)
    {
        $this->game = $game->load('players', 'game_type', 'currentRound');
        $this->gameId = $game->id;
        $this->goals = $game->currentRound->goals;
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
            'discard' => $this->game->currentRound->stock->where('location', 'discard'),
            'instructions' => $this->getInstructions(),
            'my_hand' => $this->getAuthPlayer()
                ->when($this->sort !== '', function ($items) {
                    if ($this->sort === 'asc') {
                        return $items->sortBy('number');
                    } else {
                        return $items->sortByDesc('number');
                    }
                }),
            'players' => $this->game->players,
            'activePlayerId' => $this->game->currentRound->activePlayer->id,
        ]);
    }

    public function getAuthPlayer()
    {
        return $this->game->currentRound->stock()
            ->where('model_id', auth()->id())
            ->where('model_type', 'App\User')
            ->with('card')
            ->get()
            ->map(function($stock) {
                $card = $stock->card;
                $card->stock_id = $stock->id;
                return $card;
            });
    }

    public function getInstructions() 
    {
        if(!$this->game->has_started) {
            return 'Please click the deck to start the game.';
        } else {
            if($this->picked === false) {
                return $this->game->players[$this->game->hands[$this->game->current_hand]['active_player']]['name'] . "'s turn to pickup";
            }
            return $this->game->players[$this->game->hands[$this->game->current_hand]['active_player']]['name'] . "'s turn to discard";
        }
    }

    public function move($from, $to, $stockId = null)
    {
        // if($this->game->currentRound->activePlayer->id === auth()->id()) {
            if($from === 'deck' && $to === 'discard') {
                 $this->game->currentRound->stock->firstWhere('location', 'deck')->location->transitionTo(Discard::class);
            } else if($from === 'deck' && $to === 'hand') {
                $this->game->currentRound->stock->firstWhere('location', 'deck')->location->transitionTo(Hand::class, auth()->user());
            } else if($to === 'hand') {
                $this->game->currentRound->stock->firstWhere('id', $stockId)->location->transitionTo(Hand::class, auth()->user());
            } else if($to === 'discard') {
                $this->game->currentRound->stock->firstWhere('id', $stockId)->location->transitionTo(Discard::class);
                $this->game->currentRound->nextPlayer();
            }
            event(new RefreshGame($this->game->id));
        // } else {
        //     dd('You are not the active player');
        // }
    }

    public function refreshGame() 
    {
        $this->game = $this->game->fresh();
    }

    public function sort($way)
    {
        $this->sort = $way;
    }

    public function start()
    {
        $this->game->currentRound->has_started = true;
        $this->game->currentRound->save();

        $this->move('deck', 'discard');

        event(new GameStarted($this->game->id));
    }
}
