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
