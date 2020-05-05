<?php

namespace App\Http\Livewire\Games;

use App\CardGroup;
use App\Events\GameStarted;
use App\Events\HotCard;
use App\Events\RefreshGame;
use App\Events\RoundFinished;
use Illuminate\Support\Str;
use Livewire\Component;

class Play extends Component
{
    public $allowedHandCount;
    public $editMode = false;
    public $game;
    public $gameId;
    public $goals;
    public $group = false;
    public $hotCardEditMode = false;
    public $pauseGame;
    public $pauseGameReason;
    public $picked = false;
    public $roundOver = false;
    public $selected = [];
    public $selectedCount = 0;
    public $sort = '';
    public $toPlace;

    public function mount($game)
    {
        $this->game = $game->load('players', 'game_type', 'currentRound');
        $this->gameId = $game->id;
        $this->goals = $game->currentRound->goals->toArray();
        $this->allowedHandCount = [
            $game->currentRound->num_cards,
            $game->currentRound->num_cards + 3,
            $game->currentRound->num_cards + 6,
            $game->currentRound->num_cards + 9,
        ];
    }

    public function getListeners()
    {
        return [
            "echo-private:games.{$this->gameId},GameStarted" => 'refreshGame',
            "echo-private:games.{$this->gameId},HotCard" => 'hotCardCalled',
            "echo-private:games.{$this->gameId},RefreshGame" => 'refreshGame',
        ];
    }

    public function render()
    {
        if ($this->game->currentRound->has_finished) {
            $this->setRoundFinishedPause();
        }

        return view('livewire.games.play', [
            'deck' => $this->game->currentRound->stock->where('location', 'deck'),
            'finishedTabulating' => $this->game->currentRound->scores !== null,
            'scores' => $this->game->rounds->where('scores', '!=', null),
            'table' => $this->game->currentRound->cardGroups->load('stock', 'owner'),
            'discard' => $this->game->currentRound->stock->where('location', 'discard')->sortBy('updated_at')->reverse(),
            'instructions' => $this->getInstructions(),
            'myHand' => $this->getMyHand(),
            'needsToDiscard' => $this->getNeedsToDiscard($this->getMyHand()),
            'players' => $this->getPlayersWithCardsInHand($this->game->players),
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
        foreach ($this->goals as $index => $goal) {
            $this->goals[$index]['cards'] = [];
            $this->selected = [];
            $this->toPlace = null;
        }
    }

    public function getInstructions()
    {
        if (! $this->game->currentRound->has_started) {
            return 'Please click the deck to start the game.';
        } else {
            $name = Str::before($this->game->currentRound->activePlayer->name, ' ');
            return "It is {$name}'s Turn.";
        }
    }

    public function getMyHand()
    {
        $hand = $this->game->currentRound->stock()
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
            })
            ->when($this->group, function ($items) {
                return $items->sortBy('smallCard.suit');
            });

        if ($hand->count() === 0 && $this->game->currentRound->has_finished !== true) {
            event(new RoundFinished($this->game->id, auth()->id()));
            $this->setRoundFinishedPause();
        }

        return $hand;
    }

    public function getNeedsToDiscard($hand)
    {
        $hand = count($hand);

        if ($hand > $this->allowedHandCount[0] && $hand < $this->allowedHandCount[1]) {
            return true;
        } elseif ($hand > $this->allowedHandCount[1] && $hand < $this->allowedHandCount[2]) {
            return true;
        } elseif ($hand > $this->allowedHandCount[2]) {
            return true;
        }

        return false;
    }

    public function getPlayersWithCardsInHand($players)
    {
        foreach ($players as $player) {
            $player->cardsInHand = $this->game->currentRound->stock()
            ->where('model_id', $player->id)
            ->where('model_type', 'App\User')
            ->where('location', 'hand')->count();
        }

        return $players;
    }

    public function hotCard()
    {
        event(new HotCard($this->game->id, auth()->id()));

        $this->hotCardEditMode = true;
    }

