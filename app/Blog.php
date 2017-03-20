<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    /**
     * Get the author
     */
    public function author()
    {
          return $this->belongsTo('App\User','updated_by');
    }    

}
