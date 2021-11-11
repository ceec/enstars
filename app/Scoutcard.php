<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scoutcard extends Model
{
    /**
     * Get the cards for this scout.
     */
    public function cards()
    {
        return $this->hasMany('App\Card', 'scoutcards');
    }
}
