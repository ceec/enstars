<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    /**
     * Get the user for the feature
     */
    public function user()
    {
        return $this->belongsTo('App\User','submitted_by');
    }
}
