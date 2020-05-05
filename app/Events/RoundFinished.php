<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoundFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $gameId;
    public $userId;

    public function __construct($gameId, $userId)
    {
        $this->gameId = $gameId;
        $this->userId = $userId;
    }
}
