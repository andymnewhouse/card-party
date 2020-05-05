<?php

namespace App\Modifiers;

use Statamic\Modifiers\Modifier;

class BardReadTime extends Modifier
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

        $words = empty($string = trim($content)) ? [] : preg_split('~[^\p{L}\p{N}\']+~u', $content);

        return ceil(count($words) / 100);
    }
}
