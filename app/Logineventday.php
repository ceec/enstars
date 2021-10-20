<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logineventday extends Model
{

    /**
     * Get the boy
     */
    public function boy()
    {
        return $this->belongsTo('App\Boy');
    }
}
