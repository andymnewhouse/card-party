<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Set implements Rule
{
    public $message;

    public function passes($attribute, $value)
    {
        $hasAtLeastThree = count($value) >= 3;

        $uniqueValues = collect($value)->pluck('small_card.value')->unique();
        if ($uniqueValues->count() === 2 && $uniqueValues->contains('joker') && $hasAtLeastThree) {
            return true;
        } elseif (! $hasAtLeastThree) {
            $this->message = 'A set must have at least three cards.';
        } elseif ($uniqueValues->count() !== 1) {
            $this->message = 'A set must have three cards of the same number.';
        }
        return count($value) >= 3 && $uniqueValues->count() === 1;
    }

    public function message()
    {
        return $this->message ?? 'The validation error message.';
    }
}
