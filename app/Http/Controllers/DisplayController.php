<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Boy;
use App\Skill;
use App\Minievent;
use App\Minieventchoice;
use App\Minieventslide;
use App\Event;

use App\Cardtag;
use App\Tag;
use App\Unit;
use App\Unitevent;
use App\Classroom;

use App\Story;
use App\Chapter;
use App\Slide;

use App\Blog;

use App\Collaboration;
use App\Scout;

use App\Unitskill;
use App\Unitskillboy;
use App\Type;

use App\Message;

use App\User;
use App\Userevent;

use App\Eventpoint;
use App\Reward;

use App\Loginevent;
use App\Logineventday;

use App\Cardroad;
use App\Usercard;

use App\Cardissue;
use App\Userteam;

use Auth;

use App\Cardsuggestion;
use App\Chapterboy;

use DB;

use App\Eventcard;
use App\Typegroup;

use App\Releasenote;

use App\Scoutcard;

use App\Collection;
use App\Shopcard;

use App\Cardsource;

class DisplayController extends Controller {

    /**
     * Show the index
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $boys = Boy::where('classroom_id','!=','7')->orderBy('first_name','asc')->get();
        $teachers = Boy::where('classroom_id','=','7')->orderBy('first_name','asc')->get();

        //yumenosaki
        $yume_boys = Boy::where('unit_id','!=','0')->where('classroom_id','!=','7')->orderBy('first_name','asc')->get();
        $yume_teachers = Boy::where('school_id','=','1')->where('classroom_id','=','7')->orderBy('first_name','asc')->get();

        //reimei
        $rei_boys = Boy::where('school_id','=','2')->orderBy('first_name','asc')->get();

        //third school 
        $third_boys = Boy::where('school_id','=','3')->orderBy('first_name','asc')->get();

        //random other peeps
        $others = Boy::where('unit_id','=','0')->where('classroom_id','!=','7')->orderBy('first_name','asc')->get();

        //only show reecentish blog posts
        $recent = date('Y-m-d h:i:s', strtotime("-2 months"));

        $blogs = Blog::orderBy('created_at','desc')->where('active','=','1')->where('created_at','>',$recent)->take(4)->get();
        $units = Unit::all();

        //stories that are complete
        $event_stories = Story::where('type','=',1)->where('active','=','1')->get();
        $scout_stories = Story::where('type','=',2)->where('active','=','1')->get();
        $character_stories = Story::where('type','=',3)->where('active','=','1')->get();

        //get a list of tags
        $tags = Tag::where('active','=','1')->get();        


        //get a list of gem skills
        //they dont work this way.
        $red_all = Skill::where('category','=','gem')->where('type','=','red')->where('size','=','all')->get();
        $red_fragment = Skill::where('category','=','gem')->where('type','=','red')->where('size','=','fragment')->get();
        $red_small = Skill::where('category','=','gem')->where('type','=','red')->where('size','=','small')->get();
        $red_medium = Skill::where('category','=','gem')->where('type','=','red')->where('size','=','medium')->get();
        $red_large = Skill::where('category','=','gem')->where('type','=','red')->where('size','=','large')->get();

        //neeed 

        $current_event = Event::where('active','=',1)->get();
        $current_scout = Scout::where('active','=',1)->orderBy('start','desc')->get();



        $reds = Skill::where('category','=','gem')->where('type','=','red')->get();
        $blues = Skill::where('category','=','gem')->where('type','=','blue')->get();
        $yellows = Skill::where('category','=','gem')->where('type','=','yellow')->get();
        $all= Skill::where('category','=','gem')->where('type','=','all')->get();


        //adding a feed of updates should pull from adding new scout, new events, new relase notes, new translated chapters

        //starting lets do scout events and release notes

        //SELECT title FROM scouts,events,releasenotes WHERE 

        $notes = Releasenote::orderBy('created_at','desc')->take(3)->get();

        // Right now music (id=3) events are basically the same as basic, hide them
        $events = Event::where('game_id','!=',3)->orderBy('created_at','desc')->take(3)->get();

        $scouts = Scout::orderBy('created_at','desc')->take(3)->get();

        foreach($notes as $note) {
            $latest_note['type'] = 'releasenote';
            $latest_note['title'] = 'Game Release Notes for Version '.$note->version;
            $latest_note['id'] = $note->id;
            $latest_note['created_at']= $note->created_at;
            $latest[] = $latest_note;
        }

        foreach($scouts as $scout) {
            $latest_scout['type'] = 'scout';
            $latest_scout['title'] = $scout->name_e.' cards have been added';
            $latest_scout['id'] = $scout->id;
            $latest_scout['created_at']= $scout->created_at;
            $latest[] = $latest_scout;            
        }
      
        foreach($events as $event) {
            $latest_event['type'] = 'event';
            $latest_event['title'] = $event->name_e.' cards have been added';
            $latest_event['id'] = $event->id;
            $latest_event['created_at']= $event->created_at;
            $latest[] = $latest_event;
        }        

         $keys = array_column($latest, 'created_at');
         array_multisort($keys, SORT_DESC, $latest);


         $latest = array_slice($latest,0,5,true);

        return view('pages.main')
        ->with('yume_boys',$yume_boys)
        ->with('yume_teachers',$yume_teachers)
        ->with('rei_boys',$rei_boys)
        ->with('third_boys',$third_boys)
        ->with('others',$others)
        ->with('boys',$boys)
        ->with('teachers',$teachers)
        ->with('units',$units)
        ->with('event_stories',$event_stories)
        ->with('scout_stories',$scout_stories)
        ->with('character_stories',$character_stories)
        ->with('tags',$tags)    
        ->with('reds',$reds)  
        ->with('red_medium',$red_medium)   
        ->with('blues',$blues)
        ->with('yellows',$yellows)
        ->with('all',$all)         
        ->with('current_event',$current_event)
        ->with('current_scout',$current_scout)
        ->with('latest',$latest)
        ->with('blogs',$blogs);

    }



    /**
     * Show the old homepage/info.
     *
     * @return \Illuminate\Http\Response
     */
    public function info() {
        $cards = Card::all();
        $boys = Boy::all();

        foreach ($boys as $key => $boy) {
            //get their total cards
            $boys[$key]->total = Card::where('boy_id','=',$boy->id)->count();
             $boys[$key]->entered = Card::where('boy_id','=',$boy->id)->where('stars','!=','0')->count();
             $boys[$key]->to_be_entered = Card::where('boy_id','=',$boy->id)->where('stars','=','0')->where('suggested_name','!=','')->count();

        }

        $total_cards = Card::all()->count();

        $total_five_star = Card::where('stars','=','5')->count();
        $total_four_star = Card::where('stars','=','4')->count();
        $total_three_star = Card::where('stars','=','3')->count();
        $total_two_star = Card::where('stars','=','2')->count();
        $total_one_star = Card::where('stars','=','1')->count();

        $entered_cards = $total_five_star + $total_four_star + $total_three_star + $total_two_star + $total_one_star;


        $percent = round($entered_cards/$total_cards * 100);

        //get a list of tags
        $tags = Tag::where('active','=','1')->get();

        //get a list of gem skills
        $reds = Skill::where('category','=','gem')->where('type','=','red')->get();
        $blues = Skill::where('category','=','gem')->where('type','=','blue')->get();
        $yellows = Skill::where('category','=','gem')->where('type','=','yellow')->get();
        $all = Skill::where('category','=','gem')->where('type','=','all')->get();

        $units = Unit::all();


        //stories that are complete
        $event_stories = Story::where('type','=',1)->get();
        $scout_stories = Story::where('type','=',2)->get();
        $character_stories = Story::where('type','=',3)->get();

        return view('welcome')
            ->with('cards',$cards)
            ->with('total_cards',$total_cards)
            ->with('total_five_star',$total_five_star)
            ->with('total_four_star',$total_four_star)
            ->with('total_three_star',$total_three_star)
            ->with('total_two_star',$total_two_star)
            ->with('total_one_star',$total_one_star)
            ->with('entered_cards',$entered_cards)
            ->with('percent',$percent)  
            ->with('tags',$tags)     
            ->with('reds',$reds)     
            ->with('blues',$blues)
            ->with('yellows',$yellows)
            ->with('all',$all)        
            ->with('units',$units)
            ->with('event_stories',$event_stories)
            ->with('scout_stories',$scout_stories)
            ->with('character_stories',$character_stories)                                                                    
            ->with('boys',$boys);
   
    }

