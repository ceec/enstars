<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usercard extends Model
{
    /**
     * Get the card information
     */
    public function cards()
    {
        return $this->hasMany('App\Card');
    }}
