<?php

namespace App\Http\Controllers;

use App\Game;
use Vinkla\Hashids\Facades\Hashids;

class GamesPlayController extends Controller
{
    public function __invoke($hash)
    {
        return view('games.play', [
            'game' => Game::whereId(Hashids::decode($hash))->first(),
        ]);
    }
}
