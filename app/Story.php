<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'stories';

    /**
     * Get the event for this story.
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
