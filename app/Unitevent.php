<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unitevent extends Model
{

    /**
     * Get the event
     */
    public function unit()
    {
        return $this->hasOne('App\Unit');
    }


    /**
     * Get the unit
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }    

}
