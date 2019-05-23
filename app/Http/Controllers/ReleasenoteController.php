<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Releasenote;

class ReleasenoteController extends Controller
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
     * Add releasenote display
     *
     * @return \Illuminate\Http\Response
     */
    public function addDisplay() {
      return view('home.releasenoteAdd');
    } 


    /**
     * Add releasenote 
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        //need to update event
        $n = new Releasenote;
        $n->version = $request->input('version');
        $n->release_date = $request->input('release_date');
        $n->notes = $request->input('notes');
        $n->save();

        return redirect('/game/releasenotes');          
    } 

}
