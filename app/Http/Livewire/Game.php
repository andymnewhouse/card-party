<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Game extends Component
{
    public $activePlayer;
    public $deck;
    public $discard = [];
    public $game;
    public $players;
    public $turn = 0;

    public function mount($game)
    {
        $this->game = $game->game;
        $this->players = $game->players;
        $this->deck = $game->deck->cards->toArray();
        $this->activePlayer = 0;
    }

    public function render()
    {
        return view('livewire.game', [
            'players' => $this->players
        ]);
    }

    public function pick($type)
    {
        // Get card
        if ($type === 'deck') {
            $card = array_shift($this->deck);
        } else {
            $card = array_shift($this->discard);
        }

        // Add to player's hand
        $this->players[$this->activePlayer]['hand'][] = $card;
    }

    public function discard($cardIndex)
    {
        // Remove from player's hand
        $card = $this->players[$this->activePlayer]['hand'][$cardIndex];
        unset($this->players[$this->activePlayer]['hand'][$cardIndex]);

        // Add to discard pile
        array_unshift($this->discard, $card);

        $this->activePlayer++;
        // Go back to first player
        if (! isset($this->players[$this->activePlayer])) {
            $this->activePlayer = 0;
        }
    }

    public function start()
    {
        // Move top card from deck to discard pile
        $card = array_shift($this->deck);
        array_unshift($this->discard, $card);
        $this->turn++;
    }
}
