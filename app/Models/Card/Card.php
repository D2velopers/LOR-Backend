<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected $primaryKey = 'card';

    public function krDescription()
    {
        return $this->hasOne('App\Models\Card\KrDescription','card','card');
    }

    public function krType()
    {
        return $this->hasOne('App\Models\Card\KrType','card','card');
    }

    public function krPath()
    {
        return $this->hasOne('App\Models\Card\KrPath','card','card');
    }

    public function enPath()
    {
        return $this->hasOne('App\Models\Card\enPath','card','card');
    }

    public function cardEvalutions()
    {
        return $this->hasMany('App\Models\Card\CardEvalution','card','card');
    }

    public function keywords()
    {
        return $this->belongsToMany('App\Models\Card\Keyword')->using('App\Models\Card\CardKeyword');
    }
}
