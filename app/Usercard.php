<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usercard extends Model
{
    /**
     * Get the card information
     */
    public function card()
    {
        return $this->belongsTo('App\Card');
    }


    /**
     * Get the 5 stars
     */
    public function cardFiveStars()
    {
        //WHY IS THIS SO HARD
        //$test = $this->card;

        return 'test worked';


        //return $this->belongsTo('App\Card');
    }


}


