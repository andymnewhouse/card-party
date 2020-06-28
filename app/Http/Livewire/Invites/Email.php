<?php

namespace App\Http\Livewire\Invites;

use App\Notifications\JoinGameInvite;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Email extends Component
{
    public $email;
    public $game;
    public $message = "If you haven't played a Card Party game before, please create an account instead of trying to login.\n\nVideo Chat Link:\nhttps://hangouts.google.com/xxxxxx";
    public $recipients;

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
        if ($this->recipients !== null) {
            // dd($this->recipients);
            $input = preg_replace("/((\r?\n)|(\r\n?))/", ',', $this->recipients);
            $emails = explode(',', $input);

            foreach ($emails as $email) {
                if ($this->hasMessageChanged()) {
                    Notification::route('mail', $email)->notify(new JoinGameInvite($this->game, auth()->user(), $this->message));
                } else {
                    Notification::route('mail', $email)->notify(new JoinGameInvite($this->game, auth()->user()));
                }
            }
        } else {
            Notification::route('mail', $this->email)->notify(new JoinGameInvite($this->game, auth()->user()));
        }

        $this->email = null;
        $this->message = "If you haven't played a Card Party game before, please create an account instead of trying to login.\n\nVideo Chat Link:\nhttps://hangouts.google.com/xxxxxx";
        $this->recipients = null;
        $this->emit('notify', ['message' => 'Successfully sent invite.', 'type' => 'success']);
    }

    private function hasMessageChanged()
    {
        return $this->message !== "If you haven't played a Card Party game before, please create an account instead of trying to login.\n\nVideo Chat Link:\nhttps://hangouts.google.com/xxxxxx";
    }
}
