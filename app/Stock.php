<?php

namespace App;

use App\States\Deck;
use App\States\Discard;
use App\States\Hand;
use App\States\Table;
use App\States\LocationState;
use App\Transitions\Discarded;
use App\Transitions\Pickup;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Stock extends Model
{
    use HasStates;

    protected $table = 'stock';

    protected function registerStates()
    {
        $this
            ->addState('location', LocationState::class)
            ->allowTransition(Deck::class, Discard::class) // Start Game
            ->allowTransition(Deck::class, Hand::class, Pickup::class) // Pickup
            ->allowTransition(Discard::class, Hand::class, Pickup::class) // Pickup
            ->allowTransition(Discard::class, Table::class) // Hot Card
            ->allowTransition(Hand::class, Table::class) // Playing
            ->allowTransition(Hand::class, Discard::class, Discarded::class)
            ->allowTransition(Table::class, Hand::class) // Joker Replace (might want to change from table -> table or table -> limbo)
            ->default(Deck::class);
    }

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function cards()
    {
        return $this->belongsTo(Card::class);
    }

    public function model()
    {
        return $this->morphTo();
    }
}
