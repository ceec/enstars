<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minievent extends Model
{
    /**
     * Get the figure information
     */
    public function choices()
    {
        return $this->hasMany('App\Minieventchoice');
    }
}
