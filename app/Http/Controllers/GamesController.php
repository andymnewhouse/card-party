<?php

namespace App\Http\Controllers;

use App\Game;
use App\Models\GameType;

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

        $game = new Game($data['game'], $data['players']);
    }
}
