<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Boy;
use App\Skill;
use App\Minievent;
use App\Minieventchoice;
use App\Event;

use App\Cardtag;
use App\Tag;
use App\Unit;

use App\Story;
use App\Chapter;
use App\Slide;

use App\Blog;

use App\Scout;

use App\Unitskill;
use App\Unitskillboy;
use App\Type;

use App\Message;

use App\User;
use App\Userevent;

use App\Eventpoint;
use App\Reward;

use Auth;


class DisplayController extends Controller {

    /**
     * Show the index
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $boys = Boy::where('class','!=','')->orderBy('first_name','asc')->get();
        $teachers = Boy::where('class','=','')->orderBy('first_name','asc')->get();
        $blogs = Blog::orderBy('created_at','desc')->where('active','=','1')->take(2)->get();
        $units = Unit::all();

        //stories that are complete
        $event_stories = Story::where('type','=',1)->where('active','=','1')->get();
        $gacha_stories = Story::where('type','=',2)->where('active','=','1')->get();
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
        $current_scout = Scout::where('active','=',1)->get();



        $reds = Skill::where('category','=','gem')->where('type','=','red')->get();
        $blues = Skill::where('category','=','gem')->where('type','=','blue')->get();
        $yellows = Skill::where('category','=','gem')->where('type','=','yellow')->get();
        $all= Skill::where('category','=','gem')->where('type','=','all')->get();


        return view('pages.main')
        ->with('boys',$boys)
        ->with('teachers',$teachers)
        ->with('units',$units)
        ->with('event_stories',$event_stories)
        ->with('gacha_stories',$gacha_stories)
        ->with('character_stories',$character_stories)
        ->with('tags',$tags)    
        ->with('reds',$reds)  
        ->with('red_medium',$red_medium)   
        ->with('blues',$blues)
        ->with('yellows',$yellows)
        ->with('all',$all)         
        ->with('current_event',$current_event)
        ->with('current_scout',$current_scout)           
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
        $gacha_stories = Story::where('type','=',2)->get();
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
            ->with('gacha_stories',$gacha_stories)
            ->with('character_stories',$character_stories)                                                                    
            ->with('boys',$boys);
   
    }

    /**
     * Show the birthdays.
     *
     * @return \Illuminate\Http\Response
     */
    public function birthdays() {
        $boys = Boy::all();

        return view('pages.birthdays')
            ->with('boys',$boys);
    }

       /**
     * Individual card page
     *
     * @return \Illuminate\Http\Response
     */
    public function card($card_id) {
        $card = Card::where('id','=',$card_id)->first();

        $boy = Boy::where('id','=',$card->boy_id)->first();

        //lesson skill
        if ($card->lesson_id == 0) {
            $lesson_skill = Skill::where('id','=',1)->first();
            $lesson_skill->id = '';
            $lesson_skill->english_description = 'Unkown';
        } else {
            $lesson_skill = Skill::where('id','=',$card->lesson_id)->first();
        }

        //dorifes skill
        if ($card->dorifes_id == 0) {
            $dorifes_skill = Skill::where('id','=',1)->first();
            $dorifes_skill->id = '';
            $dorifes_skill->english_description = 'Unkown';
        } else {
            $dorifes_skill = Skill::where('id','=',$card->dorifes_id)->first();
        }


        //get event or scout
        if ($card->event_id !=0) {
            $source = Event::where('id','=',$card->event_id)->first();
        } else if ($card->scout_id !=0) {
            $source = Scout::where('id','=',$card->scout_id)->first();
        } else {
            $source = '';
        }

        //for admins editing
        $lesson_skills = Skill::where('skilltype_id','=','2')->orderBy('category','ASC')->pluck('english_description','id');
        $dorifes_skills = Skill::where('skilltype_id','=','1')->orderBy('category','ASC')->pluck('english_description','id');


        return view('pages.card')
            ->with('dorifes_skill',$dorifes_skill)
            ->with('lesson_skill',$lesson_skill)
            ->with('dorifes_skills',$dorifes_skills)
            ->with('lesson_skills',$lesson_skills)            
            ->with('boy',$boy)
            ->with('source',$source)
            ->with('card',$card);
    } 


