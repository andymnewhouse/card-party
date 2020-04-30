<?php

namespace App\Http\Livewire\Games;

use Livewire\Component;

class Join extends Component
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
            "echo-private:games.{$this->gameId},PlayerJoined" => 'refreshGame',
        ];
    }

    public function render()
    {
        return view('livewire.games.join', [
            'players' => $this->game->players,
        ]);
    }

    public function refreshGame() 
    {
        $this->game = $this->game->fresh();
    }

    public function start()
    {
        $this->game->start();

        return redirect($this->game->playLink);
    }
}
