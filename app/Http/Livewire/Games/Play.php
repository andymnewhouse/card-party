<?php

namespace App\Http\Livewire\Games;

use App\CardGroup;
use App\Events\GameStarted;
use App\Events\HotCard;
use App\Events\HotCardEnded;
use App\Events\RefreshGame;
use App\Events\RoundFinished;
use App\Events\StartNextRound;
use App\Rules\Run;
use App\Rules\Set;
use Illuminate\Support\Facades\Validator;
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
    }

    public function getListeners()
    {
        return [
            "echo-private:games.{$this->gameId},GameStarted" => 'refreshGame',
            "echo-private:games.{$this->gameId},HotCard" => 'hotCardCalled',
            "echo-private:games.{$this->gameId},HotCardEnded" => 'hotCardEnded',
            "echo-private:games.{$this->gameId},RefreshGame" => 'refreshGame',
            "echo-private:games.{$this->gameId},StartNextRound" => 'refreshPage',
        ];
    }

    public function render()
    {
        if ($this->game->currentRound->has_finished) {
            $this->setRoundFinishedPause();
        }

        return view('livewire.games.play', [
            'activePlayerId' => $this->game->currentRound->activePlayer->id,
            'deck' => $this->game->currentRound->stock->where('location', 'deck'),
            'discard' => $this->game->currentRound->stock->where('location', 'discard')->sortBy('updated_at')->reverse(),
            'editMode' => $this->editMode,
            'finishedTabulating' => $this->game->currentRound->scores !== null,
            'goalsLabel' => $this->game->currentRound->goalsLabel,
            'iHavePlayed' => $this->game->currentRound->cardGroups->pluck('owner_id')->contains(auth()->id()),
            'instructions' => $this->game->currentRound->instructions,
            'myHand' => $this->getMyHand(),
            'needsToDiscard' => $this->game->currentRound->has_pickedup,
            'players' => $this->getPlayersWithCardsInHand($this->game->players),
            'scores' => $this->game->rounds->where('scores', '!=', null),
            'table' => $this->game->currentRound->cardGroups->load('stock', 'owner'),
        ]);
    }

    public function buy()
    {
        $this->game->currentRound->move('discard', 'hand');
        $this->game->currentRound->move('deck', 'hand');
        $this->game->currentRound->move('deck', 'hand');
        event(new RefreshGame($this->game->id, auth()->user()->firstName.' bought.'));
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

    public function discard($id)
    {
        if (! $this->hotCardEditMode) {
            if ($this->game->currentRound->activePlayer->id !== auth()->id()) {
                return $this->notify('error', 'You cannot pickup a card right now, it is not your turn');
            }
            if (! $this->game->currentRound->has_pickedup) {
                return $this->notify('error', 'You cannot discard a card right now, you still need to pick up.');
            }
        }

        $this->game->currentRound->move('hand', 'discard', $id);
        $this->game->currentRound->has_pickedup = false;
        $this->game->currentRound->save();
        if ($this->hotCardEditMode) {
            event(new HotCardEnded($this->game->id, auth()->user()->firstName.' discarded after playing a hot card.'));
            $this->hotCardEndedMode = false;
        } else {
            event(new RefreshGame($this->game->id, auth()->user()->firstName.' discarded.'));
        }
    }

    public function getMyHand()
    {
        $hand = auth()->user()->getHand($this->game->currentRound);

        if ($hand->count() === 0 && $this->game->currentRound->has_finished !== true) {
            event(new RoundFinished($this->game->id, auth()->id()));
            $this->setRoundFinishedPause();
        } elseif (! $this->game->currentRound->has_finished) {
            $hand->sortByDesc('updated_at')->first()->newest = true;
        }

        return $hand;
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

    public function hotCardEnded()
    {
        $this->pauseGame = false;
        $this->pauseGameReason = null;
        $this->refreshGame(['message' => 'Refreshed Game after Hot Card']);
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
                event(new HotCardEnded($this->game->id));
            }
        } else {
            $this->emit('notify', ['message' => 'You cannot move a card right now, it is not your turn', 'type' => 'error']);
        }
    }

    public function notify($type, $message)
    {
        $this->emit('notify', ['message' => $message, 'type' => $type]);
    }

    public function pickup($location)
    {
        if ($this->game->currentRound->activePlayer->id !== auth()->id()) {
            return $this->notify('error', 'You cannot pickup a card right now, it is not your turn.');
        }
        if ($this->game->currentRound->has_pickedup) {
            return $this->notify('error', 'You have already picked up, you need to discard.');
        }

        $this->game->currentRound->move($location, 'hand');
        $this->game->currentRound->has_pickedup = true;
        $this->game->currentRound->save();
        event(new RefreshGame($this->game->id, auth()->user()->firstName.' picked up a card.'));
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
            if (Str::contains($goal['label'], 'set')) {
                $v = Validator::make($goal['cards'], ['cards' => new Set]);
            } else {
                $v = Validator::make($goal['cards'], ['cards' => new Run]);
            }
            if ($v->fails()) {
                $this->emit('notify', ['message' => $v->errors()->messages()['cards'][0], 'type' => 'error']);
                return;
            }
        }

        // Create Card Groups
        foreach ($this->goals as $index => $goal) {
            $type = Str::contains($goal['label'], 'set') ? 'set' : 'run';
            $group = CardGroup::create(['owner_id' => auth()->id(), 'round_id' => $this->game->currentRound->id, 'type' => $type]);

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

    public function refreshGame($params)
    {
        $this->game = $this->game->fresh();
        $this->notify('success', $params['message'] ?? 'Refreshed Game');

        if ($this->game->currentRound->has_finished) {
            $this->setRoundFinishedPause();
        }
    }

    public function refreshPage()
    {
        return redirect()->to($this->game->playLink);
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
        $this->pauseGameReason = 'Round is Over';
    }

    public function sort($newOrder)
    {
        if (is_string($newOrder)) {
            if ($newOrder === 'asc') {
                $sorted = auth()->user()->getHand($this->game->currentRound)->sortBy('smallCard.number');
            } else {
                $sorted = auth()->user()->getHand($this->game->currentRound)->sortByDesc('smallCard.number');
            }

            $newOrder = $sorted->values()->map(function ($item, $key) {
                return [
                    'order' => $key + 1,
                    'value' => $item->id,
                ];
            });
        }

        auth()->user()->reorderHand($this->game->currentRound, $newOrder);
    }

    public function start()
    {
        $this->game->currentRound->has_started = true;
        $this->game->currentRound->save();

        $this->game->currentRound->move('deck', 'discard');

        event(new GameStarted($this->game->id, auth()->user()->firstName));
    }

    public function startNextRound()
    {
        $this->game->startNextRound();
        event(new StartNextRound($this->game->id));
    }

    public function toggleGroup()
    {
        $this->group = ! $this->group;
    }
}
