<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Set implements Rule
{
    public function passes($attribute, $value)
    {
        $hasAtLeastThree = count($value) >= 3;

        $uniqueValues = collect($value)->pluck('small_card.value')->unique();
        if ($uniqueValues->count() === 2 && $uniqueValues->contains('joker') && $hasAtLeastThree) {
            return true;
        }
        return count($value) >= 3 && $uniqueValues->count() === 1;
    }

    public function message()
    {
        return 'The validation error message.';
    }
}
