<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class GameType extends Model
{
    use Sushi;

    public $casts = [
        'rounds' => 'array',
    ];

    protected $rows = [
        [
            'id' => 1, 
            'name' => 'progressive', 
            'label' => 'Progressive Rummy', 
            'description' => 'Also known as Liverpool', 
            'min_players' => 3, 
            'max_players' => 8,
            'cards' => 'all',
            'decks' => 'round($players/2)',
            'rounds' => '[{"num_cards":6,"goal":"Two sets of three","goals":[{"cards":[],"min_cards":3,"label":"One set of three"},{"cards":[],"min_cards":3,"label":"One set of three"}]},{"num_cards":7,"goal":"One set of three, One run of four","goals":[{"cards":[],"min_cards":3,"label":"One set of three"},{"cards":[],"min_cards":4,"label":"One run of four"}]},{"num_cards":8,"goal":"Two runs of four","goals":[{"cards":[],"min_cards":4,"label":"One run of four"},{"cards":[],"min_cards":4,"label":"One run of four"}]},{"num_cards":9,"goal":"Three sets of three","goals":[{"cards":[],"min_cards":3,"label":"One set of three"},{"cards":[],"min_cards":3,"label":"One set of three"},{"cards":[],"min_cards":3,"label":"One set of three"}]},{"num_cards":10,"goal":"Two sets of three, One run of four","goals":[{"cards":[],"min_cards":3,"label":"One set of three"},{"cards":[],"min_cards":3,"label":"One set of three"},{"cards":[],"min_cards":4,"label":"One run of four"}]},{"num_cards":11,"goal":"One sets of three, Two runs of four","goals":[{"cards":[],"min_cards":3,"label":"One set of three"},{"cards":[],"min_cards":4,"label":"One run of four"},{"cards":[],"min_cards":4,"label":"One run of four"}]},{"num_cards":12,"goal":"Three runs of four","goals":[{"cards":[],"min_cards":4,"label":"One run of four"},{"cards":[],"min_cards":4,"label":"One run of four"},{"cards":[],"min_cards":4,"label":"One run of four"}]}]',
        ],
    ];
}
