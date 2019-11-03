<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Model;

class CardEvalution extends Model
{
    public $incremeting = false;

    public $timestamps = false;

    protected $table = 'card_evalutions';

    protected $primaryKey = 'card';

    protected $keyType = 'string';

    public function card()
    {
        return $this->belongsTo('App\Models\Card\Card', 'card', 'card');
    }
}
