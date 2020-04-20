<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Player extends Component
{
    public $player;
    public $sort = '';

    public function mount($player)
    {
        $this->player = $player;
    }

    public function render()
    {
        return view('livewire.player', [
            'player' => $this->player,
            'hand' => collect($this->player['hand'])->when($this->sort !== '', function ($items) {
                if ($this->sort === 'asc') {
                    return $items->sortBy('number');
                } else {
                    return $items->sortByDesc('number');
                }
            }),
        ]);
    }

    public function sort($way)
    {
        $this->sort = $way;
    }
}
