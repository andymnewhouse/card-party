<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardGroup extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function stock()
    {
        return $this->morphMany(Stock::class, 'model');
    }
}
