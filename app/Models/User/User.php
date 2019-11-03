<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model
{

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'binary';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'email', 'name', 'password',
    ];
    
    protected $hidden = [
        'user_id', 'roll_id', 'password',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function($model)
        {   
            $id = str_replace('-','',Str::uuid());
            $model->user_id = hex2bin($id);
        });
    }

    public function decks()
    {
        return $this->hasMany('App\Models\User\Deck', 'user_id', 'user_id');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\User\Profile', 'user_id', 'user_id');
    }

    public function role()
    {
        return $this->belongTo('App\Models\User\Role', 'role_id', 'role_id');
    }
}
