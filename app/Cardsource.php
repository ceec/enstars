<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardsource extends Model
{
    /**
     * Get the cards for this source.
     */
    public function card()
    {
        return $this->hasOne('App\Card', 'id', 'card_id');
    }
}
