<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameStarted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $gameId;
    public $message;

    public function __construct($gameId, $firstName)
    {
        $this->gameId = $gameId;
        $this->message = $firstName.' flipped over the top card to start the game.';
    }

    public function broadcastOn()
    {
        return new PrivateChannel('games.'.$this->gameId);
    }
}
