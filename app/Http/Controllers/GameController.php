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

class GameController extends Controller
{

    /**
     * Display Management Page
     *
     * @return \Illuminate\Http\Response
     */
    public function management() {

            return view('game.management');
    } 


    /**
     * Add scout 
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        //need to update event
        $s = new Scout;
        $s->active = 0;
        $s->name_j = $request->input('name_j');
        $s->name_e = $request->input('name_e');
        $s->name_s = $request->input('name_s');
        $s->type_id = $request->input('type_id');
        $s->start = $request->input('start');
        $s->end = $request->input('end');
        $s->text_j = $request->input('text_j');        
        $s->text = $request->input('text');      
        $s->website = $request->input('website'); 
        $s->url = $request->input('url');                  
        $s->updated_by = Auth::id();  
        $s->save();


        return redirect('/scout/'.$s->url);          
    } 


    /**
     * Edit scout 
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        //need to update event
        $s = Scout::find($request->input('scout_id'));
        $s->active = $request->input('active');
        $s->name_j = $request->input('japanese_name');
        $s->name_e = $request->input('english_name');
        $s->text = $request->input('text');
        $s->start = $request->input('start');
        $s->end = $request->input('end');
        $s->updated_by = Auth::id();  
        $s->save();


        return redirect('/scout/'.$s->url);          
    } 


}