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
}
