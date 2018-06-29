<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model {
    

    /**
     * Get the story
     */
    public function story()
    {
        return $this->belongsTo('App\Story');
    }     

}
