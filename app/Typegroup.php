<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typegroup extends Model {
    
    /**
     * Get the event or scount
     */
    public function source()
    {
      //what do i have access to in here? I have things in here in Card right?
      
      if ($this->type == 1) {
        //its an event
        return $this->hasOne('App\Event','id','type_id');
      }

      if ($this->type == 2) {
        //its an event
        return $this->hasOne('App\Scout','id','type_id');
      }      


        //return $this->hasOne('App\Unit');
    } 

}
