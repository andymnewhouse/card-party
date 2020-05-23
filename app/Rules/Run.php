<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Run implements Rule
{
    public function passes($attribute, $value)
    {
        // Must have at least 4 cards
        if (count($value) < 4) {
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
            return false;
        }

        $pluckedNumbers = $valueWithOutJokers->pluck('small_card.number', 'small_card.value');
        if ($pluckedNumbers->keys()->contains('ace') && $pluckedNumbers->keys()->contains('two')) {
            $pluckedNumbers['ace'] = 1;
        }

        $orderedValues = range($pluckedNumbers->min(), $pluckedNumbers->max());
        $missing = array_diff($orderedValues, $pluckedNumbers->toArray());

        if ($jokers->count() > 0) {
            return $jokers->count() >= count($missing);
        } else {
            return count($missing) === 0;
        }
    }

    public function message()
    {
        return 'The validation error message.';
    }
}
