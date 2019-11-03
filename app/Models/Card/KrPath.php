<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;

class KrPath extends Model
{
    public $incremeting = false;

    public $timestamps = false;

    protected $table = 'kr_path';

    protected $primaryKey = 'card';

    protected $keyType = 'string';

    public function card()
    {
        return $this->belongTo('App\Models\Card\Card', 'card', 'card');
    }
}
