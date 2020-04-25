<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Vinkla\Hashids\Facades\Hashids;

class GamesSetupController extends Controller
{
    public function __invoke($hash)
    {
        return view('games.setup', [
            'game' => Game::find(Hashids::decode($hash))->first()
        ]);
    }
}
