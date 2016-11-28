<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Usercard;
use App\Card;
use App\Story;
use App\Chapter;
use App\Slide;
use App\Boy;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //need to get that users cards

        //$usercards = Usercard::where('user_id','=',Auth::user()->id)->cards;

        //$cards = $usercards;

        $allcards = '';

        $cards = Usercard::where('user_id','=',Auth::user()->id)->get();

        foreach ($cards as $key => $card) {
            //get the card
            $card = Card::where('id','=',$card->card_id)->first();
            $allcards[] = $card;

        }

        return view('home')
        ->with('cards',$allcards);
    }


    /**
     * Show the album
     *
     * @return \Illuminate\Http\Response
     */
    public function album()
    {

        //this would mirror the in game one, can add/remove cards


        return view('home.album')
        ->with('cards',$allcards);
    } 

    /**
     * Show the translation page
     *
     * @return \Illuminate\Http\Response
     */
    public function translations() {
       $event_stories = Story::where('type','=',1)->get();
       $gacha_stories = Story::where('type','=',2)->get();
       $character_stories = Story::where('type','=',3)->get();

       //get the percentage of the stories
       foreach($event_stories as $key => $story) {
            //count how many are marked complete
            $amount_complete = Chapter::where('story_id','=',$story->id)->where('complete','=','1')->count();
            $amount_total = Chapter::where('story_id','=',$story->id)->count();

            if ($amount_total == 0) {
                $amount_total = 1;
            }
            $event_stories[$key]->percent = round(($amount_complete/$amount_total) * 100);            
       }

       //get the percentage of the stories
       foreach($gacha_stories as $key => $story) {
            //count how many are marked complete
            $amount_complete = Chapter::where('story_id','=',$story->id)->where('complete','=','1')->count();
            $amount_total = Chapter::where('story_id','=',$story->id)->count();

            if ($amount_total == 0) {
                $amount_total = 1;
            }
            $gacha_stories[$key]->percent = round(($amount_complete/$amount_total) * 100);            
       }


       //get the percentage of the stories
       foreach($character_stories as $key => $story) {
            //count how many are marked complete
            $amount_complete = Chapter::where('story_id','=',$story->id)->where('complete','=','1')->count();
            $amount_total = Chapter::where('story_id','=',$story->id)->count();

            if ($amount_total == 0) {
                $amount_total = 1;
            }
            $character_stories[$key]->percent = round(($amount_complete/$amount_total) * 100);            
       }

        return view('home.translation')
        ->with('event_stories',$event_stories)
        ->with('gacha_stories',$gacha_stories)
        ->with('character_stories',$character_stories);
    }  


    /**
     * Show the chapter list
     *
     * @return \Illuminate\Http\Response
     */
    public function translationStory($story_id) {

        $story = Story::where('id','=',$story_id)->first();
        $chapters = Chapter::where('story_id','=',$story_id)->get();

        //get percent complete
        foreach($chapters as $key => $chapter) {
            //count how many stories have something in the english text field
            $amount_complete = Slide::where('chapter_id','=',$chapter->id)->where('text_e','!=','')->count();
            $amount_total = Slide::where('chapter_id','=',$chapter->id)->count();

            if ($amount_total == 0) {
                $amount_total = 1;
            }
            $chapters[$key]->percent = round(($amount_complete/$amount_total) * 100);
        }

        return view('home.story')
        ->with('story',$story)
        ->with('chapters',$chapters);
    }  

    /**
     * Show the chapter's slides
     *
     * @return \Illuminate\Http\Response
     */
    public function translationChapter($story_id,$chapter_id) {
        $chapter = Chapter::where('id','=',$chapter_id)->first();
        $story = Story::where('id','=',$story_id)->first();
        $slides = Slide::where('chapter_id','=',$chapter_id)->get();
        //need list of the boys who could be talking
        $boys = Boy::orderBy('first_name','ASC')->pluck('first_name','id');


        //create percentages


        return view('home.chapter')
        ->with('chapter',$chapter)
        ->with('story',$story)
        ->with('boys',$boys)
        ->with('slides',$slides);
    }  

    /**
     * update the slide translation
     *
     * @return \Illuminate\Http\Response
     */
    public function addTranslation(Request $request) {
        $slide_id = $request->input('slide_id');
        $chapter_id = $request->input('chapter_id');
        $story_id = $request->input('story_id');

        $boy_id = $request->input('boy_id');
        if ($boy_id < 1) {
            $boy_id = 0;
        }


        //need to update slide
        $slide = Slide::find($slide_id);
        $slide->text_j = $request->input('text_j');
        $slide->text_e = $request->input('text_e');
        $slide->notes = $request->input('notes');
        $slide->boy_id = $boy_id;
        $slide->save();


         return redirect('/home/translations/'.$story_id.'/'.$chapter_id);      
    } 


    /**
     * update the slide translation WITH AJAX woop
     *
     * @return \Illuminate\Http\Response
     */
    public function addTranslationAjax(Request $request) {
        $slide_id = $request->input('slide_id');

        $field = $request->input('name');

        $value = $request->input('value');



        //need to update slide
        $slide = Slide::find($slide_id);

        //test this update

        $slide->$field = $value;
        $slide->save();



        echo json_encode($slide->updated_at);
    } 

    /**
     * update the slide translation WITH AJAX woop
     *
     * @return \Illuminate\Http\Response
     */
    public function chapterDisplay(Request $request) {
        $chapter_id = $request->input('chapter_id');

        $complete = $request->input('show');

        //need to update chapter
        $c = Chapter::find($chapter_id);

        //test this update

        $c->complete = $complete;
        $c->save();

        echo json_encode(array('chapter'=>$complete));
    } 


    /**
     * Show the tools page
     *
     * @return \Illuminate\Http\Response
     */
    public function tools() {
        return view('home.tool');
    }  

    /**
     * Adding slides - from tools page
     *
     * @return \Illuminate\Http\Response
     */
    public function addSlides(Request $request) {
        $chapter_id = $request->input('chapter_id');
        $amount = $request->input('amount');

        for ($i=1; $i <= $amount; $i++) { 
            //insert each of the slides
            $s = new Slide;
            $s->chapter_id = $chapter_id;
            $s->slide = $i;
            //$s->updated_by = Auth::
            $s->save();
        }
        
        return redirect('/home/translations/');      
    }


    /**
     * UI for editing CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function editCSS() {
        return view('home.editCSS');
    }        


    /**
     * save CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCSS(Request $request) {
        //update the file


        file_put_contents("./css/boy.css", $request->contents) or die("can't open file");

        echo json_encode(array('result'=>'saved'));
    }  

}
