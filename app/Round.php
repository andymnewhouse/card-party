<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public $casts = [
        'has_started' => 'boolean',
        'has_finished' => 'boolean',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function activePlayer()
    {
        return $this->belongsTo(User::class, 'active_player_id');
    }
}
