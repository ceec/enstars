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
     * Add event display
     *
     * @return \Illuminate\Http\Response
     */
    public function addDisplay() {

            return view('home.eventAdd');
    } 


    /**
     * Add event 
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        //need to update event
        $e = new Event;
        $e->active = 0;
        $e->name_j = $request->input('name_j');
        $e->name_e = $request->input('name_e');
        $e->name_s = $request->input('name_s');
        $e->start = $request->input('start');
        $e->end = $request->input('end');
        $e->text = $request->input('text');
        $e->url = $request->input('url');
        $e->rank_5 = 0;
        $e->rank_4 = 0;
        $e->rank_3 = 0;
        $e->points_5 = 0;
        $e->points_4 = 0;
        $e->points_3_da = 0;
        $e->points_3_vo = 0;
        $e->points_3_pf = 0;
        $e->notes = '';
        $e->website = $request->input('website');              
        $e->updated_by = Auth::id();  
        $e->save();


        return redirect('/event/'.$e->url);          
    } 


    /**
     * Edit event 
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        //need to update event
        $e = Event::find($request->input('event_id'));
        $e->active = $request->input('active');
        $e->name_j = $request->input('japanese_name');
        $e->name_e = $request->input('english_name');
        $e->text = $request->input('text');
        $e->start = $request->input('start');
        $e->end = $request->input('end');
        $e->rank_5 = $request->input('rank_5');
        $e->rank_4 = $request->input('rank_4');
        $e->rank_3 = $request->input('rank_3');
        $e->points_5 = $request->input('points_5');
        $e->points_4 = $request->input('points_4');
        $e->points_3_da = $request->input('points_3_da');
        $e->points_3_vo = $request->input('points_3_vo');
        $e->points_3_pf = $request->input('points_3_pf');                                                
        $e->updated_by = Auth::id();  
        $e->save();


        return redirect('/event/'.$e->url);          
    } 


}
