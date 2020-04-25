<?php

namespace App\Http\Livewire\Games;

use Livewire\Component;

class Setup extends Component
{
    public $game;

    public function mount($game) {
        $this->game = $game;
    }

    public function render()
    {
        return view('livewire.games.setup');
    }

    public function choose($playerIndex) {
        dd(request());
        dd($this->game->players[$playerIndex]);
    }
}
