<?php

namespace App\Http\Livewire\Games;

use App\GameType;
use Livewire\Component;

class Start extends Component
{
    public $game = 1;
    public $num_players = 4;

    public function render()
    {
        return view('livewire.games.start', [
            'gameTypes' => GameType::all(),
            'friends' => auth()->user()->friends->sortBy('name')
        ]);
    }
}