    /**
     * Show the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function idol($boy_id) {
        //if its their name, find their boy id
        if (intval($boy_id) < 1) {
            //its a name, find their id
            //format it
            $first_name = ucfirst($boy_id);

            $find_id = Boy::where('first_name','=',$first_name)->first();
            $boy_id = $find_id->id;
        }



        $boy = Boy::where('id','=',$boy_id)->first();
        $cards = Card::where('boy_id','=',$boy_id)->orderBy('place','ASC')->get();

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

        $cards = Card::where('lesson_id','=',$skill_id)->get();

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


        foreach ($skills as $skill) {
            //lets use where in
            $in[] = $skill->id;
        }

        $cards = Card::whereIn('lesson_id',$in)->get();
        $skill = Skill::where('id','=',$in[0])->first();

        // print '<pre>';
        // print_r($skill);
        // print '</pre>';

        return view('pages.skill')
            ->with('skill',$skill)
            ->with('cards',$cards);
    }

    /**
     * Show units
     *
     * @return \Illuminate\Http\Response
     */
    public function unit($unit_name) {
        $unit = Unit::where('name','=',$unit_name)->first();

        $boys = Boy::where('unit_id','=',$unit->id)->get();

        return view('pages.unit')
            ->with('unit',$unit)
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

        $cards = Card::where('scout_id','=',$scout->id)->orderBy('stars','desc')->get();
        
        
        if ($scout->type_id == 1) {
            //if its a gacha
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
        $points = Eventpoint::where('event_id','=',$event->id)->first();
        //get rewards
        $rewards = Reward::all();

        return view('pages.event')
            ->with('cards',$cards)
            ->with('story',$story)
            ->with('chapters',$chapters)
            ->with('points',$points)
            ->with('rewards',$rewards)
            ->with('event',$event);
    }    


    /**
     * Show event calculator
     *
     * @return \Illuminate\Http\Response
     */
    public function eventCalculator() {
        //need to figure out if there's a current event
         $event = Event::where('active','=','1')->first();


        //can pass in url or id
       // $event = Event::where('id','=',$url)->first();

        // $stories = Story::where('event_id','=',$event->id)->first();

        // $chapters = Chapter::where('event_id',='',$event->id)->get();

        // foreach($chapters as $chapter) {
        //     //need to get all the slides.
        // }
    

        return view('pages.eventCalculator')
         ->with('event',$event);
    }  

    /**
     * Show specific story
     *
     * @return \Illuminate\Http\Response
     */
    public function story($story_id) {
        $story = Story::where('id','=',$story_id)->first();
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
    public function chapter($story_id,$chapter) {
        $story = Story::where('id','=',$story_id)->first();
        $chapter_info = Chapter::where('story_id','=',$story_id)->where('chapter','=',$chapter)->first();
        $slides = Slide::where('chapter_id','=',$chapter_info->id)->get();

        //get the boy talking
        foreach($slides as $key => $slide) {
            $boy = Boy::where('id','=',$slide->boy_id)->first();
            $slides[$key]->boy_name = $boy['first_name'];

        }

        return view('pages.chapter')
        ->with('story',$story)
        ->with('chapter',$chapter_info)
        ->with('slides',$slides);
    } 




    /**
     * Show specific blog
     *
     * @return \Illuminate\Http\Response
     */
    public function blog($url) {
        $blog = Blog::where('url','=',$url)->first();
        $boys = Boy::where('class','!=','')->orderBy('first_name','asc')->get();
        $teachers = Boy::where('class','=','')->orderBy('first_name','asc')->get();

        return view('pages.blog')
        ->with('blog',$blog)
        ->with('boys',$boys)
        ->with('teachers',$teachers);
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
     *
     * @return \Illuminate\Http\Response
     */
    public function contactSend(Request $request) {

        $m = new Message;

        $m->name = $request->name;
        $m->email = $request->email;
        $m->message = $request->message;
        $m->updated_by = 0;
        $m->save();

        return view('pages.contactThankYou');
    }    


///////////graphs//////////////

        /**
     * Show card release gnatt
     *
     * @return \Illuminate\Http\Response
     */
    public function cardsReleased() {
        return view('pages.cardsReleased');
    } 


    /**
     * Line of event borders
     *
     * @return \Illuminate\Http\Response
     */
    public function eventHistory() {
        return view('pages.eventHistory');
    } 


    //might not technically be a graph in the end

    /**
     * predict future cards
     *
     * @return \Illuminate\Http\Response
     */
    public function cardPrediction() {
        $boys = Boy::where('class','!=','')->orderBy('first_name','asc')->get();

        //lul why didnt i figure this out before...dumb me
        // $boys->each(function ($boy) {
        //     $cards = $boy->cards()->where('stars','=','5')->get();




        //     $cards->each(function ($card) {
        //         $event = $card->event;
        //     });
        // });



        return view('pages.cardPrediction')
         ->with('boys',$boys);
    } 



}
