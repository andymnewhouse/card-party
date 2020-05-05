<?php

namespace App\Listeners;

use App\Events\RefreshGame;
use App\Events\RoundFinished;
use App\Game;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TabulateScores implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  RoundFinished  $event
     * @return void
     */
    public function handle(RoundFinished $event)
    {
        $game = Game::find($event->gameId)->load('currentRound.stock.card');
        $leftOver = $game->currentRound->stock
            ->where('model_type', 'App\User')
            ->where('location', 'hand')
            ->groupBy('model_id');

        $scores = [];
        foreach ($leftOver as $userId => $hand) {
            $total = 0;
            foreach ($hand as $stock) {
                if ($stock->card->number == 1) {
                    $total += 25;
                } elseif ($stock->card->number < 10) {
                    $total += 5;
                } elseif ($stock->card->number < 14) {
                    $total += 10;
                } elseif ($stock->card->number == 14) {
                    $total += 15;
                }
            }

            $scores[] = ['user_id' => $userId, 'total' => $total];
        }

        $scores[] = ['user_id' => $event->userId, 'total' => 0];

        $game->currentRound->scores = $scores;
        $game->currentRound->save();

        event(new RefreshGame($game->id));
    }
}
