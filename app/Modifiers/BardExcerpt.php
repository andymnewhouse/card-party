<?php

namespace App\Modifiers;

use Illuminate\Support\Str;
use Statamic\Modifiers\Modifier;

class BardExcerpt extends Modifier
{
    /**
     * Modify a value.
     *
     * @param mixed  $value    The value to be modified
     * @param array  $params   Any parameters used in the modifier
     * @param array  $context  Contextual values
     * @return mixed
     */
    public function index($value, $params, $context)
    {
        $content = '';

        foreach ($value as $item) {
            if ($item['type'] === 'text') {
                $content .= $item['text'];
            }
        }

        return Str::limit(strip_tags($content), 180);
    }
}
