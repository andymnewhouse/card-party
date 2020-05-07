<?php

namespace App\Http\Livewire\Invites;

use App\Notifications\JoinGameInvite;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Email extends Component
{
    public $email;
    public $game;

    public function mount($game)
    {
        $this->game = $game;
    }

    public function render()
    {
        return view('livewire.invites.email');
    }

    public function send()
    {
        Notification::route('mail', $this->email)->notify(new JoinGameInvite($this->game));
        $this->email = null;
        $this->emit('notify', ['message' => 'Successfully sent invite.', 'type' => 'success']);
    }
}
