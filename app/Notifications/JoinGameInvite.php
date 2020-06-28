<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JoinGameInvite extends Notification
{
    use Queueable;

    public $game;
    public $message;

    public function __construct($game, $user = null, $message = null)
    {
        $this->game = $game;
        $this->user = $user;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->getSubject())
            ->markdown('mail.join-invite', [
                'url' => $this->game->joinLInk,
                'firstName' => $this->user->firstName ?? 'Someone',
                'message' => $this->message,
            ]);
    }

    private function getSubject()
    {
        if ($this->user) {
            return $this->user->firstName.' invited you to a Card Party!';
        } else {
            return 'You have been invited to a Card Party!';
        }
    }
}
