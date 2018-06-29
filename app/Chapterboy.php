<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapterboy extends Model {
    


    /**
     * Get the cards for this boy.
     */
    public function boy()
    {
        return $this->hasOne('App\Boy');
    }


    /**
     * Get the chapters
     */
    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }    

}
