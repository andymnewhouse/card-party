<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Settings extends Component
{
    public $allowInvites;
    public $allowRequests;
    public $email;
    public $name;
    public $password;
    public $password_confirmation;
    public $user;

    public function mount()
    {
        $this->title = 'My Settings';
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->allowInvites = auth()->user()->allow_invites;
        $this->allowRequests = auth()->user()->allow_requests;
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.settings');
    }

    public function deleteAccount()
    {
        auth()->user()->delete();
        auth()->logout();

        return redirect()->to('/');
    }

    public function updateNotifications()
    {
    }

    public function updatePassword()
    {
        $data = $this->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $this->password = null;
        $this->password_confirmation = null;

        $this->user->password = bcrypt($data['password']);
        $this->user->save();
    }

    public function updateProfile()
    {
        if ($this->name !== $this->user->name && $this->email !== $this->user->email) {
            $this->user->name = $this->name;
            $this->user->email = $this->email;
            $this->user->email_verified_at = null;
            $this->user->save();
            $this->user->sendEmailVerificationNotification();

            $this->emit('notify', ['message' => 'Both your name and email were updated. Please check your email to verify the new address.', 'type' => 'success']);
        } elseif ($this->name !== $this->user->name) {
            $this->user->name = $this->name;
            $this->user->save();

            $this->emit('notify', ['message' => 'Your name was successfully updated.', 'type' => 'success']);
        } else {
            $this->user->email = $this->email;
            $this->user->email_verified_at = null;
            $this->user->save();
            $this->user->sendEmailVerificationNotification();

            $this->emit('notify', ['message' => 'Your email was successfully updated. Please check your email to verify the new address.', 'type' => 'success']);
        }
    }
}
