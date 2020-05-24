<?php

namespace App;

use App\States\Discard;
use App\States\Hand;
use App\States\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Round extends Model
{
    public $guarded = [];

    public $casts = [
        'goals' => 'collection',
        'has_started' => 'boolean',
        'has_finished' => 'boolean',
        'scores' => 'collection',
    ];

    public function cardGroups()
    {
        return $this->hasMany(CardGroup::class);
    }

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

    public function getGoalsLabelAttribute()
    {
        return $this->goals->implode('label', ', ');
    }

    public function getInstructionsAttribute()
    {
        if (! $this->has_started) {
            return 'Please click the deck to start the game.';
        } else {
            $name = Str::before($this->activePlayer->name, ' ');
            return "It's {$name}'s turn.";
        }
    }

    public function move($from, $to, $stockId = null, $group = null)
    {
        if ($from === 'deck' && $to === 'discard') {
            $this->stock->firstWhere('location', 'deck')->location->transitionTo(Discard::class);
        } elseif ($from === 'deck' && $to === 'hand') {
            $this->stock->firstWhere('location', 'deck')->location->transitionTo(Hand::class, auth()->user());
        } elseif ($from === 'discard' && $to === 'hand') {
            $this->stock->where('location', 'discard')->sortBy('updated_at')->reverse()->first()->location->transitionTo(Hand::class, auth()->user());
        } elseif ($to === 'hand') {
            $this->stock->firstWhere('id', $stockId)->location->transitionTo(Hand::class, auth()->user());
        } elseif ($to === 'discard') {
            $this->stock->firstWhere('id', $stockId)->location->transitionTo(Discard::class, auth()->user());

            if ($group !== 'hotcard') {
                $this->nextPlayer();
            }
        } elseif ($from === 'discard' && $to === 'table') {
            $this->stock->where('location', 'discard')->sortBy('updated_at')->reverse()->first()->location->transitionTo(Table::class, $group);
        } elseif ($to === 'table') {
            $this->stock->firstWhere('id', $stockId)->location->transitionTo(Table::class, $group);
        }
    }

    public function nextPlayer()
    {
        $players = $this->game->players;
        $currentIndex = 0;

        foreach ($players as $index => $player) {
            if ($player->id === $this->active_player_id) {
                $currentIndex = $index;
                continue;
            }
        }

        $this->active_player_id = $players[$currentIndex + 1]->id ?? $players[0]->id;
        $this->save();
    }
}
