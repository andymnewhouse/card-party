<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Deck extends Component
{
    public $deck;

    public function mount($deck)
    {
        $this->deck = $deck;
    }

    public function render()
    {
        return view('livewire.deck');
    }
}
