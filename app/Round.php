<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public $guarded = [];

    public $casts = [
        'goals' => 'collection',
        'has_started' => 'boolean',
        'has_finished' => 'boolean',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function activePlayer()
    {
        return $this->belongsTo(User::class, 'active_player_id');
    }

    public function nextPlayer()
    {
        $players = $this->game->players;
        $currentIndex = 0;

        foreach($players as $index => $player) {
            if($player->id === $this->active_player_id) {
                $currentIndex = $index;
                continue;
            }
        }

        $this->active_player_id = $players[$currentIndex + 1]->id ?? $players[0]->id;
        $this->save();
    }
}
