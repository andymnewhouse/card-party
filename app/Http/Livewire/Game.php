<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Game extends Component
{
    public $deck;
    public $discard = [];
    public $game;
    public $players;

    public function mount($game)
    {
        $this->game = $game->game;
        $this->players = $game->players;
        $this->deck = $game->deck->cards->toArray();
    }

    public function render()
    {
        return view('livewire.game');
    }

    public function pick($type)
    {
        if ($type === 'deck') {
            $card = array_shift($this->deck);
            array_unshift($this->discard, $card);
        } else {
            dd($type);
        }
    }
}
