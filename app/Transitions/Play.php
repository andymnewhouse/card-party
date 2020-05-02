<?php

namespace App\Transitions;

use App\CardGroup;
use App\States\Hand;
use App\States\Table;
use App\Stock;
use Spatie\ModelStates\Transition;

class Play extends Transition
{
    private $stock;

    private $group;

    public function __construct(Stock $stock, CardGroup $group)
    {
        $this->stock = $stock;
        $this->group = $group;
    }

    public function handle()
    {
        $this->group->stock()->save($this->stock);
        $this->stock->location = new Table($this->stock);
        $this->stock->save();

        return $this->stock;
    }
}
