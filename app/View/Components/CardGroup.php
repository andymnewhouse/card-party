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
        if ($group->type === 'set') {
            return $group->stock->sortBy('small_card.suit')->sortBy('small_card.number');
        } else {
            list($jokers, $stock) = $group->stock->partition(function ($i) {
                return $i->small_card['value'] === 'joker';
            });

            $cards = $stock->map(function ($item) {
                return $item->small_card;
            })->pluck('number')->toArray();

            $new = collect([]);
            foreach (range(min($cards), max($cards)) as $number) {
                if ($stock->firstWhere('small_card.number', $number) !== null) {
                    $new[] = $stock->firstWhere('small_card.number', $number);
                } else {
                    $new[] = $jokers->pop();
                }
            }

            if ($jokers->count() > 0) {
                $jokers->each(function ($joker) use ($new) {
                    $new->prepend($joker);
                });
            }

            return collect($new);
        }
    }
}
