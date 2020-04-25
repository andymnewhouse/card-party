<?php

namespace App\Http\Livewire;

use App\Models\Game;
use App\Models\GameType;
use Livewire\Component;

class GameStart extends Component
{
    public $game = 1;
    public $num_players = 4;

    public function render()
    {
        return view('livewire.game-start', [
            'gameTypes' => GameType::all()
        ]);
    }
}
