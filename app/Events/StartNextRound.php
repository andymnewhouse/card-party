<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StartNextRound implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $gameId;
    public $message;

    public function __construct($gameId)
    {
        $this->gameId = $gameId;
        $this->message = 'New round started.';
    }

    public function broadcastOn()
    {
        return new PrivateChannel('games.'.$this->gameId);
    }
}