    /**
     * Show the birthdays.
     *
     * @return \Illuminate\Http\Response
     */
    public function birthdays() {
        //get just boys with birthday info
        $boys = Boy::where('birthday','>','2010-01-01')->orderBy('birthday','asc')->get();

        //should probably move logic here


        $months = array('January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July ',
            'August',
            'September',
            'October',
            'November',
            'December',
        );


        $birthdays = [];

        foreach($months as $m => $month) {
            foreach($boys as $boy) {
                if (date('n',strtotime($boy->birthday)) == ($m+1)) {
                    
                    $birthdays[$month][] = $boy;
                }

            }
        }


        //dd($birthdays);


        return view('pages.birthdays')
            ->with('birthdays',$birthdays)
            ->with('boys',$boys);
    }

       /**
     * Individual card page
     *
     * @return \Illuminate\Http\Response
     */
    public function card($card_id) {
        $card = Card::where('id','=',$card_id)->first();

        //when bad url is passed
        if (empty($card)) {
            //want to go to 404 page 
            abort(404);
        }  

        $boy = Boy::where('id','=',$card->boy_id)->first();

        //lesson skill
        if ($card->lesson_id == 0) {
            $lesson_skill = Skill::where('id','=',1)->first();
            $lesson_skill->id = '';
            $lesson_skill->english_description = 'Unknown';
        } else {
            $lesson_skill = Skill::where('id','=',$card->lesson_id)->first();
        }

        //dorifes skill
        if ($card->dorifes_id == 0) {
            $dorifes_skill = Skill::where('id','=',1)->first();
            $dorifes_skill->id = '';
            $dorifes_skill->english_description = 'Unknown';
        } else {
            $dorifes_skill = Skill::where('id','=',$card->dorifes_id)->first();
        }


        ///unleveled skills


        //lesson skill
        if ($card->u_lesson_id == 0) {
            $u_lesson_skill = Skill::where('id','=',74)->first();
        } else {
            $u_lesson_skill = Skill::where('id','=',$card->u_lesson_id)->first();
        }

        //dorifes skill
        if ($card->u_dorifes_id == 0) {
            $u_dorifes_skill = Skill::where('id','=',75)->first();
        } else {
            $u_dorifes_skill = Skill::where('id','=',$card->u_dorifes_id)->first();
        }

        //get event or scout
        if ($card->event_id !=0) {
            $source = Event::where('id','=',$card->event_id)->first();
        } else if ($card->scout_id !=0) {
            $source = Scout::where('id','=',$card->scout_id)->first();
        } else if ($card->collaboration_id !=0) {
            $source = Collaboration::where('id','=',$card->collaboration_id)->first();
        } else if ($card->collection_id !=0) {
            $source = Collection::where('id','=',$card->collection_id)->first();
        } else {
            $source = '';
        }

        // // Need to deal with shop cards
        // $shop = $card->shop;
        // dd($shop);

        //for admins editing
        $lesson_skills = Skill::where('skilltype_id','=','2')->where('game_id','=',$card->game_id)->orderBy('category','ASC')->orderBy('type','ASC')->orderBy('size','ASC')->pluck('english_description','id');
        $dorifes_skills = Skill::where('skilltype_id','=','1')->orderBy('category','ASC')->orderBy('type','ASC')->orderBy('size','ASC')->pluck('english_description','id');

        // Lesson skills are missing unknown for game_id=2
        $lesson_skills[75] = 'Unknown';

        //user editing
        //if someone is logged in
        if (!Auth::guest()) {

         $user = Auth::user();    
         $user_card = Usercard::where('user_id','=',$user->id)->where('card_id','=',$card_id)->first();
         //card suggestion
         $card_suggestion = Cardsuggestion::where('updated_by','=',$user->id)->where('acard_id','=',$card_id)->first();
        } else {
            $user_card = '';
            $card_suggestion = '';
        }

        //get the admin name who updated it last
        $updated_by = User::find($card->updated_by);

        //building the idol road
        //get the parent nodes
        $road = Cardroad::where('card_id','=',$card->id)->where('parent','=',0)->get();

        //loop through them and see if they have children, this is recusrive? maybe.

        //this is a svg that is built from the top down.

        //check that any nodes with a parent of u also have a u -- topmost row

        $top = Cardroad::where('card_id','=',$card->id)->where('parent','like','%u%')->where('node','like','%u%')->orderBy('id','asc')->get();
        
        //check that any nodes with a parent that does not have u but has u -- first row up
        $upper = Cardroad::where('card_id','=',$card->id)->where('parent','not like','%u%')->where('node','like','%u%')->orderBy('id','asc')->get();
        
        //check that parent is 0 - middle
        $middle = Cardroad::where('card_id','=',$card->id)->where('parent','=','0')->orderBy('id','asc')->get();


        //check that any nodes with a parent that does not have d but has d -- first row down
        $lower = Cardroad::where('card_id','=',$card->id)->where('parent','not like','%d%')->where('node','like','%d%')->orderBy('id','asc')->get();


        //check that nodes with a parent with a d that also has a d -- second row down.
        $bottom = Cardroad::where('card_id','=',$card->id)->where('parent','like','%d%')->where('node','like','%d%')->orderBy('id','asc')->get();

        //add arrays
        $top = json_encode($top);
        $upper = json_encode($upper);
        $middle = json_encode($middle);
        $lower = json_encode($lower);
        $bottom = json_encode($bottom);

        $road = json_encode(array_merge(json_decode($top, true),json_decode($upper, true),json_decode($middle, true),json_decode($lower, true),json_decode($bottom, true)));
        //get total gem count for the road
        //dd($road);

        $red_large = Cardroad::where('card_id','=',$card->id)->where('color','=','red')->where('large','!=','0')->sum('large');
        $red_medium = Cardroad::where('card_id','=',$card->id)->where('color','=','red')->where('medium','!=','0')->sum('medium');
        $red_small = Cardroad::where('card_id','=',$card->id)->where('color','=','red')->where('small','!=','0')->sum('small');

        $blue_large = Cardroad::where('card_id','=',$card->id)->where('color','=','blue')->where('large','!=','0')->sum('large');
        $blue_medium = Cardroad::where('card_id','=',$card->id)->where('color','=','blue')->where('medium','!=','0')->sum('medium');
        $blue_small = Cardroad::where('card_id','=',$card->id)->where('color','=','blue')->where('small','!=','0')->sum('small');

        $yellow_large = Cardroad::where('card_id','=',$card->id)->where('color','=','yellow')->where('large','!=','0')->sum('large');
        $yellow_medium = Cardroad::where('card_id','=',$card->id)->where('color','=','yellow')->where('medium','!=','0')->sum('medium');
        $yellow_small = Cardroad::where('card_id','=',$card->id)->where('color','=','yellow')->where('small','!=','0')->sum('small');

        return view('pages.card')
            ->with('dorifes_skill',$dorifes_skill)
            ->with('lesson_skill',$lesson_skill)
            ->with('u_dorifes_skill',$u_dorifes_skill)
            ->with('u_lesson_skill',$u_lesson_skill)            
            ->with('dorifes_skills',$dorifes_skills)
            ->with('lesson_skills',$lesson_skills)            
            ->with('boy',$boy)
            ->with('source',$source)
            ->with('road',$road)
            ->with('red_large',$red_large)
            ->with('red_medium',$red_medium)
            ->with('red_small',$red_small)
            ->with('blue_large',$blue_large)
            ->with('blue_medium',$blue_medium)
            ->with('blue_small',$blue_small)
            ->with('yellow_large',$yellow_large)
            ->with('yellow_medium',$yellow_medium)
            ->with('yellow_small',$yellow_small)  
            ->with('user_card',$user_card)      
            ->with('updated_by',$updated_by)  
            ->with('card_suggestion',$card_suggestion)              
            ->with('card',$card);
    } 


