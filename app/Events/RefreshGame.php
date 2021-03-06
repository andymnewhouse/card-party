<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RefreshGame implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $gameId;
    public $message;

    public function __construct($gameId, $message = null)
    {
        $this->gameId = $gameId;
        $this->message = $message ?? 'Refreshed Game';
    }

    public function broadcastOn()
    {
        return new PrivateChannel('games.'.$this->gameId);
    }
}
