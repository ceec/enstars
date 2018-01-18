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
use App\Userevent;
use App\Userteam;

use DB;
use App\Scout;

//testing
use App\Repositories\CardRepository;

class UserController extends Controller
{

    /**
     * The task repository instance.
     *
     * @var CardRepository
     */
    protected $cards;

    /**
     * Only can do this when logged in
     *
     * @return void
     */
    public function __construct(CardRepository $cards)
    {
        $this->middleware('auth');

        $this->cards = $cards;
    }





    /**
     * Display user dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard() {
        $user = Auth::user();    


        //print_r($this->cards->forUser($user));

        if ($user->card == 0) {
            $user->card = 899;
        }
        $card = Card::find($user->card);


        //get the set data
        //loop through all the scouts.
        //tie the cards they have
        $scouts = Scout::orderBy('end','desc')->get();


         return view('user.dashboard')
            ->with('scouts',$scouts)
            ->with('user',$user)
            ->with('card',$card);
      
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

        //$cards = Card::take(5);

        //this doesnt return a Card class object, which then cant use the function inside the method
        //$cards = DB::select("SELECT cards.* FROM cards,usercards WHERE usercards.user_id='".Auth::user()->id."' AND usercards.card_id = cards.id");

        //get all a users 5 stars
        //SELECT * FROM usercards WHERE user_id=
        //SELECT * FROM cards WHERE stars = 5

        //$cards = Usercard::where('user_id','=',Auth::user()->id)->get();
        //$test = new Usercard;

        //$cards = $test->select('cards.*')->join('cards', 'cards.id', '=', 'usercards.card_id')->whereRaw("cards.stars='5'")->whereRaw('usercards.user_id = '.Auth::user()->id)->get();


        $card = new Card;
        $fivestarcardsq = $card->select('cards.*')->join('usercards','usercards.card_id','=','cards.id')->whereRaw("cards.stars='5'")->whereRaw('usercards.user_id = '.Auth::user()->id)->orderBy('usercards.created_at','desc');
        $fivestarcards = $fivestarcardsq->get();
        //$fivestarcards_count = $fivestarcardsq->count();

        //four star
        $fourstarcardsq = $card->select('cards.*')->join('usercards','usercards.card_id','=','cards.id')->whereRaw("cards.stars='4'")->whereRaw('usercards.user_id = '.Auth::user()->id)->orderBy('usercards.created_at','desc');
        $fourstarcards = $fourstarcardsq->get();
        //$fourstarcards_count = $fourstarcardsq->count();

        //three star
        $threestarcardsq = $card->select('cards.*')->join('usercards','usercards.card_id','=','cards.id')->whereRaw("cards.stars='3'")->whereRaw('usercards.user_id = '.Auth::user()->id)->orderBy('usercards.created_at','desc');
        $threestarcards = $threestarcardsq->get();
        //$threestarcards_count = $threestarcardsq->count();        

       // dd($cards);


         return view('user.cards')
            ->with('fivestarcards',$fivestarcards)
            ->with('fourstarcards',$fourstarcards)
            ->with('threestarcards',$threestarcards);
      
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
             $u->bloom = 0;
             $u->copies = 1;
             $u->level = 0;
             $u->da = 0;
             $u->vo = 0;
             $u->pf = 0;
             $u->percent = 0;
             $u->affection = 0;
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



    //////


    /**
     * Display user scouts
     *
     * @return \Illuminate\Http\Response
     */
    public function scouts() {
        
       // $scouts = 

        $card = Card::find($user->card);

         return view('user.scouts')
            ->with('user',$user)
            ->with('card',$card);
      
    } 


    /**
     * Display user account settings
     *
     * @return \Illuminate\Http\Response
     */
    public function account() {
        //add the user card
        $user = Auth::user();            

         return view('user.account')
            ->with('user',$user);
      
    } 


    /////

    /**
     * Add event
     *
     * @return \Illuminate\Http\Response
     */
    public function addEvent(Request $request) {
        $event_id = $request->input('event_id');

        //add the user card
        $user = Auth::user();    


        $e = new Userevent;
        $e->user_id = $user->id;
        $e->event_id = $event_id;
        $e->points = 0;
        $e->rank = 0;
        $e->updated_by = $user->id;
        $e->save();


         echo json_encode(array('event_id'=>$event_id));            

    }


