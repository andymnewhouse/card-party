<?php

namespace App\Http\Controllers;

use App\Deck;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'cards' => (new Deck(2, 'normal-with-jokers'))->cards,
        ]);
    }
}
