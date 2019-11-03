<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    public $incremeting = false;

    public $timestamps = false;

    protected $primaryKey = 'keyword';

    protected $keyType = 'string';

    public function users()
    {
        return $this->belongsToMany('App\Models\Card\User')->using('App\Models\Card\CardKeyword');
    }
}
