<?php

namespace App\Listeners;

use App\Events\RefreshGame;
use App\Events\RoundFinished;
use App\Game;

class MarkRoundAsFinished
{
    /**
     * Handle the event.
     *
     * @param  RoundFinished  $event
     * @return void
     */
    public function handle(RoundFinished $event)
    {
        $game = Game::find($event->gameId)->load('currentRound');
        $game->currentRound->has_finished = true;
        $game->currentRound->save();

        event(new RefreshGame($game->id));
    }
}