    /**
     * Update event
     *
     * @return \Illuminate\Http\Response
     */
    public function updateEvent(Request $request) {
        $event_id = $request->input('event_id');
        $rank = $request->input('rank');
        $points = $request->input('points');
        //add the user card
        $user = Auth::user();    

        //do want to update or be able to track all the data?
        //update for now, would just need to change this to an insert to add lots of data.
        $e = Userevent::where('user_id','=',$user->id)->where('event_id','=',$event_id)->first();

        $e->user_id = $user->id;
        $e->event_id = $event_id;
        $e->points = $points;
        $e->rank = $rank;
        $e->updated_by = $user->id;
        $e->save();


         echo json_encode(array('event_id'=>$event_id));            

    }

    /**
     * Update card
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCard(Request $request) {
         $user = Auth::user();

         $card_id = $request->input('card_id');
         $usercard_id = $request->input('usercard_id');

         $c = Usercard::find($usercard_id);
         $c->bloom = $request->input('bloom');
         $c->copies = $request->input('copies');
         $c->level = $request->input('level');
         $c->da = $request->input('da');
         $c->vo = $request->input('vo');
         $c->pf = $request->input('pf');
         $c->percent = $request->input('percent');
         $c->affection = $request->input('affection');
         $c->save();



        // $event_id = $request->input('event_id');
        // $rank = $request->input('rank');
        // $points = $request->input('points');
        // //add the user card
        // $user = Auth::user();    

        // //do want to update or be able to track all the data?
        // //update for now, would just need to change this to an insert to add lots of data.
        // $e = Userevent::where('user_id','=',$user->id)->where('event_id','=',$event_id)->first();

        // $e->user_id = $user->id;
        // $e->event_id = $event_id;
        // $e->points = $points;
        // $e->rank = $rank;
        // $e->updated_by = $user->id;
        // $e->save();


        // echo json_encode(array('usercard_id'=>$usercard_id));            
         return redirect('/card/'.$card_id);      

    }


    /**
     * Update dashboard card - Added 2017-09-04
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateDashboardCard(Request $request) {
         $user = Auth::user();

         $card_id = $request->input('card_id');
         $usercard_id = $request->input('usercard_id');

         $c = User::find($user->id);
         $c->card = $card_id;
         $c->save();


        // echo json_encode(array('usercard_id'=>$usercard_id));            
         return redirect('/card/'.$card_id);      

    }

    /**
     * Update user account - Added 2017-09-18
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request) {
         $user = Auth::user();
         $display = $request->display_collection;

         if ($display == 'Hide Collection') {
            $display_value = 0;
         } else {
            $display_value = 1;
         }



         $c = User::find($user->id);
         $c->display_collection = $display_value;
         $c->save();


        // echo json_encode(array('usercard_id'=>$usercard_id));            
         return redirect('/user/'.$user->name.'/account');      

    }

    /**
     * Update user team/event calculator - Added 2017-12-18
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateTeam(Request $request) {
         $user = Auth::user();

         $da = $request->da;
         $da_2 = $request->da_2;
         $da_3 = $request->da_3;

         $vo = $request->vo;
         $vo_2 = $request->vo_2;
         $vo_3 = $request->vo_3;

         $pf = $request->pf;
         $pf_2 = $request->pf_2;
         $pf_3 = $request->pf_3;

         //check if team is already there

        $check = Userteam::where('user_id','=',$user->id)->count();

        if ($check < 1) {
            //only add if it isnt already there
            $t = new Userteam;
            $t->user_id = $user->id;
            $t->da = $da;
            $t->da_2 = $da_2;
            $t->da_3 = $da_3;
            $t->vo = $vo;
            $t->vo_2 = $vo_2;
            $t->vo_3 = $vo_3;
            $t->pf = $pf;
            $t->pf_2 = $pf_2;
            $t->pf_3 = $pf_3;
            $t->save();

            echo json_encode(array('work'=>$t->da));            
        } else {
            //update the team
            $t = Userteam::where('user_id','=',$user->id)->first();
            $t->da = $da;
            $t->da_2 = $da_2;
            $t->da_3 = $da_3;
            $t->vo = $vo;
            $t->vo_2 = $vo_2;
            $t->vo_3 = $vo_3;
            $t->pf = $pf;
            $t->pf_2 = $pf_2;
            $t->pf_3 = $pf_3;
            $t->save();
        }





        echo json_encode(array('work'=>$t->da));            
         //return redirect('/user/'.$user->name.'/account');      

    }






}
