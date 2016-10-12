<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Boy;
use App\Skill;
use App\Minievent;
use App\Minieventchoice;
use App\Event;

class CardController extends Controller
{
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
