<?php

namespace App\Transitions;

use App\States\Discard;
use App\Stock;
use App\User;
use Spatie\ModelStates\Transition;

class Discarded extends Transition
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
        $this->stock->model()->dissociate($this->user);
        $this->stock->location = new Discard($this->stock);
        $this->stock->save();

        return $this->stock;
    }
}
