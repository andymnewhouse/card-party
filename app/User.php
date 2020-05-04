<?php

namespace App;

use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
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
        'allow_invites' => 'boolean',
        'allow_requests' => 'boolean',
    ];

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friend_user', 'user_id', 'friend_id');
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function stock()
    {
        return $this->morphMany(Stock::class, 'model');
    }

    public function getFirstNameAttribute()
    {
        return Str::before($this->name, ' ');
    }

    public function getGravatarAttribute()
    {
        return Gravatar::get($this->email);
    }

    public function addFriend($friend_id)
    {
        $this->friends()->attach($friend_id);
        $friend = User::find($friend_id);
        $friend->friends()->attach($this->id);
    }

    public function removeFriend($friend_id)
    {
        $this->friends()->detach($friend_id);
        $friend = User::find($friend_id);
        $friend->friends()->detach($this->id);
    }
}
