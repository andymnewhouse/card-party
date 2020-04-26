<?php

namespace App\Http\Livewire\Games;

use App\Events\Bought;
use App\Events\CardDiscarded;
use App\Events\CardPicked;
use App\Events\GameStarted;
use Illuminate\Support\Arr;
use Livewire\Component;

class Play extends Component
{
    public $game;
    public $gameId;
    public $picked = false;
    public $sort = '';

    public function mount($game)
    {
        $this->game = $game->load('players');
        $this->gameId = $game->id;
    }

    public function getListeners()
    {
        return [
            "echo-private:games.{$this->gameId},Bought" => 'refreshGame',
            "echo-private:games.{$this->gameId},CardDiscarded" => 'refreshGame',
            "echo-private:games.{$this->gameId},CardPicked" => 'refreshGame',
            "echo-private:games.{$this->gameId},GameStarted" => 'refreshGame',
        ];
    }

    public function render()
    {
        $myHand = collect($this->getAuthPlayer())->when($this->sort !== '', function ($items) {
                if ($this->sort === 'asc') {
                    return $items->sortBy('number');
                } else {
                    return $items->sortByDesc('number');
                }
            });
        
        return view('livewire.games.play', [
            'deck' => $this->game->hands[$this->game->current_hand]['deck'],
            'discard' => $this->game->hands[$this->game->current_hand]['discard'],
            'instructions' => $this->getInstructions(),
            'my_hand' => $myHand,
            'players' => $this->game->players,
            'activePlayer' => $this->game->hands[$this->game->current_hand]['active_player'],
        ]);
    }

    public function buy()
    {
        $hands = $this->game->hands;
        $hand = $hands[$this->game->current_hand];

        // Get cards
        $card1 = array_shift($hand['deck']);
        $card2 = array_shift($hand['deck']);
        $card3 = array_shift($hand['discard']);

        // Add to player's hand
        $hand['players'][$this->getAuthIndex()]['hand'][] = $card1;
        $hand['players'][$this->getAuthIndex()]['hand'][] = $card2;
        $hand['players'][$this->getAuthIndex()]['hand'][] = $card3;

        $hands[$this->game->current_hand] = $hand;
        $this->game->hands = $hands;
        $this->game->save();

        event(new Bought($this->gameId));
    }

    public function discard($cardIndex)
    {
        $hands = $this->game->hands;
        $hand = $hands[$this->game->current_hand];
        $activePlayer = $hand['active_player'];
        
        // Remove from player's hand
        $card = $hand['players'][$activePlayer]['hand'][$cardIndex];
        unset($hand['players'][$activePlayer]['hand'][$cardIndex]);

        // Add to discard pile
        array_unshift($hand['discard'], $card);

        $this->picked = false;
        $activePlayer++;
        // Go back to first player
        if (! isset($hand['players'][$activePlayer])) {
            $activePlayer = 0;
        }

        $hand['active_player'] = $activePlayer;
        $hands[$this->game->current_hand] = $hand;

        $this->game->hands = $hands;
        $this->game->save();

        event(new CardDiscarded($this->gameId));
    }

    public function getAuthPlayer()
    {
        return Arr::first(Arr::where($this->game->hands[$this->game->current_hand]['players'], function ($player) {
                return $player['user_id'] === auth()->id();
            }))['hand'];
    }

    public function getAuthIndex()
    {
        return array_key_first(Arr::where($this->game->hands[$this->game->current_hand]['players'], function ($player) {
                return $player['user_id'] === auth()->id();
            }));
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

    public function pick($type)
    {
        if($this->picked === true) {
            return 'You already picked a card!';
        }

        $hands = $this->game->hands;
        $hand = $hands[$this->game->current_hand];

        // Get card
        if ($type === 'deck') {
            $card = array_shift($hand['deck']);
        } else {
            $card = array_shift($hand['discard']);
        }

        $this->picked = true;

        // Add to player's hand
        $hand['players'][$this->game->hands[$this->game->current_hand]['active_player']]['hand'][] = $card;

        $hands[$this->game->current_hand] = $hand;
        $this->game->hands = $hands;
        $this->game->save();

        event(new CardPicked($this->gameId));
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
        $hands = $this->game->hands;
        $hand = $hands[$this->game->current_hand];

        // Move top card from deck to discard pile
        $card = array_shift($hand['deck']);
        array_unshift($hand['discard'], $card);

        $hands[$this->game->current_hand] = $hand;
        $this->game->hands = $hands;

        $this->game->has_started = true;
        $this->game->save();
        
        event(new GameStarted($this->game->id));
    }
}
