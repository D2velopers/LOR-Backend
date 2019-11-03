<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'deck_id';
    
    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id', 'user_id');
    }
}
