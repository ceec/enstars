<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scout extends Model
{
    
    /**
     * Get the cards for this scout.
     */
    public function cards()
    {
          return $this->hasMany('App\Card');
    }



    /**
     * Get the current scout (main kind not story)
     */
    public static function current()
    {
      $current = Scout::where('active','=','1')->where('type_id','=',1)->first();
      
        // Return the current main type scout, if there is no active scout redirect to the all page.
        if(isset($current->id)) {
            $url = $current->url;
        } else {
            $url = 'all';
        }

		return $url;                     


    }




}