    /**
     * Show the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function idol($boy_id) {
        //can pass through an id or an url
        if (ctype_digit($boy_id)){
            $boy = Boy::where('id','=',$boy_id)->first();
        } else {
            $first_name = ucfirst($boy_id);
            $boy = Boy::where('first_name','=',$first_name)->first();
        }

        //when bad url is passed
        if (empty($boy)) {
            //want to go to 404 page 
            abort(404);
        }  

        $basic_cards = Card::where('boy_id','=',$boy->id)->where('game_id','=',2)->orderBy('place','DESC')->get();
        $cards = Card::where('boy_id','=',$boy->id)->where('game_id','=',1)->orderBy('place','ASC')->get();


        //skills, tie them to the cards
        foreach($cards as $key => $card) {
            $skill = Skill::select('english_description')->where('id','=',$card->dorifes_id)->first();
            //$test =  $skill->japanese_description;
            $cards[$key]->dorifes_skill = $skill['english_description'];
        }

        foreach($cards as $key => $card) {
            $skill = Skill::select('english_description')->where('id','=',$card->lesson_id)->first();
            //$test =  $skill->japanese_description;
            $cards[$key]->lesson_skill = $skill['english_description'];
        }

        $total_cards = count($cards);

        //only do all this if there are cards
        if ($total_cards > 1) {
              //need a blank template card for filling in the array
            //php 5+ passes objects by reference so $template = $cards[0] is not making a copy, need to clone it
            $template = clone $cards[0];
            //set up special senario blank card would have stars=0
            $template->stars = 0;
           
            //need to order cards by even and odd, first separate them
            foreach ($cards as $card) {
                if ($card->place %2 == 0) {
                    $even[] = $card;
                } else {
                    $odd[] = $card;
                }
            }

            //the ui has them in rows of 4, break them into pieces of 4
            $odd = array_chunk($odd,4);
            $even = array_chunk($even,4);

            //need to fill in the last chunks if they are less than four

            $slice_odd = array_slice($odd, -1);
            $last_odd = array_pop($slice_odd);

            $last_key_odd = key( array_slice($odd, -1, 1, TRUE));

             if (count($last_odd) < 4) {
                //add in the ones left
                for ($i=count($last_odd); $i < 4; $i++) { 
                   //add the missing pieces
                    $odd[$last_key_odd][$i] = $template;
                }
             }

             //need to fill in the last chunks if they are less than four
             $slice_even = array_slice($even, -1);
             $last_even = array_pop($slice_even);
             $last_key_even = key( array_slice($even, -1, 1, TRUE));

             //echo '<h2>last even count'.count($last_even).'</h2>';

             if (count($last_even) < 4) {
                //add in the ones left
                for ($i=count($last_even); $i < 4; $i++) { 
                   //add the missing pieces
                    $even[$last_key_even][$i] = $template;
                }
             }

             //combine them into one array
             for ($i=0; $i < count($odd); $i++) {   
                foreach($odd[$i] as $chunk) {
                    $final[] = $chunk;
                }

                if(isset($even[$i])) {
                    foreach($even[$i] as $chunk) {
                        $final[] = $chunk;
                    }                
                }
             }
       
         } else {
            $final = clone $cards;
         }

        //mini events
        $minievents = Minievent::where('boy_id','=',$boy_id)->get();

        foreach($minievents as $key => $event) {
            //get all three choices
            $choices = Minievent::find($event->id)->choices;
            $minievents[$key]->choices = $choices;
         }   

         //normal events
        // $events = Event::where('boy_id','=',$boy_id)->get();

        // foreach($events as $key => $event) {
        //     //get all three choices
        //     $choices = Event::find($event->id)->choices;
        //     $events[$key]->choices = $choices;
        //  }   

        // print '<pre>';
        // print_r($final);
        // print '</pre>';

        //get the characters stories
        $chapters = Chapterboy::where('boy_id','=',$boy->id)->get();


        return view('pages.idol')
            ->with('boy',$boy)
            ->with('cards',$final)
             ->with('basic_cards',$basic_cards)
            ->with('chapters',$chapters)
            ->with('minievents',$minievents);
            //->with('events',$events);
    }


    //////temporary data check! 
        /**
     * Show the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function idolData($boy_id) {
        //can pass through an id or an url
        if (ctype_digit($boy_id)){
            $boy = Boy::where('id','=',$boy_id)->first();
        } else {
            $first_name = ucfirst($boy_id);
            $boy = Boy::where('first_name','=',$first_name)->first();
        }

        //when bad url is passed
        if (empty($boy)) {
            //want to go to 404 page 
            abort(404);
        }  

        $cards = Card::where('boy_id','=',$boy->id)->where('da','=',0)->orderBy('place','ASC')->get();


        //skills, tie them to the cards
        foreach($cards as $key => $card) {
            $skill = Skill::select('english_description')->where('id','=',$card->dorifes_id)->first();
            //$test =  $skill->japanese_description;
            $cards[$key]->dorifes_skill = $skill['english_description'];
        }

        foreach($cards as $key => $card) {
            $skill = Skill::select('english_description')->where('id','=',$card->lesson_id)->first();
            //$test =  $skill->japanese_description;
            $cards[$key]->lesson_skill = $skill['english_description'];
        }

        $total_cards = count($cards);

        //only do all this if there are cards
        if ($total_cards > 1) {
              //need a blank template card for filling in the array
            //php 5+ passes objects by reference so $template = $cards[0] is not making a copy, need to clone it
            $template = clone $cards[0];
            //set up special senario blank card would have stars=0
            $template->stars = 0;
           
            //need to order cards by even and odd, first separate them
            foreach ($cards as $card) {
                if ($card->place %2 == 0) {
                    $even[] = $card;
                } else {
                    $odd[] = $card;
                }
            }

            //the ui has them in rows of 4, break them into pieces of 4
            $odd = array_chunk($odd,4);
            $even = array_chunk($even,4);

            //need to fill in the last chunks if they are less than four

            $slice_odd = array_slice($odd, -1);
            $last_odd = array_pop($slice_odd);

            $last_key_odd = key( array_slice($odd, -1, 1, TRUE));

             if (count($last_odd) < 4) {
                //add in the ones left
                for ($i=count($last_odd); $i < 4; $i++) { 
                   //add the missing pieces
                    $odd[$last_key_odd][$i] = $template;
                }
             }

             //need to fill in the last chunks if they are less than four
             $slice_even = array_slice($even, -1);
             $last_even = array_pop($slice_even);
             $last_key_even = key( array_slice($even, -1, 1, TRUE));

             //echo '<h2>last even count'.count($last_even).'</h2>';

             if (count($last_even) < 4) {
                //add in the ones left
                for ($i=count($last_even); $i < 4; $i++) { 
                   //add the missing pieces
                    $even[$last_key_even][$i] = $template;
                }
             }

             //combine them into one array
             for ($i=0; $i < count($odd); $i++) {   
                foreach($odd[$i] as $chunk) {
                    $final[] = $chunk;
                }

                if(isset($even[$i])) {
                    foreach($even[$i] as $chunk) {
                        $final[] = $chunk;
                    }                
                }
             }
       
         } else {
            $final = clone $cards;
         }

        //mini events
        $minievents = Minievent::where('boy_id','=',$boy_id)->get();

        foreach($minievents as $key => $event) {
            //get all three choices
            $choices = Minievent::find($event->id)->choices;
            $minievents[$key]->choices = $choices;
         }   

         //normal events
        // $events = Event::where('boy_id','=',$boy_id)->get();

        // foreach($events as $key => $event) {
        //     //get all three choices
        //     $choices = Event::find($event->id)->choices;
        //     $events[$key]->choices = $choices;
        //  }   

        // print '<pre>';
        // print_r($final);
        // print '</pre>';

        return view('pages.idol')
            ->with('boy',$boy)
            ->with('cards',$final)
            ->with('minievents',$minievents);
            //->with('events',$events);
    }





    /**
     * Show tags
     *
     * @return \Illuminate\Http\Response
     */
    public function tag($tag_name) {
        $tag = Tag::where('tag','=',$tag_name)->first();

        //when bad url is passed
        if (empty($tag)) {
            //want to go to 404 page 
            abort(404);
        }  

        $cards = CardTag::where('tag_id','=',$tag->id)->get();

        return view('pages.tag')
            ->with('tag',$tag)
            ->with('cards',$cards);
    }

