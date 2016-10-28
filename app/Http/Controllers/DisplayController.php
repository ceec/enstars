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
        ->with('blues',$blues)
        ->with('yellows',$yellows)
        ->with('all',$all)                    
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

        return view('pages.card')
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
    public function skillCategory($category,$size) {
        //would need to -> get all the skills in that set, then get all the cards with that skill

        //thats like the relationship building piece I need to figure out!

        //can just for loop for now?s

        $skill = Skill::where('id','=',$skill_id)->first();

        $cards = Card::where('lesson_id','=',$skill_id)->get();

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

        $cards = Card::where('scout_id','=',$scout->id)->get();

        return view('pages.scout')
            ->with('cards',$cards)
            ->with('scout',$scout);
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

        $cards = Card::where('event_id','=',$event->id)->get();
    

        return view('pages.event')
            ->with('cards',$cards)
            ->with('event',$event);
    }    


    /**
     * Show event calculator
     *
     * @return \Illuminate\Http\Response
     */
    public function eventCalculator() {
        //need to figure out if there's a current event

        //if there is, return that event info, 

        //or just gest last event, then crosscheck its end date, seems easier
        $event = Event::orderBy('created_at', 'desc')->first();


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

        $name = $request->name;
        $email = $request->email;
        $content = $request->message;

$headers = 'From: '.$email. "\r\n" .
    'Reply-To: '.$email. "\r\n" .
    'X-Mailer: PHP/' . phpversion();

        mail('info@enstars.info','New Contact Form from '.$name,$content,$headers);


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




}
