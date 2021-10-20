<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scout;
use Auth;
use App\User;

use App\Releasenote;
use App\Gameterm;
use App\Mission;

class GameController extends Controller
{

    /**
     * Display Management Page
     *
     * @return \Illuminate\Http\Response
     */
    public function management()
    {

        return view('game.management');
    }

    /**
     * Display Courses Page
     *
     * @return \Illuminate\Http\Response
     */
    public function courses()
    {

        return view('game.courses');
    }

    /**
     * Display Release Notes Page
     *
     * @return \Illuminate\Http\Response
     */
    public function releasenotes()
    {

        $notes = Releasenote::orderBy('created_at', 'desc')->get();
        return view('game.releasenotes')
            ->with('notes', $notes);
    }

    /**
     * Display Game Terms
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {

        $terms = Gameterm::orderBy('created_at', 'desc')->get();
        return view('game.terms')
            ->with('terms', $terms);
    }

    /**
     * Display Game Missions
     *
     * @return \Illuminate\Http\Response
     */
    public function missions()
    {

        $missions = Mission::orderBy('created_at', 'desc')->get();
        return view('game.missions')
            ->with('missions', $missions);
    }

    /**
     * Add scout
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
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


        return redirect('/scout/' . $s->url);
    }


    /**
     * Edit scout
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
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


        return redirect('/scout/' . $s->url);
    }


}
