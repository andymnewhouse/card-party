<?php

use App\Game;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('games.{id}', function ($user, $id) {
    return Game::whereId($id)->first()->players->pluck('id')->contains($user->id);
});
