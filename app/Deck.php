<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function cards()
    {
        return $this->belongsTo(Card::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
