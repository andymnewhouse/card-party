<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Mailcoach\Models\EmailList;

class Settings extends Component
{
    public $allowInvites;
    public $allowRequests;
    public $email;
    public $emailList;
    public $name;
    public $password;
    public $password_confirmation;
    public $subscribed;
    public $user;

    public function mount()
    {
        $this->title = 'My Settings';
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->allowInvites = auth()->user()->allow_invites;
        $this->allowRequests = auth()->user()->allow_requests;
        $this->emailList = EmailList::firstWhere('name', 'Newsletter');
        $this->subscribed = $this->emailList->isSubscribed($this->email);
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
        if ($this->subscribed) {
            $this->emailList->subscribe($this->email);

            $this->emit('notify', ['message' => 'Your email has been successfully added to the newsletter list. Please check your email for the confirmation email.', 'type' => 'success']);
        } else {
            $this->emailList->unsubscribe($this->email);
            $this->emit('notify', ['message' => 'Your email has been successfully removed from the newsletter list.', 'type' => 'success']);
        }

        $this->user->update([
            'allow_invites' => $this->allowInvites,
            'allow_requests' => $this->allowRequests,
        ]);

        $this->emit('notify', ['message' => 'Your notification settings have been successfully updated.', 'type' => 'success']);
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

        $this->emit('notify', ['message' => 'Your password has been successfully updated.', 'type' => 'success']);
    }

    public function updateProfile()
    {
        if ($this->name !== $this->user->name && $this->email !== $this->user->email) {
            $this->user->name = $this->name;
            $this->user->email = $this->email;
            $this->user->email_verified_at = null;
            $this->user->save();
            $this->user->sendEmailVerificationNotification();

            if ($this->subscribed) {
                $this->emailList->unsubscribe($this->user->email);
                $this->emailList->subscribeSkippingConfirmation($this->email);

                $this->emit('notify', ['message' => 'Your email has been successfully updated in the newsletter list.', 'type' => 'success']);
            }

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
