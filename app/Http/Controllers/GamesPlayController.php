<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Vinkla\Hashids\Facades\Hashids;

class GamesPlayController extends Controller
{
    public function __invoke($hash)
    {
        return view('games.play', [
            'game' => Game::find(Hashids::decode($hash))
        ]);
    }
}
