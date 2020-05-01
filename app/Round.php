<?php

namespace App;

use App\States\Discard;
use App\States\Hand;
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

    public function move($from, $to, $stockId = null)
    {
        if($from === 'deck' && $to === 'discard') {
            $this->stock->firstWhere('location', 'deck')->location->transitionTo(Discard::class);
        } else if($from === 'deck' && $to === 'hand') {
            $this->stock->firstWhere('location', 'deck')->location->transitionTo(Hand::class, auth()->user());
        } else if($from === 'discard' && $to === 'hand') {
            $this->stock->where('location', 'discard')->sortBy('updated_at')->reverse()->first()->location->transitionTo(Hand::class, auth()->user());
        } else if($to === 'hand') {
            $this->stock->firstWhere('id', $stockId)->location->transitionTo(Hand::class, auth()->user());
        } else if($to === 'discard') {
            $this->stock->firstWhere('id', $stockId)->location->transitionTo(Discard::class, auth()->user());
            $this->nextPlayer();
        }
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
