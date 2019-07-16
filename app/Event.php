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

        // Return the current event, if there is no active event redirect to the all page.
        if(isset($current->id)) {
            $url = $current->url;
        } else {
            $url = 'all';
        }

		return $url;      
    }


    /**
     * Get the cards for this event.
     */
    public function cards()
    {
        return $this->hasMany('App\Card');
    }


}
