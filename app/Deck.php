<?php

namespace App;

use App\Models\Card;
use Illuminate\Support\Collection;

class Deck
{
    public $cards;

    public function __construct($decks = 1, $type = 'normal')
    {
        $this->cards = Collection::times($decks, function ($number) use ($type) {
            return $this->getDeckByType($type);
        })->flatten()->shuffle();
    }

    public function getDeckByType($type)
    {
        if ($type === 'normal') {
            return Card::whereType('normal')->get();
        } elseif ($type === 'normal-with-jokers') {
            return Card::all();
        }
    }
}
