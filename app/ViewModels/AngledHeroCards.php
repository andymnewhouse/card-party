<?php

namespace App\ViewModels;

use App\Deck;
use Statamic\View\ViewModel;

class AngledHeroCards extends ViewModel
{
    public function data(): array
    {
        return [
            'cards' => view('marketing.partials.cards', [
                'cards' => (new Deck(2, 'normal-with-jokers'))->cards
            ])->render()
        ];
    }
}