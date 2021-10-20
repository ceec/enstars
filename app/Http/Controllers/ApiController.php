<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Skill;

class ApiController extends Controller
{

    /**
     * data for event
     *
     * @params $event_id
     * @return \Illuminate\Http\Response
     */
    public function event($event_id)
    {
        if ($event_id == 'all') {
            $event = Event::all();
        } else {
            $event = Event::find($event_id);
        }

        echo json_encode($event);

    }

    /**
     * skills
     *
     * @params $color
     * @return \Illuminate\Http\Response
     */
    public function skill($type)
    {

        $skill = Skill::where('skilltype_id', '=', 1)->where('type', '=', $type)->get();


        echo json_encode($skill);

    }


}
