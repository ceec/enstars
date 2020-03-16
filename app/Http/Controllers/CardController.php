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
use App\Cardroad;
use App\Cardsuggestion;

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


            $lesson_skills = Skill::where('skilltype_id','=','2')->orderBy('category','ASC')->orderBy('type','ASC')->orderBy('size','ASC')->pluck('english_description','id');
            $dorifes_skills = Skill::where('skilltype_id','=','1')->orderBy('category','ASC')->orderBy('type','ASC')->orderBy('size','ASC')->orderBy('amount','ASC')->pluck('english_description','id');

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
        $c->game_id = 2;
        $c->name_j = $request->input('japanese_name');
        $c->name_e = $request->input('english_name');
        $c->name_s = $request->input('name_s');
        $c->da = 0;
        $c->vo = 0;
        $c->pf = 0;
        $c->da_max = 0;
        $c->vo_max = 0;
        $c->pf_max = 0;   
        $c->da_max5 = 0;
        $c->vo_max5 = 0;
        $c->pf_max5 = 0;                
        $c->dorifes_j = '';
        $c->dorifes_e = '';
        $c->dorifes_id = $request->input('dorifes_id');
        $c->lesson_j = '';
        $c->lesson_e = '';
        $c->lesson_id = $request->input('lesson_id');
        //unleveled skills
        $c->u_dorifes_j = '';
        $c->u_dorifes_e = '';  
        $c->u_lesson_j = '';
        $c->u_lesson_e = '';                        
        $c->u_dorifes_id = 74;
        $c->u_lesson_id = 75;               
        $c->scout_id = 0;
        $c->event_id = 0;
        $c->collaboration_id = 0;
        $c->collection_id = 0;
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
        $c->stars = $request->input('stars');
        $c->color = $request->input('color');
        $c->da = $request->input('da');
        $c->vo = $request->input('vo');
        $c->pf = $request->input('pf');  
        $c->da_max = $request->input('da_max');
        $c->vo_max = $request->input('vo_max');
        $c->pf_max = $request->input('pf_max');   
        $c->da_max5 = $request->input('da_max5');
        $c->vo_max5 = $request->input('vo_max5');
        $c->pf_max5 = $request->input('pf_max5');                                        
        $c->name_j = $request->input('japanese_name');
        $c->name_e = $request->input('english_name');
        $c->sentence_j = $request->input('sentence_j');
        $c->sentence_e = $request->input('sentence_e');  
        $c->dorifes_j = $request->input('dorifes_j');
        $c->dorifes_e = $request->input('dorifes_e');  
        $c->lesson_j = $request->input('lesson_j');
        $c->lesson_e = $request->input('lesson_e');                        
        $c->dorifes_id = $request->input('dorifes_id');
        $c->lesson_id = $request->input('lesson_id');
        $c->scout_id = $request->input('scout_id');
        $c->event_id = $request->input('event_id');
        //unleveled skills
        $c->u_dorifes_j = $request->input('u_dorifes_j');
        $c->u_dorifes_e = $request->input('u_dorifes_e');  
        $c->u_lesson_j = $request->input('u_lesson_j');
        $c->u_lesson_e = $request->input('u_lesson_e');                        
        $c->u_dorifes_id = $request->input('u_dorifes_id');
        $c->u_lesson_id = $request->input('u_lesson_id');        

        $c->updated_by = Auth::id();  
        $c->save();


        // return view('pages.card')
        //     ->with('card',$card);

        return redirect('/card/'.$c->id);          
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



    /**
     * Add road
     *
     * @return \Illuminate\Http\Response
     */
    public function addRoad(Request $request) {
        $stars = $request->input('stars');
        $card_id = $request->input('card_id');

        //okay so all cards have base roads

        //nodes 0 -> 15
        //add in the parent nodes
        for ($i=1; $i < 14; $i++) { 
            //add the base nodes
            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = 0;
            $n->node = $i;

            //13th spot is the bloom
            if ($i == 13) {
                $type = 'bloom';
            } else {
                $type = '';
            }
            $n->type = $type;

            $n->color = '';
            $n->points = 0;

            //this amount is for 4 stars, and probably 5 stars too.
            //based on the i, change the small amount
            if ($i < 3) {
                $small = 4;
            } else if ($i <7) {
                $small = 6;
            } else if ($i < 10) {
                $small = 7;
            } else {
                $small = 10;
            }
            $n->small = $small;

            //based on the i, change the medium amount
            if ($i < 3) {
                $medium = 0;
            } else if ($i < 5) {
                $medium = 1;
            } else if ($i < 7) {
                $medium = 7;
            } else if ($i < 10) {
                $medium = 3;
            } else {
                $medium = 5;
            }
            $n->medium = $medium;

            //based on the i, change the large amount
            if ($i < 10) {
                $large = 0;
            } else if ($i < 12) {
                $large = 1;
            } else {
                $large = 3;
            }
            $n->large = $large;

            //set up the level
            if ($i == 3) {
                $level = 10;
            } else if ($i == 5) {
                $level = 25;
            } else if ($i == 7) {
                $level = 40;
            } else if ($i == 9) {
                $level = 50;
            } else if ($i == 11) {
                $level = 60;
            } else {
                $level = 0;
            }
            $n->level = $level;

            $n->chapter_id = 0;
            //13th spot is the bloom
            if ($i == 13) {
                $end = 1;
            } else {
                $end = 0;
            }
            $n->end = $end;
            $n->updated_by = 1;
            $n->save();
        }

        //start the upper level
        if ($stars == 4) {
            //determine the parent, 4 stars start on the 3rd node maybe don't use loop here?
            //3u_1
            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '3';
            $n->node = '3u_1';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 6;
            $n->medium = 1;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();
  
            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '3';
            $n->node = '3u_2';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 6;
            $n->medium = 1;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();          
                
            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '5';
            $n->node = '5u_1';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 6;
            $n->medium = 2;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();   

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '5';
            $n->node = '5u_2';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 6;
            $n->medium = 2;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();    

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '7';
            $n->node = '7u_1';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 6;
            $n->medium = 2;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();  

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '7';
            $n->node = '7u_2';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 7;
            $n->medium = 3;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();    

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '10';
            $n->node = '10u_1';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 7;
            $n->medium = 5;
            $n->large = 1;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();    

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '10';
            $n->node = '10u_2';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 7;
            $n->medium = 5;
            $n->large = 1;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '10';
            $n->node = '10u_3';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 7;
            $n->medium = 5;
            $n->large = 1;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 1;
            $n->updated_by = 0;
            $n->save();         

            //lower level   
            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '2';
            $n->node = '2d_1';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 4;
            $n->medium = 0;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();                   
 
            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '2';
            $n->node = '2d_2';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 6;
            $n->medium = 1;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();   

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '6';
            $n->node = '6d_1';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 6;
            $n->medium = 2;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();     

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '6';
            $n->node = '6d_2';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 6;
            $n->medium = 2;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();   

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '6';
            $n->node = '6d_3';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 7;
            $n->medium = 3;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();   

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '9';
            $n->node = '9d_1';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 7;
            $n->medium = 3;
            $n->large = 0;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();   

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = '9';
            $n->node = '9d_2';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 7;
            $n->medium = 5;
            $n->large = 1;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save(); 

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = 11;
            $n->node = '11d_1';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 7;
            $n->medium = 5;
            $n->large = 1;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 0;
            $n->updated_by = 0;
            $n->save();  

            $n = new Cardroad;
            $n->card_id = $card_id;
            $n->parent = 11;
            $n->node = '11d_2';
            $n->type = '';
            $n->color = '';
            $n->points = 0;
            $n->small = 10;
            $n->medium = 5;
            $n->large = 2;
            $n->level = 0;
            $n->chapter_id = 0;
            $n->end = 1;
            $n->updated_by = 0;
            $n->save();                                                       
        }




        return redirect('/card/'.$card_id);          
    } 



    /**
     * Edit road node
     *
     * @return \Illuminate\Http\Response
     */
    public function editRoadNode(Request $request) {
        $card_id = $request->input('card_id');
        //need to update card
        $n = Cardroad::find($request->input('node_id'));
        $n->type = $request->input('type');
        $n->color = $request->input('color');
        $n->points = $request->input('points');
        $n->updated_by = Auth::id();  
        $n->save();



        return redirect('/card/'.$card_id);          
    } 

    //card suggestions


    /**
     * Add card suggestion
     *
     * @return \Illuminate\Http\Response
     */
    public function addSuggestion(Request $request) {
        $card_id = $request->input('acard_id');

        //copy card in the database
        $card = Card::find($card_id);

        //can probably do this easier but i dont understand eloquent enough

        $c = new Cardsuggestion;
        $c->status = 0;
        $c->acard_id = $card_id;
        $c->boy_id = $card->boy_id;
        $c->card_id = $card->card_id;
        $c->place = $card->place;
        $c->stars = $card->stars;
        $c->color = $card->color;
        $c->name_j = $card->name_j;
        $c->name_e = $card->name_e;
        $c->name_s = $card->name_s;
        $c->da = $card->da;
        $c->vo = $card->vo;
        $c->pf = $card->pf;
        $c->da_max = $card->da_max;
        $c->vo_max = $card->vo_max;
        $c->pf_max = $card->pf_max;
        $c->da_max5 = $card->da_max5;
        $c->vo_max5 = $card->vo_max5;
        $c->pf_max5 = $card->pf_max5;            
        $c->dorifes_j = $card->dorifes_j;
        $c->dorifes_e = $card->dorifes_e;
        $c->dorifes_id = $card->dorifes_id;
        $c->lesson_j = $card->lesson_j;
        $c->lesson_e = $card->lesson_e;
        $c->lesson_id = $card->lesson_id;
        //unleveled skills
        $c->u_dorifes_j = $card->u_dorifes_j;
        $c->u_dorifes_e = $card->u_dorifes_e;
        $c->u_lesson_j = $card->u_lesson_j;
        $c->u_lesson_e = $card->u_lesson_e;      
        $c->u_dorifes_id = $card->u_dorifes_id;
        $c->u_lesson_id = $card->u_lesson_id;               
        $c->scout_id = $card->scout_id;
        $c->event_id = $card->event_id;
        $c->sentence_j = $card->sentence_j;
        $c->sentence_e = $card->sentence_e;    
        $c->stories = $card->stories;
        $c->suggested_name = $card->suggested_name;
        $c->suggested_link = $card->suggested_link;
        $c->updated_by = Auth::id();
        $c->save();

        return redirect('/card/'.$card_id);            
    } 





    /**
     * Edit card suggestion
     *
     * @return \Illuminate\Http\Response
     */
    public function editSuggestion(Request $request) {
        //need to update card
        $c = Cardsuggestion::find($request->input('suggestion_id'));
        $c->stars = $request->input('stars');
        $c->color = $request->input('color');
        $c->da = $request->input('da');
        $c->vo = $request->input('vo');
        $c->pf = $request->input('pf');  
        $c->da_max = $request->input('da_max');
        $c->vo_max = $request->input('vo_max');
        $c->pf_max = $request->input('pf_max');   
        $c->da_max5 = $request->input('da_max5');
        $c->vo_max5 = $request->input('vo_max5');
        $c->pf_max5 = $request->input('pf_max5');                                        
        $c->name_j = $request->input('japanese_name');
        $c->name_e = $request->input('english_name');
        $c->sentence_j = $request->input('sentence_j');
        $c->sentence_e = $request->input('sentence_e');  
        $c->dorifes_j = $request->input('dorifes_j');
        $c->dorifes_e = $request->input('dorifes_e');  
        $c->lesson_j = $request->input('lesson_j');
        $c->lesson_e = $request->input('lesson_e');                        
        $c->dorifes_id = $request->input('dorifes_id');
        $c->lesson_id = $request->input('lesson_id');
        //unleveled skills
        $c->u_dorifes_j = $request->input('u_dorifes_j');
        $c->u_dorifes_e = $request->input('u_dorifes_e');  
        $c->u_lesson_j = $request->input('u_lesson_j');
        $c->u_lesson_e = $request->input('u_lesson_e');                        
        $c->u_dorifes_id = $request->input('u_dorifes_id');
        $c->u_lesson_id = $request->input('u_lesson_id');        

        $c->updated_by = Auth::id();  
        $c->save();

        return redirect('/card/'.$c->acard_id);          
    }     

}
