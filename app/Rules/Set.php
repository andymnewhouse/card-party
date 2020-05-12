<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Set implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $hasAtLeastThree = count($value) >= 3;

        $uniqueValues = collect($value)->pluck('small_card.value')->unique();
        if ($uniqueValues->count() === 2 && $uniqueValues->contains('joker') && $hasAtLeastThree) {
            return true;
        }
        return count($value) >= 3 && $uniqueValues->count() === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
