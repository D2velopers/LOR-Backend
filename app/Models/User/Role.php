<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'role_id';

    public function users()
    {
        return $this->hasMany('App\Models\User\User','role_id', 'role_id');
    }
}
