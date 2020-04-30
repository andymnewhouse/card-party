<?php

namespace App\Http\Livewire\Games;

use App\GameType;
use Livewire\Component;

class Start extends Component
{
    public $game = 1;

    public function render()
    {
        return view('livewire.games.start', [
            'gameTypes' => GameType::all(),
        ]);
    }

    public function create()
    {
        $game = auth()->user()->games()->create(['game_type_id' => $this->game, 'owner_id' => auth()->id()]);

        return redirect()->to($game->joinLink);
    }
}
