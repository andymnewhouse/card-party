<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Game extends Model
{
    use Sushi;

    protected $rows = [
        ['name' => 'progressive', 'label' => 'Progressive Rummy', 'description' => 'Also known as Liverpool', 'min_players' => 3, 'max_players' => 8],
    ];
}
