<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Boy;
use App\Skill;
use App\Minievent;
use App\Minieventchoice;
use App\Collection;
use Auth;
use App\User;

class CollectionController extends Controller
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
     * Add collection display
     *
     * @return \Illuminate\Http\Response
     */
    public function addDisplay() {

            return view('home.collectionAdd');
    } 


    /**
     * Add collection 
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        //need to update event
        $s = new Collection;
        $s->active = 0;
        $s->name_j = $request->input('name_j');
        $s->name_e = $request->input('name_e');
        $s->name_s = $request->input('name_s');
        $s->start = $request->input('start');
        $s->end = $request->input('end');
        $s->text_j = $request->input('text_j');        
        $s->text = $request->input('text');      
        $s->website = $request->input('website'); 
        $s->url = $request->input('url');                  
        $s->updated_by = Auth::id();  
        $s->save();


        return redirect('/collection/'.$s->url);          
    } 


    /**
     * Edit collection 
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        //need to update event
        $s = Collection::find($request->input('collection_id'));
        $s->active = $request->input('active');
        $s->name_j = $request->input('japanese_name');
        $s->name_e = $request->input('english_name');
        $s->text = $request->input('text');
        $s->start = $request->input('start');
        $s->end = $request->input('end');
        $s->updated_by = Auth::id();  
        $s->save();


        return redirect('/collection/'.$s->url);          
    } 


}
