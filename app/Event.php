<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * Get the current event 
     */
    public static function current()
    {
          $current = Event::where('active','=','1')->first();

			return $current->url;      
    }


    /**
     * Get the cards for this event.
     */
    public function cards()
    {
        return $this->hasMany('App\Card');
    }


}
