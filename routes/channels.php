<?php

use App\Game;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('games.{id}', function ($user, $id) {
    return Game::find($id)->players->includes($user);
});
