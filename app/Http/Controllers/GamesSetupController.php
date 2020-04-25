<?php

namespace App\Http\Controllers;

use App\Game;
use Vinkla\Hashids\Facades\Hashids;

class GamesSetupController extends Controller
{
    public function __invoke($hash)
    {
        return view('games.setup', [
            'game' => Game::whereId(Hashids::decode($hash))->first(),
        ]);
    }
}
