<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardsuggestion extends Model
{
    /**
     * Get the card for this suggestion
     */
    public function card()
    {
        return $this->belongsTo('App\Card', 'acard_id');
    }
}