    /**
     * Show skills
     *
     * @return \Illuminate\Http\Response
     */
    public function skill($skill_id) {
        $skill = Skill::where('id','=',$skill_id)->first();

        //when bad url is passed
        if (empty($skill)) {
            //want to go to 404 page 
            abort(404);
        }  



        //2018-04-045
        //so there are both the lesson and dorifes skill!
        if ($skill->skilltype_id == 2) {
            //its a lesson skill
             $cards = Card::where('lesson_id','=',$skill_id)->get();
        } else {
            //its a dorifes skill
             $cards = Card::where('dorifes_id','=',$skill_id)->get();
        }
       


        return view('pages.skill')
            ->with('skill',$skill)
            ->with('cards',$cards);
    }


    /**
     * Show skill in that category
     *
     * @return \Illuminate\Http\Response
     */
    public function skillCategory($category,$type,$size) {
        //would need to -> get all the skills in that set, then get all the cards with that skill

        //thats like the relationship building piece I need to figure out!

        //can just for loop for now?s

        if ($category = 'jewel') {
            $category = 'gem';
        }

        $skills = Skill::where('category','=','gem')->where('type','=',$type)->where('size','=',$size)->get();

        //when bad url is passed
        if ($skills->isEmpty()) {
            //want to go to 404 page 
            abort(404);
        }  

        foreach ($skills as $skill) {
            //lets use where in
            $in[] = $skill->id;
        }

        $cards = Card::whereIn('lesson_id',$in)->get();
        $skill = Skill::where('id','=',$in[0])->first();

        return view('pages.skill')
            ->with('skill',$skill)
            ->with('cards',$cards);
    }


