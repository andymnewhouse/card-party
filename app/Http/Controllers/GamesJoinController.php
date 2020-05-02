<?php

namespace App\Http\Controllers;

use App\Events\PlayerJoined;
use App\Game;
use Vinkla\Hashids\Facades\Hashids;

class GamesJoinController extends Controller
{
    public function __invoke($hash)
    {
        $game = Game::find(Hashids::decode($hash)[0])->load('players', 'game_type');

        if(!$game->players->pluck('id')->contains(auth()->id())) {
            $game->players()->attach(auth()->user());
            $game->refresh();

            event(new PlayerJoined($game->id));
        }

        return view('games.join', [
            'game' => $game,
        ]);
    }
}
