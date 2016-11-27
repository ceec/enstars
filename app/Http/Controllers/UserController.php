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
use App\Usercard;
use DB;

class UserController extends Controller
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
     * Display user dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard() {


         return view('user.dashboard');
      
    } 



    /**
     * Display user cards
     *
     * @return \Illuminate\Http\Response
     */
    public function cards() {
        //SELECT cards.* FROM cards,usercards WHERE usercards.user_id='1' AND usercards.card_id = cards.id
        //$cards = Usercard::where('user_id','=',Auth::user()->id)->get();

        // $cards = Card::
        // join('usercards', 'card.id', '=', 'usercards.card_id')
        //     ->join('usercards', 'usercards.user_id', '=', Auth::user()->id)
        //     ->select('cards.*')
        //     ->get();


        // print '<pre>';
        // print_r($cards);
        // print '</pre>';

        $cards = Card::take(5);

        //this doesnt return a Card class object, which then cant use the function inside the method
        //$cards = DB::select("SELECT cards.* FROM cards,usercards WHERE usercards.user_id='".Auth::user()->id."' AND usercards.card_id = cards.id");

         return view('user.cards')
            ->with('cards',$cards);
      
    } 


    /**
     * Add card 
     *
     * @return \Illuminate\Http\Response
     */
    public function addCard(Request $request) {
        $card_id = $request->input('card_id');

        //add the user card
        $user = Auth::user();    

        //check if that card is already there

        $check = Usercard::where('user_id','=',$user->id)->where('card_id','=',$card_id)->count();

        if ($check < 1) {
            //only add if it isnt already there
            //need to update card
            $u = new Usercard;
            $u->user_id = $user->id;
            $u->card_id = $card_id;
            $u->save();

            echo json_encode(array('card_id'=>$card_id));            
        }


      
    } 


    /**
     * Remove card 
     *
     * @return \Illuminate\Http\Response
     */
    public function removeCard(Request $request) {
        $card_id = $request->input('card_id');

        //add the user card
        $user = Auth::user();    

        //need to delete card
        $d = Usercard::where('user_id','=',$user->id)->where('card_id','=',$card_id)->first();
        $d->delete();

        echo json_encode(array('card_id'=>$card_id));
      
    } 




}