    /**
     * Show classrooms
     *
     * @return \Illuminate\Http\Response
     */
    public function classroom($classroom_id) {
        //can pass through an id or an url
        if (ctype_digit($classroom_id)){
            $classroom = Classroom::where('id','=',$classroom_id)->first();
        } else {
            $classroom = Classroom::where('url','=',$classroom_id)->first();
        }

        //when bad url is passed
        if (empty($classroom)) {
            //want to go to 404 page 
            abort(404);
        }   

        $boys = Boy::where('classroom_id','=',$classroom->id)->get();

        return view('pages.classroom')
            ->with('classroom',$classroom)
            ->with('boys',$boys);
    }


    /**
     * Show units
     *
     * @return \Illuminate\Http\Response
     */
    public function unit($unit_id) {
        //can pass through an id or an url
        if (ctype_digit($unit_id)){
            $unit = Unit::where('id','=',$unit_id)->first();
        } else {
            $unit = Unit::where('url','=',$unit_id)->first();
        }

        //when bad url is passed
        if (empty($unit)) {
            //want to go to 404 page 
            abort(404);
        }           

        $boys = Boy::where('unit_id','=',$unit->id)->get();

        //$events = Unitevent::where('unit_id','=',$unit->id)->get();
        //this gets anything tagged with the group of that unit
        $events = Typegroup::where('type','=',1)->where('group','=','1')->where('group_id','=',$unit->id)->get();
        $scouts = Typegroup::where('type','=',2)->where('group','=','1')->where('group_id','=',$unit->id)->get();

        return view('pages.unit')
            ->with('unit',$unit)
            ->with('events',$events)
            ->with('scouts',$scouts)
            ->with('boys',$boys);
    }

    /**
     * Show all unit skills
     *
     * @return \Illuminate\Http\Response
     */
    public function unitskillAll() {
        $unit_skills = Unitskill::orderBy('type_id','asc')->orderBy('percent','desc')->get();

        foreach($unit_skills as $key => $skill) {
            $type = Type::where('id','=',$skill->type_id)->first();
            $unit_skills[$key]->type = $type['type'];


            //need to get the boys in that skill
            $unitboys = Unitskillboy::where('unitskill_id','=',$skill->id)->get();

            foreach ($unitboys as $boy) {
                //lets use where in
                $in[] = $boy->boy_id;
            }


            $unit_skills[$key]->boys = Boy::whereIn('id',$in)->get();           
            
            unset($in);
        }


        return view('pages.unitskillAll')
            ->with('unit_skills',$unit_skills);
    }  

    /**
     * Show all specific unit skill
     *
     * @return \Illuminate\Http\Response
     */
    public function unitskill($skill_id) {
        //can pass through an id or an url
        if (ctype_digit($skill_id)){
            $skill = Unitskill::where('id','=',$skill_id)->first();
        } else {
            $skill = Unitskill::where('url','=',$skill_id)->first();
        }

            //when bad event url is passed
            if (empty($skill)) {
                //want to go to 404 page 
                abort(404);
            }   

        //setup card color because its hardcoded and not an id like it should be - fix this eventually
        if ($skill->type_id == '1') {
            $color = 'red';
            $skill->type = 'Dance';
        } else if ($skill->type_id == '2') {
            $color = 'blue';
            $skill->type = 'Vocal';
        } else if ($skill->type_id == '3') {
            $color = 'yellow';
            $skill->type = 'Performance';
        } else {
            $color = '';
        }


        //need to get the boys in that skill
        $unitboys = Unitskillboy::where('unitskill_id','=',$skill->id)->get();

        foreach ($unitboys as $boy) {
            //lets use where in
            $in[] = $boy->boy_id;
        }


        $boys = Boy::whereIn('id',$in)->get();


        foreach ($boys as $key => $boy) {
            //get all the cards that match this unit skill
            $cards = Card::where('boy_id','=',$boy->id)->where('color','=',$color)->orderBy('stars','desc')->get();
            $boys[$key]->cards = $cards;
        }


        return view('pages.unitskill')
            ->with('skill',$skill)
            ->with('boys',$boys);
    } 


    /**
     * Show all scouts
     *
     * @return \Illuminate\Http\Response
     */
    public function scoutAll() {
        $scouts = Scout::orderBy('end','desc')->get();

        return view('pages.scoutAll')
            ->with('scouts',$scouts);
    }   

    /**
     * Show specigic scout
     *
     * @return \Illuminate\Http\Response
     */
    public function scout($url) {
        //can pass through an id or an url
        if (ctype_digit($url)){
            $scout = Scout::where('id','=',$url)->first();
        } else {
            $scout = Scout::where('url','=',$url)->first();
        }

            //when bad scout url is passed
            if (empty($scout)) {
                //want to go to 404 page 
                abort(404);
            }   

        // If the scout is pulling from already created cards, pull from Scoutcards
        if ($scout->type_id == '4') {
            $cards = Card::whereHas('scouts', function($query) use ($scout) {
                $query->where('scout_id','=',$scout->id);
            })->get();
        } else {
            $cards = Card::where('scout_id','=',$scout->id)->orderBy('stars','desc')->get();
        }


        if ($scout->type_id == 1) {
            //if its a scout
            //get the stories
            $story = Story::where('type_id','=',$scout->id)->where('type','=',2)->first();
            //chatpers
            if (isset($story->id)) {
                $chapters = Chapter::where('story_id','=',$story->id)->get();
            } else {
                $chapters = '';
            }
            
        } else {
            //its a character story scout
            //do something here??
            $story = '';
            $chapters = '';
        }

        return view('pages.scout')
            ->with('cards',$cards)
            ->with('story',$story)
            ->with('chapters',$chapters)
            ->with('scout',$scout);
    }  


    /**
     * Show all events
     *
     * @return \Illuminate\Http\Response
     */
    public function eventAll() {
        $events = Event::orderBy('end','desc')->get();

        //find user events if logged in
        $user = Auth::user();
        
        if (isset($user)) {
                 foreach($events as $key => $event) {
            //get all three choices
            $user_events = Userevent::where('user_id','=',Auth::user()->id)->where('event_id','=',$event->id)->first();
            $events[$key]->user_event = $user_events;
         }      
        }



    

        return view('pages.eventAll')
            ->with('events',$events);
    }   

