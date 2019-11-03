<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;

class KrType extends Model
{
    public $incremeting = false;

    public $timestamps = false;

    protected $table = 'kr_type';

    protected $primaryKey = 'card';

    protected $keyType = 'string';

    public function card()
    {
        return $this->belongTo('App\Models\Card\Card', 'card', 'card');
    }
}
