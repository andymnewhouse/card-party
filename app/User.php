<?php

namespace App;

use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function games() {
        return $this->belongsToMany(Game::class);
    }

    public function getGravatarAttribute() {
        return Gravatar::get($this->email);
    }
}
