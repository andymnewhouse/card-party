<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $notifications = [];

    protected $listeners = ['notify', 'dismiss'];

    public function dismiss($key)
    {
        unset($this->notifications[$key]);
        $this->notifications = array_values($this->notifications);
    }

    public function notify($notification)
    {
        $this->notifications[] = $notification;
    }

    public function render()
    {
        if (session('resent')) {
            $this->notify(['message' => 'Verification email sent.', 'type' => 'success']);
        } elseif(session('success')) {
            $this->notify(['message' => session('success'), 'type' => 'success']);
        }

        return view('livewire.notifications');
    }
}
