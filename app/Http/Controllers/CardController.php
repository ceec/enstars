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

class CardController extends Controller
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
     * Add card  UI
     *
     * @return \Illuminate\Http\Response
     */
    public function addDisplay() {
            $boys = Boy::orderBy('first_name','ASC')->pluck('first_name','id');


            $lesson_skills = Skill::where('skilltype_id','=','2')->orderBy('category','ASC')->pluck('english_description','id');
            $dorifes_skills = Skill::where('skilltype_id','=','1')->orderBy('category','ASC')->pluck('english_description','id');

            return view('home.cardAdd')
            ->with('lesson_skills',$lesson_skills) 
            ->with('dorifes_skills',$dorifes_skills)                  
            ->with('boys',$boys);
    } 

    /**
     * Add card 
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        $boy_id = $request->input('boy_id');

        //get last position
        $last_card = Card::where('boy_id','=',$boy_id)->orderBy('card_id','desc')->first();

        $card_id = $last_card->card_id + 1;

        //need to get the last card for this boy, then incriment it by one.....Or set it to auto increment

        //but also need it for position, so either auto do it and copy the insert

        //need to update card
        $c = new Card;
        $c->boy_id = $boy_id;
        $c->card_id = $card_id;
        $c->place = $card_id;
        $c->stars = $request->input('stars');
        $c->color = $request->input('color');
        $c->name_j = $request->input('japanese_name');
        $c->name_e = $request->input('english_name');
        $c->name_s = $request->input('name_s');
        $c->da = 0;
        $c->vo = 0;
        $c->pf = 0;
        $c->dorifes_j = '';
        $c->dorifes_e = '';
        $c->dorifes_id = $request->input('dorifes_id');
        $c->lesson_j = '';
        $c->lesson_e = '';
        $c->lesson_id = $request->input('lesson_id');
        $c->scout_id = 0;
        $c->event_id = 0;
        $c->sentence_j = '';
        $c->sentence_e = '';        
        $c->stories = 0;
        $c->suggested_name = '';
        $c->suggested_link = '';
        $c->updated_by = 1;
        $c->save();


        // return view('pages.card')
        //     ->with('card',$card);

        return redirect('/home');          
    } 


    /**
     * Edit card  UI
     *
     * @return \Illuminate\Http\Response
     */
    public function editDisplay($card_id) {
            
            $card = Card::find($card_id);
            $boys = Boy::orderBy('first_name','ASC')->pluck('first_name','id');
            $lesson_skills = Skill::where('skilltype_id','=','2')->orderBy('category','ASC')->pluck('english_description','id');
            $dorifes_skills = Skill::where('skilltype_id','=','1')->orderBy('category','ASC')->pluck('english_description','id');

            return view('home.cardEdit')
            ->with('card',$card)
            ->with('lesson_skills',$lesson_skills) 
            ->with('dorifes_skills',$dorifes_skills)                  
            ->with('boys',$boys);
    } 


    /**
     * Edit card 
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        //need to update card
        $c = Card::find($request->input('card_id'));
        $c->boy_id = $request->input('boy_id');
        $c->place = $request->input('place');
        $c->stars = $request->input('stars');
        $c->color = $request->input('color');
        $c->name_j = $request->input('japanese_name');
        $c->name_e = $request->input('english_name');
        $c->name_s = $request->input('name_s');
        $c->sentence_j = $request->input('sentence_j');
        $c->sentence_e = $request->input('sentence_e');        
        $c->dorifes_id = $request->input('dorifes_id');
        $c->lesson_id = $request->input('lesson_id');

        $c->updated_by = Auth::id();  
        $c->save();


        // return view('pages.card')
        //     ->with('card',$card);

        return redirect('/home');          
    } 


    /**
     * Add card suggestion
     *
     * @return \Illuminate\Http\Response
     */
    public function addName(Request $request) {
        $card_id = $request->input('card_id');
        $first_name = $request->input('first_name');

        $first_name = strtolower($first_name);

        //need to update card
        $card = Card::find($card_id);
        $card->suggested_name = $request->input('name');
        $card->save();


        // return view('pages.card')
        //     ->with('card',$card);

        return redirect('/idol/'.$first_name);          
    } 


    /**
     * Add card suggestion
     *
     * @return \Illuminate\Http\Response
     */
    public function addLink(Request $request) {
        $card_id = $request->input('card_id');
        $first_name = $request->input('first_name');

        $first_name = strtolower($first_name);

        //need to update card
        $card = Card::find($card_id);
        $card->suggested_link = $request->input('link');
        $card->save();


        // return view('pages.card')
        //     ->with('card',$card);

        return redirect('/idol/'.$first_name);          
    } 


}
