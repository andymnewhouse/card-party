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
        $this->stock->location = new Discard($this->stock);
        $this->stock->model_id = null;
        $this->stock->model_type = null;

        return $this->stock;
    }
}