    /**
     * Show specigic event
     *
     * @return \Illuminate\Http\Response
     */
    public function event($url) {
        //can pass through an id or an url
        if (ctype_digit($url)){
            $event = Event::where('id','=',$url)->first();
        } else {
            $event = Event::where('url','=',$url)->first();
        }

        //when bad event url is passed
        if (empty($event)) {
            //want to go to 404 page 
            abort(404);
        }

        //get the stories
        $story = Story::where('type_id','=',$event->id)->where('type','=',1)->first();
        //chatpers
        if (isset($story->id)) {
            $chapters = Chapter::where('story_id','=',$story->id)->get();
        } else {
            $chapters = '';
        }

        $cards = Card::where('event_id','=',$event->id)->orderBy('stars','desc')->get();
    
        //get the event points
        $points = Eventpoint::where('event_id','=',$event->id)->orderBy('created_at','desc')->first();
        //get rewards
        $rewards = Reward::all();

        //get the mini events
        $minievents = Minievent::where('event_id','=',$event->id)->orderBy('precedence','asc')->get();

        //get the event cards
        $eventcards = Eventcard::where('event_id','=',$event->id)->get();

        return view('pages.event')
            ->with('cards',$cards)
            ->with('story',$story)
            ->with('chapters',$chapters)
            ->with('points',$points)
            ->with('rewards',$rewards)
            ->with('minievents',$minievents)
            ->with('eventcards',$eventcards)
            ->with('event',$event);
    }    



    /**
     * Show specific Mini event
     *
     * @return \Illuminate\Http\Response
     */
    public function miniEvent($event_id) {
        $event_id = intval($event_id);

        $minievent = Minievent::find($event_id);

            //when bad minievent url is passed
            if (empty($minievent)) {
                //want to go to 404 page 
                abort(404);
            }   

        $event = Event::find($minievent->event_id);
        //get the slides
        $slides = Minieventslide::where('minievent_id','=',$minievent->id)->get();
        //choices
        $choices = Minieventchoice::where('minievent_id','=',$minievent->id)->orderBy('choice_id','asc')->get();

        //boy
        $boy = Boy::find($minievent->boy_id);
        //story
        $story = Story::where('type_id','=',$minievent->event_id)->where('type','=',1)->first();


        return view('pages.miniEvent')
            ->with('slides',$slides)
            ->with('story',$story)
            ->with('choices',$choices)
            ->with('boy',$boy)
            ->with('minievent',$minievent)
            ->with('event',$event);
    } 


    /**
     * Show event calculator, on hold version
     *
     * @return \Illuminate\Http\Response
     */

    public function eventCalculator() {

        return view('pages.eventCalculator');
    }


    /**
     * Show event calculator
     *
     * @return \Illuminate\Http\Response
     */
    // public function eventCalculator() {
    //     //need to figure out if there's a current event
    //      $event = Event::where('active','=','1')->first();

    //     // Catch for when there are no active events, eg unit collection
    //     // Need to just rework this eventually
    //      if (!isset($event->id)) {
    //         return view('pages.eventCalculator');
    //      }

    //      //get the url id of the cards that are in this event

    //      $urgent = Card::where('id','=',$event->points_4)->first();

    //      if ($urgent->color == 'yellow') {
    //         $urgent->button_color = 'warning';
    //      } else if ($urgent->color == 'red') {
    //         $urgent->button_color = 'danger';
    //      } else {
    //         $urgent->button_color = 'info';
    //      }

    //      //the halfway challenger will be the duplicate color card of the ranking 3 star
    //      $ranking_3 = Card::where('id','=',$event->rank_3)->first();

    //      //find the matching event card of that color
    //      if ($ranking_3->color == 'yellow') {
    //         $type = 'pf';
    //         $button_color = 'warning';
    //      } else if ($ranking_3->color == 'red') {
    //         $type = 'da';
    //         $button_color = 'danger';
    //      } else {
    //         $type = 'vo';
    //         $button_color = 'info';
    //      }


    //      function twitterClass($card_color) {
    //         if ($card_color == 'yellow') {
    //             $class = 'warning';
    //         } else if ($card_color == 'red') {
    //             $class = 'danger';
    //         } else {
    //             $class = 'info';
    //         }    
    //         return $class;
    //      }



    //      $halfwaycard = 'points_3_'.$type;


    //      $halfway = Card::where('id','=',$event->$halfwaycard)->first();
    //      $halfway->button_color = $button_color;


    //     $types[] = 'pf';
    //     $types[] = 'da';
    //     $types[] = 'vo';

    //     //remove the one it was
    //     if(($key = array_search($type, $types)) !== false) {
    //         unset($types[$key]);
    //     }

    //     //reset the keys
    //     $types = array_values($types);


    //     $first_card = 'points_3_'.$types[0];
    //     $first = Card::where('id','=',$event->$first_card)->first();
    //     $first->button_color = twitterClass($first->color);

    //     $second_card = 'points_3_'.$types[1];
    //     $second = Card::where('id','=',$event->$second_card)->first();
    //     $second->button_color = twitterClass($second->color);

    //     //can pass in url or id
    //    // $event = Event::where('id','=',$url)->first();

    //     // $stories = Story::where('event_id','=',$event->id)->first();

    //     // $chapters = Chapter::where('event_id',='',$event->id)->get();

    //     // foreach($chapters as $chapter) {
    //     //     //need to get all the slides.
    //     // }
    

    //     //need to pull users team if they are logged in
    //     if (!Auth::guest()) {
    //         //theyre logged in

    //         //what if theyre logged in but don't have a team saved
    //         $userteam = Userteam::where('user_id','=',Auth::id())->first();

    //         if (empty($userteam->id)) {
    //              $userteamcheck = 0;
    //         } else {
    //              $userteamcheck = 1;
    //         }


           
    //     } else {
    //         //set the deam to 0?
    //         $userteamcheck = 0;
    //         $userteam = '';
    //     }



    //     return view('pages.eventCalculator')
    //      ->with('userteam',$userteam)
    //      ->with('userteamcheck',$userteamcheck)
    //      ->with('event',$event)
    //      ->with('first',$first)
    //      ->with('second',$second)
    //      ->with('urgent',$urgent)
    //      ->with('halfway',$halfway);
    // }  





    ///collaboration/////

    /**
     * Show all collaborations
     *
     * @return \Illuminate\Http\Response
     */
    public function collaborationAll() {
        $collaborations = Collaboration::orderBy('end','desc')->get();

        return view('pages.collaborationAll')
            ->with('collaborations',$collaborations);
    }

    /**
     * Show specific collaboration
     *
     * @return \Illuminate\Http\Response
     */
    public function collaboration($url) {
        //can pass through an id or an url
        if (ctype_digit($url)){
            $collaboration = Collaboration::where('id','=',$url)->first();
        } else {
            $collaboration = Collaboration::where('url','=',$url)->first();
        }

        //when bad event url is passed
        if (empty($collaboration)) {
            //want to go to 404 page 
            abort(404);
        }

        $cards = Card::where('collaboration_id','=',$collaboration->id)->orderBy('stars','desc')->get();

        return view('pages.collaboration')
            ->with('cards',$cards)
            ->with('collaboration',$collaboration);
    }       

