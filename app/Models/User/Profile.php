<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $incrementing = false;

    public $timestamp = false;

    protected $table = 'profile';

    protected $keyType = 'binary';
    
    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongTo('App\Models\User\User', 'user_id', 'user_id');
    }
}
