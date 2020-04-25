<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Card extends Model
{
    use Sushi;

    protected $rows = [
        ['value' => 'two', 'number' => 2, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'two', 'number' => 2, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'two', 'number' => 2, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'two', 'number' => 2, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'three', 'number' => 3, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'three', 'number' => 3, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'three', 'number' => 3, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'three', 'number' => 3, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'four', 'number' => 4, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'four', 'number' => 4, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'four', 'number' => 4, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'four', 'number' => 4, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'five', 'number' => 5, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'five', 'number' => 5, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'five', 'number' => 5, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'five', 'number' => 5, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'six', 'number' => 6, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'six', 'number' => 6, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'six', 'number' => 6, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'six', 'number' => 6, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'seven', 'number' => 7, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'seven', 'number' => 7, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'seven', 'number' => 7, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'seven', 'number' => 7, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'eight', 'number' => 8, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'eight', 'number' => 8, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'eight', 'number' => 8, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'eight', 'number' => 8, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'nine', 'number' => 9, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'nine', 'number' => 9, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'nine', 'number' => 9, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'nine', 'number' => 9, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'ten', 'number' => 10, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'ten', 'number' => 10, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'ten', 'number' => 10, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'ten', 'number' => 10, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'jack', 'number' => 11, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'jack', 'number' => 11, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'jack', 'number' => 11, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'jack', 'number' => 11, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'queen', 'number' => 12, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'queen', 'number' => 12, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'queen', 'number' => 12, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'queen', 'number' => 12, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'king', 'number' => 13, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'king', 'number' => 13, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'king', 'number' => 13, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'king', 'number' => 13, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'ace', 'number' => 14, 'suit' => 'spade', 'type' => 'normal'],
        ['value' => 'ace', 'number' => 14, 'suit' => 'heart', 'type' => 'normal'],
        ['value' => 'ace', 'number' => 14, 'suit' => 'club', 'type' => 'normal'],
        ['value' => 'ace', 'number' => 14, 'suit' => 'diamond', 'type' => 'normal'],
        ['value' => 'joker', 'number' => 1, 'suit' => 'spade', 'type' => 'normal-with-jokers'],
        ['value' => 'joker', 'number' => 1, 'suit' => 'heart', 'type' => 'normal-with-jokers'],
    ];
}
