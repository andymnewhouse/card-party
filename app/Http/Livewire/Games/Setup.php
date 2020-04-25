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
        $this->game->users()->syncWithoutDetaching([auth()->id()]);
    
        $player = $this->game->players[$playerIndex];
        $player['user_id'] = auth()->id();
        $players = $this->game->players;
        $players[$playerIndex] = $player;
        
        $this->game->players = $players;
        $this->game->save();
    }
}
