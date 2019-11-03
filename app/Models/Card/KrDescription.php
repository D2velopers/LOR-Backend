<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;

class KrDescription extends Model
{
    public $incremeting = false;

    public $timestamps = false;

    protected $table = 'kr_description';

    protected $primaryKey = 'card';

    protected $keyType = 'string';

    public function card()
    {
        return $this->belongTo('App\Models\Card\Card', 'card', 'card');
    }

}