    /**
     * Show all unit collections
     *
     * @return \Illuminate\Http\Response
     */
    public function collectionAll() {
        $collections = Collection::orderBy('end','desc')->get();

        return view('pages.unitCollectionAll')
            ->with('collections',$collections);
    }

    /**
     * Show specific unit collection
     *
     * @return \Illuminate\Http\Response
     */
    public function collection($url) {
        //can pass through an id or an url
        if (ctype_digit($url)){
            $collection = Collection::where('id','=',$url)->first();
        } else {
            $collection = Collection::where('url','=',$url)->first();
        }

        // when bad url is passed
        if (empty($collection)) {
            //want to go to 404 page 
            abort(404);
        }

        $cards = Card::where('collection_id','=',$collection->id)->orderBy('stars','desc')->get();

        return view('pages.unitCollection')
            ->with('cards',$cards)
            ->with('collection',$collection);
    } 



    ////translations//////



    /**
     * Show all translations
     * this is duplicate code from main for now, can make this better
     *
     * @return \Illuminate\Http\Response
     */
    public function translation() {
        //stories that are complete
        $event_stories = Story::where('type','=',1)->where('active','=','1')->get();
        $scout_stories = Story::where('type','=',2)->where('active','=','1')->get();
        $character_stories = Story::where('type','=',3)->where('active','=','1')->get();

        //bad stories that are complete
        $event_stories_bad = Story::where('type','=',1)->where('name_j','!=','')->get();
        $scout_stories_bad = Story::where('type','=',2)->where('name_j','!=','')->get();
        $character_stories_bad = Story::where('type','=',3)->where('name_j','!=','')->get();  


        return view('pages.translation')
        ->with('event_stories',$event_stories)
        ->with('scout_stories',$scout_stories)
        ->with('character_stories',$character_stories)
        ->with('event_stories_bad',$event_stories_bad)
        ->with('scout_stories_bad',$scout_stories_bad)
        ->with('character_stories_bad',$character_stories_bad);
    }


    /**
     * Show all translations
     * this is duplicate code from main for now, can make this better
     *
     * @return \Illuminate\Http\Response
     */
    public function translationEvent() {
        //stories that are complete
        $event_stories = Story::where('type','=',1)->where('active','=','1')->get();

        return view('pages.translationEvent')
        ->with('event_stories',$event_stories);
    }


    /**
     * Show all translations
     * this is duplicate code from main for now, can make this better
     *
     * @return \Illuminate\Http\Response
     */
    public function translationScout() {
        //stories that are complete
        $scout_stories = Story::where('type','=',2)->where('active','=','1')->get();


        return view('pages.translationScout')
        ->with('scout_stories',$scout_stories);
    }



    /**
     * Show all translations
     * this is duplicate code from main for now, can make this better
     *
     * @return \Illuminate\Http\Response
     */
    public function translationCharacter() {
        //stories that are complete
        $character_stories = Story::where('type','=',3)->where('active','=','1')->get();


        return view('pages.translationCharacter')
        ->with('character_stories',$character_stories);
    }

    /**
     * Show specific story
     *
     * @return \Illuminate\Http\Response
     */
    public function story($story_id) {
        $story = Story::where('id','=',$story_id)->first();

        //when bad story url is passed
        if (empty($story)) {
            //want to go to 404 page 
            abort(404);
        }


        $chapters = Chapter::where('story_id','=',$story_id)->get();

        return view('pages.story')
        ->with('story',$story)
        ->with('chapters',$chapters);
    } 

    /**
     * Show specific chapter
     *
     * @return \Illuminate\Http\Response
     */
    public function chapter($story_id,$chapter,$generated='',$raw='') {
        $story = Story::where('id','=',$story_id)->first();

        //when bad story url is passed
        if (empty($story)) {
            //want to go to 404 page 
            abort(404);
        }

        $chapter_info = Chapter::where('story_id','=',$story_id)->where('chapter','=',$chapter)->first();

        //when bad chapter url is passed
        if (empty($chapter_info)) {
            //want to go to 404 page 
            abort(404);
        }

        $slides = Slide::where('chapter_id','=',$chapter_info->id)->get();

        //get the boy talking
        foreach($slides as $key => $slide) {
            $boy = Boy::where('id','=',$slide->boy_id)->first();
            $slides[$key]->boy_name = $boy['first_name'];

        }

        //figure out next and previous chapter
          //figur eout if next chapter is available

          $current_chapter = $chapter_info->chapter;

          $next_chapter = $current_chapter +1;

          $check_next = Chapter::where('story_id','=',$story->id)->where('chapter','=',$next_chapter)->where('complete','=',1)->first();

          $previous_chapter = $current_chapter -1;
          $check_previous = Chapter::where('story_id','=',$story->id)->where('chapter','=',$previous_chapter)->where('complete','=',1)->first();


        return view('pages.chapter')
        ->with('story',$story)
        ->with('chapter',$chapter_info)
        ->with('previous_chapter',$check_previous)
        ->with('next_chapter',$check_next)
        ->with('raw',$raw)
        ->with('generated',$generated)
        ->with('slides',$slides);
    } 




    /**
     * Show specific blog
     *
     * @return \Illuminate\Http\Response
     */
    public function blog($url) {
        $blog = Blog::where('url','=',$url)->first();

        //when bad blog url is passed
        if (empty($blog)) {
            //want to go to 404 page 
            abort(404);
        }

        $boys = Boy::where('classroom_id','!=','7')->orderBy('first_name','asc')->get();
        $teachers = Boy::where('classroom_id','=','7')->orderBy('first_name','asc')->get();

        return view('pages.blog')
        ->with('blog',$blog)
        ->with('boys',$boys)
        ->with('teachers',$teachers);
    } 


    /**
     * Show all blogss
     *
     * @return \Illuminate\Http\Response
     */
    public function blogAll() {
        //blogList in blogController does this kinda too
        $blogs = Blog::where('active','=',1)->orderBy('created_at','DESC')->get();


        return view('pages.blogAll')
        ->with('blogs',$blogs);
    } 


    //////store//////

        /**
     * Show store
     *
     * @return \Illuminate\Http\Response
     */
    public function store() {


        return view('pages.store');
    } 


    ////////contact page //////


    /**
     * Contact page
     *
     * @return \Illuminate\Http\Response
     */
    public function contact() {
        return view('pages.contact');
    }


