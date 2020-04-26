<?php

namespace App\Http\Controllers;

use App\Game;

class GamesController extends Controller
{
    public function create()
    {
        return view('games.create');
    }

    public function store() {
        $data = request()->validate([
            'game' => 'required',
            'players' => 'required'
        ]);

        $game = Game::start($data['game'], $data['players']);

        return redirect($game->playLink);
    }
}
