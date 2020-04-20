<?php

namespace App\Http\Controllers;

use App\Models\Game;

class GamesController extends Controller
{
    public function create()
    {
        return view('games.create', [
            'games' => Game::all(),
        ]);
    }
}
