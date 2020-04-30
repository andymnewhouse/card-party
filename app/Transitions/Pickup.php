<?php

namespace App\Transitions;

use App\Http\Livewire\Discard;
use App\States\Hand;
use App\Stock;
use App\User;
use Spatie\ModelStates\Transition;

class Pickup extends Transition
{
    private $stock;

    private $user;

    public function __construct(Stock $stock, User $user)
    {
        $this->stock = $stock;
        $this->user = $user;
    }

    public function handle()
    {
        $this->user->stock()->save($this->stock);
        $this->stock->location = new Hand($this->stock);
        $this->stock->save();

        return $this->stock;
    }
}
