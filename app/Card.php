<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Card extends Model
{
    use Sushi;

    protected $rows = [
        ['id' => 1, 'value' => 'two', 'number' => 2, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 2, 'value' => 'two', 'number' => 2, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 3, 'value' => 'two', 'number' => 2, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 4, 'value' => 'two', 'number' => 2, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 5, 'value' => 'three', 'number' => 3, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 6, 'value' => 'three', 'number' => 3, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 7, 'value' => 'three', 'number' => 3, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 8, 'value' => 'three', 'number' => 3, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 9, 'value' => 'four', 'number' => 4, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 10, 'value' => 'four', 'number' => 4, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 11, 'value' => 'four', 'number' => 4, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 12, 'value' => 'four', 'number' => 4, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 13, 'value' => 'five', 'number' => 5, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 14, 'value' => 'five', 'number' => 5, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 15, 'value' => 'five', 'number' => 5, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 16, 'value' => 'five', 'number' => 5, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 17, 'value' => 'six', 'number' => 6, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 18, 'value' => 'six', 'number' => 6, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 19, 'value' => 'six', 'number' => 6, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 20, 'value' => 'six', 'number' => 6, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 21, 'value' => 'seven', 'number' => 7, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 22, 'value' => 'seven', 'number' => 7, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 23, 'value' => 'seven', 'number' => 7, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 24, 'value' => 'seven', 'number' => 7, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 25, 'value' => 'eight', 'number' => 8, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 26, 'value' => 'eight', 'number' => 8, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 27, 'value' => 'eight', 'number' => 8, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 28, 'value' => 'eight', 'number' => 8, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 29, 'value' => 'nine', 'number' => 9, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 30, 'value' => 'nine', 'number' => 9, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 31, 'value' => 'nine', 'number' => 9, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 32, 'value' => 'nine', 'number' => 9, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 33, 'value' => 'ten', 'number' => 10, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 34, 'value' => 'ten', 'number' => 10, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 35, 'value' => 'ten', 'number' => 10, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 36, 'value' => 'ten', 'number' => 10, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 37, 'value' => 'jack', 'number' => 11, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 38, 'value' => 'jack', 'number' => 11, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 39, 'value' => 'jack', 'number' => 11, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 40, 'value' => 'jack', 'number' => 11, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 41, 'value' => 'queen', 'number' => 12, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 42, 'value' => 'queen', 'number' => 12, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 43, 'value' => 'queen', 'number' => 12, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 44, 'value' => 'queen', 'number' => 12, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 45, 'value' => 'king', 'number' => 13, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 46, 'value' => 'king', 'number' => 13, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 47, 'value' => 'king', 'number' => 13, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 48, 'value' => 'king', 'number' => 13, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 49, 'value' => 'ace', 'number' => 14, 'suit' => 'spade', 'type' => 'normal'],
        ['id' => 50, 'value' => 'ace', 'number' => 14, 'suit' => 'heart', 'type' => 'normal'],
        ['id' => 51, 'value' => 'ace', 'number' => 14, 'suit' => 'club', 'type' => 'normal'],
        ['id' => 52, 'value' => 'ace', 'number' => 14, 'suit' => 'diamond', 'type' => 'normal'],
        ['id' => 53, 'value' => 'joker', 'number' => 1, 'suit' => 'spade', 'type' => 'normal-with-jokers'],
        ['id' => 54, 'value' => 'joker', 'number' => 1, 'suit' => 'heart', 'type' => 'normal-with-jokers'],
    ];
}
