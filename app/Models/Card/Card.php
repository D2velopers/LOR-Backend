<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected $primaryKey = 'card';

    public function enPath()
    {
        return $this->hasOne('App\Models\Card\enPath','card','card');
    }

    public function cardEvalutions()
    {
        return $this->hasMany('App\Models\Card\CardEvalution','card','card');
    }

    public function krCardMeta()
    {
        return $this->hasOne('App\Models\Card\KrCardMeta','card','card');
    }
}
