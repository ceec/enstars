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
    public function addDisplay()
    {
        return view('home.releasenoteAdd');
    }


    /**
     * Add releasenote
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        //need to update event
        $n = new Releasenote;
        $n->version = $request->input('version');
        $n->release_date = $request->input('release_date');
        $n->notes = $request->input('notes');
        $n->save();

        return redirect('/home/releasenote/edit/' . $n->id);
    }

    /**
     * Edit releasenote display
     *
     * @return \Illuminate\Http\Response
     */
    public function editDisplay($note_id)
    {
        $note = Releasenote::find($note_id);
        return view('home.releasenoteEdit')
            ->with('note', $note);
    }


    /**
     * Edit releasenote
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $note = Releasenote::find($request->note_id);

        //need to update event
        $n = Releasenote::find($note->id);
        $n->version = $request->input('version');
        $n->release_date = $request->input('release_date');
        $n->notes = $request->input('notes');
        $n->save();

        return redirect('/home/releasenote/edit/' . $n->id);
    }


    /**
     * List releasenote display
     *
     * @return \Illuminate\Http\Response
     */
    public function listDisplay()
    {
        $notes = Releasenote::all();
        return view('home.releasenoteList')
            ->with('notes', $notes);
    }

}
