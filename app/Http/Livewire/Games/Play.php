<?php

namespace App\Http\Livewire\Games;

use App\CardGroup;
use App\Events\GameStarted;
use App\Events\RefreshGame;
use Illuminate\Support\Str;
use Livewire\Component;

class Play extends Component
{
    public $editMode = false;
    public $game;
    public $gameId;
    public $goals;
    public $picked = false;
    public $selected = [];
    public $selectedCount = 0;
    public $sort = '';
    public $toPlace;

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
            'table' => $this->game->currentRound->cardGroups->load('stock', 'owner'),
            'discard' => $this->game->currentRound->stock->where('location', 'discard')->sortBy('updated_at')->reverse(),
            'instructions' => $this->getInstructions(),
            'myHand' => $this->getMyHand(),
            'players' => $this->game->players,
            'activePlayerId' => $this->game->currentRound->activePlayer->id,
            'iHavePlayed' => $this->game->currentRound->cardGroups->pluck('owner_id')->contains(auth()->id()),
        ]);
    }

    public function buy()
    {
        $this->game->currentRound->move('discard', 'hand');
        $this->game->currentRound->move('deck', 'hand');
        $this->game->currentRound->move('deck', 'hand');
        event(new RefreshGame($this->game->id));
    }

    public function cancel()
    {
        $this->editMode = false;
        foreach($this->goals as $index => $goal) {
            $this->goals[$index]['cards'] = [];
            $this->selected = [];
            $this->toPlace = null;
        }
    }

    public function getMyHand()
    {
        return $this->game->currentRound->stock()
            ->where('model_id', auth()->id())
            ->where('model_type', 'App\User')
            ->where('location', 'hand')
            ->with('card')
            ->get()
            ->when($this->sort !== '', function ($items) {
                if ($this->sort === 'asc') {
                    return $items->sortBy('smallCard.number');
                } else {
                    return $items->sortByDesc('smallCard.number');
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
        if($this->toPlace !== null) {
            $this->goals[$index]['cards'][] = $this->toPlace;
            $this->toPlace = null;
        }
    }

    public function play()
    {
        // Validate
        foreach($this->goals as $index => $goal) {
            if($goal['min_cards'] > count($goal['cards'])) {
                $numMissing = $goal['min_cards'] - count($goal['cards']);
                $cardString = $numMissing === 1 ? 'card' : 'cards';
                $goalNumber = strtolower(numToOrdinalWord($index + 1));
                dd("You need {$numMissing} more {$cardString} to complete the {$goalNumber} goal.");
            }
        }

        // Create Card Groups
        foreach($this->goals as $index => $goal) {
            $group = CardGroup::create(['owner_id' => auth()->id(), 'round_id' => $this->game->currentRound->id]);

            foreach($goal['cards'] as $card) {
                $this->game->currentRound->move('goal', 'table', $card['id'], $group);
            }
        }

        $this->editMode = false;
        event(new RefreshGame($this->game->id));
    }

    public function refreshGame() 
    {
        $this->game = $this->game->fresh();
    }

    public function selectToPlace($stockId)
    {
        if($this->toPlace !== null) {
            $this->selectedCount--;
            array_pop($this->selected);
        }
        
        $this->selectedCount++;
        $this->selected[] = $this->game->currentRound->stock->firstWhere('id', $stockId);
        $this->toPlace = $this->game->currentRound->stock->firstWhere('id', $stockId);
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
