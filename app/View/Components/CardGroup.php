<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardGroup extends Component
{
    public $cards;
    public $owner;

    public function __construct($group)
    {
        $this->cards = $this->order($group);
        $this->owner = $group->owner;
    }

    public function render()
    {
        return view('components.card-group');
    }

    public function order($group)
    {
        return $group->stock->sortBy('order');
    }
}
