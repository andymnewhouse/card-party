<?php

namespace App\Transitions;

use App\Http\Livewire\Discard;
use App\States\Hand;
use App\Stock;
use App\User;
use Spatie\ModelStates\Transition;

class Discarded extends Transition
{
    private $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function handle()
    {
        $this->stock->state = new Hand($this->stock);
        $this->stock->user_id = null;
        $this->stock->save();

        return $this->stock;
    }
}
