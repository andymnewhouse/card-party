<?php

namespace App\Http\Livewire\Games;

use App\Events\PlayerChosen;
use Livewire\Component;

class Setup extends Component
{
    public $game;
    public $gameId;

    public function mount($game) 
    {
        $this->game = $game;
        $this->gameId = $game->id;
    }

    public function getListeners()
    {
        return [
            "echo-private:games.{$this->gameId},PlayerChosen" => 'refreshGame',
        ];
    }

    public function render()
    {
        return view('livewire.games.setup');
    }

    public function choose($playerIndex) 
    {
        $this->game->users()->syncWithoutDetaching([auth()->id()]);
    
        $player = $this->game->players[$playerIndex];
        $player['user_id'] = auth()->id();
        $players = $this->game->players;
        $players[$playerIndex] = $player;
        
        $this->game->players = $players;
        $this->game->save();

        event(new PlayerChosen($this->game->id));
    }

    public function refreshGame() 
    {
        $this->game = $this->game->fresh();
    }
}
