<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Boy;
use App\Skill;
use App\Minievent;
use App\Minieventchoice;
use App\Event;

use App\Cardtag;
use App\Tag;
use App\Unit;

use App\Story;
use App\Chapter;
use App\Slide;

use App\Blog;

use Auth;
use DB;

class GraphController extends Controller
{


    /**
     * Line of event borders
     *
     * @return \Illuminate\Http\Response
     */
    public function eventHistory(Request $request)
    {
        //get all the events from the data
        //$events = Eventpoint::select('event_id')->orderBy('event_id')->distinct()->get();
        //get all the events but only the ones that also have points
        //SELECT DISTINCT events.* FROM eventpoints,events WHERE events.id = eventpoints.event_id;
        //SELECT events.* events JOIN eventpoints ON events.id = eventpoints.event_id
        //SELECT DISTINCT events.* FROM events JOIN eventpoints ON events.id = eventpoints.event_id
        //$events = Event::join('eventpoints','events.id','=','eventpoints.event_id')->select(DB::raw('DISTINCT(events.*)'))->get();
        //TODO: fix this I could not get the ORM to be distinct!! 2019-02-12

        //filter the data based on whats passed through

        // $year = $request->year;
        // if ($year != "All") {
        //     $year = preg_replace( '/[^0-9]/', '', $year );
        //     $where = " WHERE SUBSTR(events.start, 1, 4) ='".$year."'";
        //     //dd($year);
        //             $events = DB::select("SELECT DISTINCT events.* FROM events JOIN eventpoints ON events.id = eventpoints.event_id".$where);
        // } else {
        //     $where= "";
        //             $events = DB::select("SELECT DISTINCT events.* FROM events JOIN eventpoints ON events.id = eventpoints.event_id");
        // }

        $boy = $request->boy;

        $boy = Boy::where('first_name', '=', $boy)->first();

        if ($boy) {
            //okay need a 3 table join
            //Select events.* FROM events,eventpoints,cards WHERE events.id = eventpoints.event_id AND events.rank_5=cards.id AND cards.boy_id='10'
            ///
            //hmmmm
            //SELECT 
            $events = DB::select("Select DISTINCT events.* FROM events,eventpoints,cards WHERE events.id = eventpoints.event_id AND events.rank_5=cards.id AND cards.boy_id='" . $boy->id . "'");
        } else {
            $events = DB::select("SELECT DISTINCT events.* FROM events JOIN eventpoints ON events.id = eventpoints.event_id");
        }

        // dd($boy);

        //dd($where);

        $boys = Boy::where('classroom_id', '>', 1)->where('classroom_id', '<', 10)->pluck('first_name', 'first_name');


        return view('pages.eventHistory')
            ->with('request', $request)
            ->with('boys', $boys)
            ->with('events', $events);
    }
}
