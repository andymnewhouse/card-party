<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Run implements Rule
{
    public $message;

    public function passes($attribute, $value)
    {
        // Must have at least 4 cards
        if (count($value) < 4) {
            $this->message = 'A run must have at least four cards.';
            return false;
        }

        $value = collect($value);
        // Remove jokers so they don't mess up suit count & missing
        list($jokers, $valueWithOutJokers) = $value->partition(function ($i) {
            return $i->small_card['value'] === 'joker';
        });

        // Must be all same suit
        $uniqueSuits = $valueWithOutJokers->pluck('small_card.suit')->unique();
        if ($uniqueSuits->count() > 1) {
            $this->message = 'All cards in a run must be the same suit.';
            return false;
        }

        $pluckedNumbers = $valueWithOutJokers->pluck('small_card.number', 'small_card.value');
        if ($pluckedNumbers->keys()->contains('ace') && $pluckedNumbers->keys()->contains('two')) {
            $pluckedNumbers['ace'] = 1;
        }

        $orderedValues = range($pluckedNumbers->min(), $pluckedNumbers->max());
        $missing = array_diff($orderedValues, $pluckedNumbers->toArray());

        if ($jokers->count() > 0) {
            $numMissing = $jokers->count() - count($missing);
            $isAre = $numMissing > 1 ? 'are' : 'is';
            $cards = $numMissing > 1 ? 'cards' : 'card';

            $this->message = "There {$isAre} {$numMissing} {$cards} missing from this run.";
            return $jokers->count() >= count($missing);
        } else {
            $numMissing = count($missing);
            $isAre = $numMissing > 1 ? 'are' : 'is';
            $cards = $numMissing > 1 ? 'cards' : 'card';

            $this->message = "There {$isAre} {$numMissing} {$cards} missing from this run.";
            return count($missing) === 0;
        }
    }

    public function message()
    {
        return $this->message ?? 'The validation error message.';
    }
}