    public function hotCardCalled($params)
    {
        if ($params['userId'] !== auth()->id()) {
            $this->pauseGame = true;
            $player = $this->game->players->firstWhere('id', $params['userId'])->firstname ?? 'Someone';
            $this->pauseGameReason = "{$player} called hot card";
        }
    }

    public function layDown()
    {
        $this->editMode = true;
    }

    public function move($from, $to, $stockId = null, $groupId = null)
    {
        if ($this->game->currentRound->activePlayer->id === auth()->id()) {
            $group = $this->game->currentRound->cardGroups->firstWhere('id', $groupId);

            if ($stockId === 'selected') {
                $this->game->currentRound->move($from, $to, $this->toPlace->id, $group);
                $this->editMode = false;
            } else {
                $this->game->currentRound->move($from, $to, $stockId, $group);
            }

            event(new RefreshGame($this->game->id));
        } elseif ($this->hotCardEditMode) {
            if ($to === 'table') {
                $group = $this->game->currentRound->cardGroups->firstWhere('id', $groupId);
                $this->game->currentRound->move($from, $to, $stockId, $group);
            } elseif ($to === 'discard') {
                $this->game->currentRound->move($from, $to, $stockId, 'hotcard');
                event(new RefreshGame($this->game->id));
            }
        } else {
            $this->emit('notify', ['message' => 'You cannot move a card right now, it is not your turn', 'type' => 'error']);
        }
    }

    public function place($index)
    {
        if ($this->toPlace !== null) {
            $this->goals[$index]['cards'][] = $this->toPlace;
            $this->toPlace = null;
        }
    }

    public function play()
    {
        // Validate
        foreach ($this->goals as $index => $goal) {
            if ($goal['min_cards'] > count($goal['cards'])) {
                $numMissing = $goal['min_cards'] - count($goal['cards']);
                $cardString = $numMissing === 1 ? 'card' : 'cards';
                $goalNumber = strtolower(numToOrdinalWord($index + 1));

                $this->emit('notify', ['message' => "You need {$numMissing} more {$cardString} to complete the {$goalNumber} goal.", 'type' => 'error']);
                return;
            }
        }

        // Create Card Groups
        foreach ($this->goals as $index => $goal) {
            $group = CardGroup::create(['owner_id' => auth()->id(), 'round_id' => $this->game->currentRound->id]);

            foreach ($goal['cards'] as $card) {
                $this->game->currentRound->move('goal', 'table', $card['id'], $group);
            }
        }

        $this->editMode = false;
        event(new RefreshGame($this->game->id));
    }

    public function playOff()
    {
        $this->editMode = true;
    }

    public function refreshGame()
    {
        $this->game = $this->game->fresh();
        $this->emit('notify', ['message' => 'Refreshed Game', 'type' => 'success']);

        if ($this->game->currentRound->has_finished) {
            $this->setRoundFinishedPause();
        }
    }

    public function selectToPlace($stockId)
    {
        if ($this->toPlace !== null) {
            $this->selectedCount--;
            array_pop($this->selected);
        }

        $this->selectedCount++;
        $this->selected[] = $this->game->currentRound->stock->firstWhere('id', $stockId);
        $this->toPlace = $this->game->currentRound->stock->firstWhere('id', $stockId);
    }

    public function setRoundFinishedPause()
    {
        $this->pauseGame = true;
        $this->roundOver = true;
        $this->pauseGameReason = 'Someone is out.';
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

    public function startNextRound()
    {
        $rounds = $this->game->rounds;
        $currentIndex = 0;

        foreach ($rounds as $index => $round) {
            if ($round->id === $this->game->current_round) {
                $currentIndex = $index;
                continue;
            }
        }

        $this->game->current_round = $rounds[$currentIndex + 1]->id;
        $this->game->save();

        event(new RefreshGame($this->game->id));
    }

    public function toggleGroup()
    {
        $this->group = ! $this->group;
    }
}
