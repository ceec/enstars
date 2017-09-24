<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Boy;
use App\Skill;
use App\Minievent;
use App\Minieventchoice;
use App\Event;
use Auth;
use App\User;

class EventController extends Controller
{

    /**
     * Only can do this when logged in
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Edit event 
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        //need to update event
        $e = Event::find($request->input('event_id'));
        $e->name_j = $request->input('japanese_name');
        $e->name_e = $request->input('english_name');
        $e->start = $request->input('start');
        $e->end = $request->input('end');
        $e->updated_by = Auth::id();  
        $e->save();


        return redirect('/event/'.$e->url);          
    } 


}