    /**
     * Contact page - > send
     *  2018-07-08 - I tried to set this up as a mail controller, just added a UI like suggestions
     *
     * @return \Illuminate\Http\Response
     */
    public function contactSend(Request $request) {

        
        if ($request->enstars == 'Ensemble Stars') {

            //save who submitted it
            if (!Auth::guest()) {
                $submitted_by =  Auth::id();  
            } else {
                $submitted_by = 0;
            }


            $m = new Message;
            $m->status = 0;
            $m->name = $request->name;
            $m->email = $request->email;
            $m->message = $request->message;
            $m->submitted_by = $submitted_by;
            $m->updated_by = 0;
            $m->save();  

            // $to = 'info@enstars.info';
            // $subject = "enstars.info - New Message from ".$request->name;
            // $message = $request->message;
            // $headers = 'From: '.$request->email;     

            // mail($to,$subject,$message,$headers);
    
        }



        return view('pages.contactThankYou');
    }    

////////////////card error/////

        /**
     * Contact page
     *
     * @return \Illuminate\Http\Response
     */
    public function cardIssue($card_id) {
        $card = Card::find($card_id);

            if (empty($card)) {
                //want to go to 404 page 
                abort(404);
            }           


        return view('pages.cardIssue')
            ->with('card',$card);
    }


    /**
     * Contact page - > send
     *
     * @return \Illuminate\Http\Response
     */
    public function cardIssueSend(Request $request) {

        
        if ($request->enstars == '') {
            //save who submitted it
            if (!Auth::guest()) {
                $submitted_by =  Auth::id();  
            } else {
                $submitted_by = 0;
            }



            $m = new Cardissue;
            $m->status = 0;
            $m->card_id = $request->card_id;
            $m->message = $request->message;
            $m->submitted_by = $submitted_by;
            $m->save();  

            $to = 'info@enstars.info';
            $subject = "enstars.info - New Card Issue ".$request->card_id;
            $message = $request->message;

            mail($to,$subject,$message);
    
        }



        return view('pages.contactThankYou');
    }    


///////////// login bonus ///////////////////




     /**
     * Display all login bonus
     *
     * @return \Illuminate\Http\Response
     */
    public function loginBonusAll() {
        $all = Loginevent::all();

        return view('pages.loginBonusAll')
            ->with('all',$all);
    } 


     /**
     * Display all login bonus
     *
     * @return \Illuminate\Http\Response
     */
    public function loginBonus($bonus_id) {
        if (intval($bonus_id) < 1) {
            //its a name, find their id

            $find_id = Loginevent::where('url','=',$bonus_id)->first();
            $bonus_id = $find_id->id;
        } else {
            $bonus_id = intval($bonus_id);
        }     

          $event = Loginevent::find($bonus_id);
            //when bad event url is passed
            if (empty($event)) {
                //want to go to 404 page 
                abort(404);
            }          

          $days = Logineventday::where('event_id','=',$event->id)->get();


        return view('pages.loginBonus')
            ->with('event',$event)
            ->with('days',$days);
    } 


///////////graphs//////////////


    /**
     * Timeline of events and scouts
     *
     * @return \Illuminate\Http\Response
     */
    public function timeline() {

        $scouts = Scout::all();


        return view('pages.timeline')
        ->with('scouts',$scouts);
    } 

     /**
     * Show card release gnatt
     *
     * @return \Illuminate\Http\Response
     */
    public function cardsReleased() {
        return view('pages.cardsReleased');
    } 


 


    //might not technically be a graph in the end

    /**
     * predict future cards
     *
     * @return \Illuminate\Http\Response
     */
    public function cardPrediction($game = 1) {
        $boys = Boy::where('classroom_id','!=','7')->where('classroom_id','!=','10')->orderBy('first_name','asc')->get();

        if ($game == 'music') {
            $game = 3;
        } else if ($game == 'basic') {
            $game = 2;
        } else {
            $game = 1;
        }


        return view('pages.cardPrediction')
        ->with('game',$game)
         ->with('boys',$boys);
    } 


    /**
     * predict future cards - by color and time
     *
     * @return \Illuminate\Http\Response
     */
    public function cardFiveStarColor() {
        $boys = Boy::where('classroom_id','!=','7')->where('classroom_id','!=','10')->orderBy('first_name','asc')->get();

        $events = Event::orderBy('end','asc')->get();


        return view('pages.cardFivestarColor')
        ->with('events',$events)
         ->with('boys',$boys);
    } 

    /**
     * card list
     *
     * @return \Illuminate\Http\Response
     */
    public function cardList() {
        $cards = Card::all();



        return view('pages.cardList')
            ->with('cards',$cards);
    } 


    /**
     * Show the shop medal cards
     *
     * @return \Illuminate\Http\Response
     */
    public function starMedalShop() {
        // Okay how to grab these cards
        $cards = Cardsource::where('source_id','=',1)->get();

        return view('pages.starMedalShop')
            ->with('cards',$cards);
    }



    /////user area - not logged in

    /**
     * show users card collection 5 and 4 stars
     *
     * @return \Illuminate\Http\Response
     */
    public function userCollection($name) {
        ////this shares sql with userController->cards!!!!!!

        //get the userid from the name
        //can pass through an id or an url
        if (ctype_digit($name)){
            $user = User::where('id','=',$name)->first();
        } else {
            $user = User::where('name','=',$name)->first();
        }

        //when the user doesn't exist
        if (empty($user)) {
            //want to go to 404 page 
            abort(404);
        }    


        //check if they even have it public, otherwise reply with hidden view
        if ($user->display_collection == 0) {
         return view('pages.collectionHidden')
            ->with('user',$user);
            exit;
        }


        $card = new Card;
        $fivestarcardsq = $card->select('cards.*')->join('usercards','usercards.card_id','=','cards.id')->whereRaw("cards.stars='5'")->whereRaw('usercards.user_id = '.$user->id)->orderBy('usercards.created_at','desc');
        $fivestarcards = $fivestarcardsq->get();
        //$fivestarcards_count = $fivestarcardsq->count();

        //four star
        $fourstarcardsq = $card->select('cards.*')->join('usercards','usercards.card_id','=','cards.id')->whereRaw("cards.stars='4'")->whereRaw('usercards.user_id = '.$user->id)->orderBy('usercards.created_at','desc');
        $fourstarcards = $fourstarcardsq->get();
        //$fourstarcards_count = $fourstarcardsq->count();

 

       // dd($cards);


         return view('pages.collection')
            ->with('fivestarcards',$fivestarcards)
            ->with('fourstarcards',$fourstarcards)
            ->with('user',$user);

    }     


}
