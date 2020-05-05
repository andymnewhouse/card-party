<?php

namespace App\Modifiers;

use Statamic\Modifiers\Modifier;

class Total extends Modifier
{
    public function index($value, $params, $context)
    {
        $total = $value->pluck('amount')->sum(function ($amount) {
            return $amount->value();
        });
        return $total;
    }
}
