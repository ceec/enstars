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
        return $this->hasMany('App\Card')->where('cards.stars', '=', '5');
    }


    /**
     * Get the unit for this boy.
     */
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }


    /**
     * Get the class for this boy.
     */
    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }


    /**
     * Get the unit for this boy.
     */
    public function club()
    {
        return $this->belongsTo('App\Club');
    }


}
