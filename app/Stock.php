<?php

namespace App;

use App\States\Deck;
use App\States\Discard;
use App\States\Hand;
use App\States\JokerPile;
use App\States\LocationState;
use App\States\Table;
use App\Transitions\Discarded;
use App\Transitions\Pickup;
use App\Transitions\Play;
use App\Transitions\PlayJoker;
use App\Transitions\ReplaceJoker;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Stock extends Model
{
    use HasStates;

    protected $guarded = [];
    protected $table = 'stock';
    protected $appends = ['small_card'];

    protected function registerStates()
    {
        $this
            ->addState('location', LocationState::class)
            ->allowTransition(Deck::class, Discard::class) // Start Game ✅
            ->allowTransition(Deck::class, Hand::class, Pickup::class) // Pickup ✅
            ->allowTransition(Discard::class, Hand::class, Pickup::class) // Pickup ✅
            ->allowTransition(Discard::class, Table::class, Play::class) // Hot Card
            ->allowTransition(Hand::class, Table::class, Play::class) // Playing
            ->allowTransition(Hand::class, Discard::class, Discarded::class) // Discarding ✅
            ->allowTransition(Table::class, JokerPile::class, ReplaceJoker::class) // Replacing Joker
            ->allowTransition(JokerPile::class, Table::class, PlayJoker::class) // Playing Joker
            ->default(Deck::class);
    }

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function model()
    {
        return $this->morphTo();
    }

    public function getSmallCardAttribute()
    {
        return [
            'value' => $this->card->value,
            'number' => $this->card->number,
            'suit' => $this->card->suit,
        ];
    }
}
