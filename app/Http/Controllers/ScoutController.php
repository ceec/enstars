<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Boy;
use App\Skill;
use App\Minievent;
use App\Minieventchoice;
use App\Scout;
use Auth;
use App\User;

class ScoutController extends Controller
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
        $s = Scout::find($request->input('scout_id'));
        $s->name_j = $request->input('japanese_name');
        $s->name_e = $request->input('english_name');
        $s->start = $request->input('start');
        $s->end = $request->input('end');
        $s->updated_by = Auth::id();  
        $s->save();


        return redirect('/scout/'.$s->url);          
    } 


}
