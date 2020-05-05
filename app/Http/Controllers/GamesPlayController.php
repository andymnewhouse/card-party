<?php

namespace App\Http\Controllers;

use App\Game;
use Vinkla\Hashids\Facades\Hashids;

class GamesPlayController extends Controller
{
    public function __invoke($hash)
    {
        $game = Game::whereId(Hashids::decode($hash))->first();

        if ($game->rounds->isEmpty()) {
            return redirect(route('games.join', $hash));
        }

        return view('games.play', [
            'game' => $game,
        ]);
    }
}
