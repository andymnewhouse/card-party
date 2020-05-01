<?php

namespace App\Http\Livewire\Games;

use App\Events\LetsPlay;
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
            "echo-private:games.{$this->gameId},LetsPlay" => 'redirectToPlay',
        ];
    }

    public function render()
    {
        return view('livewire.games.join', [
            'players' => $this->game->players,
        ]);
    }

    public function redirectToPlay()
    {
        return redirect($this->game->playLink);
    }

    public function refreshGame() 
    {
        $this->game = $this->game->fresh();
    }

    public function start()
    {
        $this->game->start();
        event(new LetsPlay($this->game->id));

        return redirect($this->game->playLink);
    }
}
