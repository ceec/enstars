<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boy extends Model
{
    /**
     * Get the cards for this boy.
     */
    public function cards()
    {
        return $this->hasMany('App\Card');
    }


    /**
     * Get the cards for this boy.
     */
    public function fiveStars()
    {
        return $this->hasMany('App\Card')->where('cards.stars','=','5');
    }





   
}
