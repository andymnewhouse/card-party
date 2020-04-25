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
    public $picked = false;

    public function mount($game)
    {
        $this->game = $game->game;
        $this->players = $game->players;
        $this->deck = $game->deck->cards->toArray();
        $this->activePlayer = 0;
    }

    public function pick($type)
    {
        if($this->picked === true) {
            return 'You already picked a card!';
        }

        // Get card
        if ($type === 'deck') {
            $card = array_shift($this->deck);
        } else {
            $card = array_shift($this->discard);
        }

        $this->picked = true;

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

        $this->picked = false;
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

    public function render()
    {
        return view('livewire.game', [
            'instructions' => $this->getInstructions()
        ]);
    }

    public function getInstructions() {
        if($this->turn === 0) {
            return 'Please click the deck to start the game.';
        } else {
            if($this->picked === false) {
                return $this->players[$this->activePlayer]['name'] . "'s turn to pickup";
            }
            return $this->players[$this->activePlayer]['name'] . "'s turn to discard";
        }
    }
}
