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
use App\Eventpoint;
use App\Minievent;
use App\Minieventchoice;
use App\Minieventslide;
use App\Chapterboy;
use App\Cardsuggestion;
use App\Cardissue;
use App\Message;
use App\Event;
use App\Feature;
use App\Eventcard;
use App\Skill;
use App\Cardstat;

use Mail;

use Goutte\Client;

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
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //count suggestions
        $suggestions = Cardsuggestion::where('status', '=', 0)->count();
        //count issues
        $issues = Cardissue::where('status', '=', 0)->count();
        //count messages
        $messages = Message::where('status', '=', 0)->count();
        //count feature requests
        $features = Feature::where('status', '=', 0)->count();

        //count user states
        $userstotals = User::all()->count();
        //weekly users
        //lets use Carbon
        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
        \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);
        $now = \Carbon\Carbon::now();

        //make them strings not objects
        $startofday = $now->startOfDay()->toDateTimeString();
        $endofday = $now->endOfDay()->toDateTimeString();
        $startofweek = $now->startOfWeek()->toDateTimeString();
        $endofweek = $now->endOfWeek()->toDateTimeString();

        $usersweek = User::whereBetween('created_at', [$startofweek, $endofweek])->get()->count();

        //get todays
        $userstoday = User::whereBetween('created_at', [$startofday, $endofday])->get()->count();

        return view('home')
            ->with('userstotal', $userstotals)
            ->with('usersweek', $usersweek)
            ->with('userstoday', $userstoday)
            ->with('suggestions', $suggestions)
            ->with('messages', $messages)
            ->with('features', $features)
            ->with('issues', $issues);
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
            ->with('cards', $allcards);
    }


    /**
     * Translation status page
     *
     * @return \Illuminate\Http\Response
     */
    public function translationStatus()
    {
        //all the stories

        //events -> separate out by year

        //back to having issues with joins, WHY SO HARD
        //what do i want in the end -> chapter names, event info
        //$chapter = new Chapter;        
        //$event_2015 = $chapter->select('chapters.*')->join('events','events.id','=','chapters.event_id')->whereRaw("events.start < '2016-01-01'")->orderBy('events.start','asc')->get();


        // $event_2015 = Story::event()->where('start','<','2016-01-01')->get();

        $event_2015 = Event::where('start', '<', '2016-01-01')->get();


        $event_stories = Story::where('type', '=', 1)->get();
        $scout_stories = Story::where('type', '=', 2)->get();
        $character_stories = Story::where('type', '=', 3)->get();


        return view('home.translationStatus')
            ->with('event_stories', $event_stories)
            ->with('scout_stories', $scout_stories)
            ->with('character_stories', $character_stories);
    }

    /**
     * Show the translation page
     *
     * @return \Illuminate\Http\Response
     */
    public function translations()
    {
        $event_stories = Story::where('type', '=', 1)->get();
        $scout_stories = Story::where('type', '=', 2)->get();
        $character_stories = Story::where('type', '=', 3)->get();
        $main_stories = Story::where('type', '=', 4)->get();

        // TODO: This code is very repetitive.

        //get the percentage of the stories
        foreach ($event_stories as $key => $story) {
            //count how many are marked complete
            $amount_complete = Chapter::where('story_id', '=', $story->id)->where('complete', '=', '1')->count();
            $amount_total = Chapter::where('story_id', '=', $story->id)->count();

            if ($amount_total == 0) {
                $amount_total = 1;
            }
            $event_stories[$key]->percent = round(($amount_complete / $amount_total) * 100);
        }

        //get the percentage of the stories
        foreach ($scout_stories as $key => $story) {
            //count how many are marked complete
            $amount_complete = Chapter::where('story_id', '=', $story->id)->where('complete', '=', '1')->count();
            $amount_total = Chapter::where('story_id', '=', $story->id)->count();

            if ($amount_total == 0) {
                $amount_total = 1;
            }
            $scout_stories[$key]->percent = round(($amount_complete / $amount_total) * 100);
        }


        //get the percentage of the stories
        foreach ($character_stories as $key => $story) {
            //count how many are marked complete
            $amount_complete = Chapter::where('story_id', '=', $story->id)->where('complete', '=', '1')->count();
            $amount_total = Chapter::where('story_id', '=', $story->id)->count();

            if ($amount_total == 0) {
                $amount_total = 1;
            }
            $character_stories[$key]->percent = round(($amount_complete / $amount_total) * 100);
        }

        //get the percentage of the stories
        foreach ($main_stories as $key => $story) {
            //count how many are marked complete
            $amount_complete = Chapter::where('story_id', '=', $story->id)->where('complete', '=', '1')->count();
            $amount_total = Chapter::where('story_id', '=', $story->id)->count();

            if ($amount_total == 0) {
                $amount_total = 1;
            }
            $main_stories[$key]->percent = round(($amount_complete / $amount_total) * 100);
        }

        return view('home.translation')
            ->with('main_stories', $main_stories)
            ->with('event_stories', $event_stories)
            ->with('scout_stories', $scout_stories)
            ->with('character_stories', $character_stories);
    }


    /**
     * Show the chapter list
     *
     * @return \Illuminate\Http\Response
     */
    public function translationStory($story_id)
    {

        $story = Story::where('id', '=', $story_id)->first();
        $chapters = Chapter::where('story_id', '=', $story_id)->get();

        //get percent complete
        foreach ($chapters as $key => $chapter) {
            //count how many stories have something in the english text field
            $amount_complete = Slide::where('chapter_id', '=', $chapter->id)->where('text_e', '!=', '')->count();
            $amount_total = Slide::where('chapter_id', '=', $chapter->id)->count();

            //check for generated text
            $generated_check = Slide::where('chapter_id', '=', $chapter->id)->where('slide', '=', 2)->first();

            // dd($generated_check);


            if (isset($generated_check)) {
                if ($generated_check->text_g != '') {
                    $generated = true;
                } else {
                    $generated = false;
                }
            } else {
                $generated = false;
            }


            if ($amount_total == 0) {
                $amount_total = 1;
            }
            $chapters[$key]->percent = round(($amount_complete / $amount_total) * 100);
            $chapters[$key]->total_slides = $amount_total;
            $chapters[$key]->generated = $generated;
        }

        //get the mini events tied to this event
        $mini = Minievent::where('event_id', '=', $story->type_id)->orderBy('precedence', 'ASC')->get();

        return view('home.story')
            ->with('story', $story)
            ->with('mini', $mini)
            ->with('chapters', $chapters);
    }


    /**
     * Show the mini event's slides
     *
     * @return \Illuminate\Http\Response
     */
    public function translationMiniEvent($story_id, $minievent_id)
    {
        $minievent = Minievent::where('id', '=', $minievent_id)->first();
        $story = Story::where('id', '=', $story_id)->first();
        $slides = Minieventslide::where('minievent_id', '=', $minievent->id)->get();
        //get the boys info
        $boy = Boy::where('id', '=', $minievent->boy_id)->first();

        $choices = Minieventchoice::where('minievent_id', '=', $minievent->id)->orderBy('choice_id', 'asc')->get();


        return view('home.miniEvent')
            ->with('minievent', $minievent)
            ->with('choices', $choices)
            ->with('story', $story)
            ->with('boy', $boy)
            ->with('slides', $slides);
    }

    /**
     * Show the chapter's slides
     *
     * @return \Illuminate\Http\Response
     */
    public function translationChapter($story_id, $chapter_id)
    {
        $chapter_id = intval($chapter_id);

        $chapter = Chapter::where('id', '=', $chapter_id)->first();
        $story = Story::where('id', '=', $story_id)->first();
        $slides = Slide::where('chapter_id', '=', $chapter_id)->get();
        //need list of the boys who could be talking
        //$boys = CHap::orderBy('first_name','ASC')->pluck('first_name','id');

        //lets write a join
        $boy = new Boy;
        $boysq = $boy->select('boys.*')->join('chapterboys', 'chapterboys.boy_id', '=', 'boys.id')->whereRaw('chapterboys.chapter_id = ' . $chapter_id);
        $boys = $boysq->pluck('first_name', 'id');

        //create percentages


        return view('home.chapter')
            ->with('chapter', $chapter)
            ->with('story', $story)
            ->with('boys', $boys)
            ->with('slides', $slides);
    }

    /**
     * update the slide translation
     *
     * @return \Illuminate\Http\Response
     */
    public function addTranslation(Request $request)
    {
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
        $slide->updated_by = Auth::user()->id;
        $slide->save();


        return redirect('/home/translations/' . $story_id . '/' . $chapter_id);
    }


    /**
     * update the slide translation WITH AJAX woop
     *
     * @return \Illuminate\Http\Response
     */
    public function addTranslationAjax(Request $request)
    {
        $slide_id = $request->input('slide_id');

        $field = $request->input('name');

        $value = $request->input('value');


        //need to update slide
        $slide = Slide::find($slide_id);

        //test this update

        $slide->$field = $value;
        $slide->updated_by = Auth::user()->id;
        $slide->save();


        echo json_encode($slide->updated_at);
    }


    /**
     * update the minieevent translation WITH AJAX woop
     *
     * @return \Illuminate\Http\Response
     */
    public function addMiniEventTranslationAjax(Request $request)
    {
        $slide_id = $request->input('slide_id');

        $field = $request->input('name');

        $value = $request->input('value');

        $type = $request->input('type');

        if ($type == 'text') {
            $slide = Minieventslide::find($slide_id);
        } else {
            $slide = Minieventchoice::find($slide_id);
        }


        //need to update slide


        //test this update

        $slide->$field = $value;
        $slide->updated_by = Auth::user()->id;
        $slide->save();


        echo json_encode($slide->updated_at);
    }

    /**
     * update the slide translation WITH AJAX woop
     *
     * @return \Illuminate\Http\Response
     */
    public function chapterDisplay(Request $request)
    {
        $chapter_id = $request->input('chapter_id');

        $complete = $request->input('show');

        //need to update chapter
        $c = Chapter::find($chapter_id);

        //test this update

        $c->complete = $complete;
        $c->updated_by = Auth::user()->id;
        $c->save();

        echo json_encode(array('chapter' => $complete));
    }


    /**
     * update the chapter name with AJAX
     *
     * @return \Illuminate\Http\Response
     */
    public function chapterName(Request $request)
    {
        $chapter_id = $request->input('chapter_id');

        $name_e = $request->input('name_e');

        //need to update chapter
        $c = Chapter::find($chapter_id);

        //test this update

        $c->name_e = $name_e;
        $c->updated_by = Auth::user()->id;
        $c->save();

        echo json_encode(array('chapter' => $complete));
    }


    // Menu Translation area

    /**
     * Display for menu translations
     *
     * @return \Illuminate\Http\Response
     */
    public function translationMenu()
    {
        return view('home.translationMenu');
    }


    /**
     * Actually Show the tools page
     *
     * @return \Illuminate\Http\Response
     */
    public function tools()
    {
        return view('home.tools');
    }

    /**
     * UI for generating chapter slides
     *
     * @return \Illuminate\Http\Response
     */
    public function toolAddSlides()
    {
        //return a list of all the boys
        $boys = Boy::orderBy('first_name', 'ASC')->pluck('first_name', 'id');

        return view('home.toolAddSlides')
            ->with('boys', $boys);
    }

    /**
     * UI for adding generated text
     *
     * @return \Illuminate\Http\Response
     */
    public function toolAddGeneratedText()
    {
        //return a list of all the boys
        $boys = Boy::orderBy('first_name', 'ASC')->pluck('first_name', 'id');

        return view('home.toolAddGeneratedText')
            ->with('boys', $boys);
    }

    /**
     *  Tools - Card Split
     *  Breaks the information from cards into cardstats
     *
     * @return \Illuminate\Http\Response
     */
    public function toolCardSplit()
    {
        ini_set('max_execution_time', 180); //3 minutes
        // grab all the info from cards

        $cards = Card::all();
        foreach ($cards as $card) {

            // Figure out the type for type id
            $color = $card->color;
            if ($color == 'red') {
                $type = 1;
            } else if ($color == 'blue') {
                $type = 2;
            } else if ($color == 'yellow') {
                $type = 3;
            } else {
                // There shouldnt be any here but just in case
                $type = 0;
            }


            // Make a new card stat
            $s = new Cardstat;
            $s->card_id = $card->id;
            $s->game_id = $card->game_id;
            $s->type_id = $type;
            $s->da = $card->da;
            $s->vo = $card->vo;
            $s->pf = $card->pf;
            $s->gr = 0;
            $s->da_max = $card->da_max;
            $s->vo_max = $card->vo_max;
            $s->pf_max = $card->pf_max;
            $s->gr_max = 0;
            $s->da_max5 = $card->da_max5;
            $s->vo_max5 = $card->vo_max5;
            $s->pf_max5 = $card->pf_max5;
            $s->gr_max5 = 0;
            $s->u_dorifes_id = $card->u_dorifes_id;
            $s->u_dorifes_j = '';
            $s->u_dorifes_e = '';
            $s->dorifes_id = $card->dorifes_id;
            $s->dorifes_j = '';
            $s->dorifes_e = '';
            $s->u_lesson_id = $card->u_lesson_id;
            $s->u_lesson_j = '';
            $s->u_lesson_e = '';
            $s->lesson_id = $card->lesson_id;
            $s->lesson_j = '';
            $s->lesson_e = '';
            $s->save();

            // Create an entry for music cards if the card is a basic card
            if ($card->game_id == 2) {
                $s = new Cardstat;
                $s->card_id = $card->id;
                $s->game_id = 3;
                $s->type_id = 0;
                $s->da = 0;
                $s->vo = 0;
                $s->pf = 0;
                $s->gr = 0;
                $s->da_max = 0;
                $s->vo_max = 0;
                $s->pf_max = 0;
                $s->gr_max = 0;
                $s->da_max5 = 0;
                $s->vo_max5 = 0;
                $s->pf_max5 = 0;
                $s->gr_max5 = 0;
                $s->u_dorifes_id = 0;
                $s->u_dorifes_j = '';
                $s->u_dorifes_e = '';
                $s->dorifes_id = 0;
                $s->dorifes_j = '';
                $s->dorifes_e = '';
                $s->u_lesson_id = 0;
                $s->u_lesson_j = '';
                $s->u_lesson_e = '';
                $s->lesson_id = 0;
                $s->lesson_j = '';
                $s->lesson_e = '';
                $s->save();
            }
        }
    }


    /**
     * Filling the eventcards table - from tools page
     *
     * @return \Illuminate\Http\Response
     */
    public function toolCreateEventCards()
    {
        //ok all the events
        $events = Event::all();
        foreach ($events as $event) {
            $ec = new EventCard;
            $ec->event_id = $event->id;
            $ec->card_id = $event->rank_5;
            $ec->type = 'Ranking';
            $ec->save();

            $ec = new EventCard;
            $ec->event_id = $event->id;
            $ec->card_id = $event->rank_4;
            $ec->type = 'Ranking';
            $ec->save();

            $ec = new EventCard;
            $ec->event_id = $event->id;
            $ec->card_id = $event->rank_3;
            $ec->type = 'Ranking';
            $ec->save();

            $ec = new EventCard;
            $ec->event_id = $event->id;
            $ec->card_id = $event->points_5;
            $ec->type = 'Points';
            $ec->save();

            $ec = new EventCard;
            $ec->event_id = $event->id;
            $ec->card_id = $event->points_4;
            $ec->type = 'Points';
            $ec->save();

            $ec = new EventCard;
            $ec->event_id = $event->id;
            $ec->card_id = $event->points_3_da;
            $ec->type = 'Points';
            $ec->save();

            $ec = new EventCard;
            $ec->event_id = $event->id;
            $ec->card_id = $event->points_3_vo;
            $ec->type = 'Points';
            $ec->save();

            $ec = new EventCard;
            $ec->event_id = $event->id;
            $ec->card_id = $event->points_3_pf;
            $ec->type = 'Points';
            $ec->save();
        }

        return redirect('/home/tools/');
    }

    /**
     * Tools - Scraper
     * TODO: make a tools controller
     *
     * @return \Illuminate\Http\Response
     */
    public function scraper()
    {
        //lets try just getting the images first
        $url = 'http://stars.happyelements.co.jp/app_help/gachas/149/index.html';

        $all = file_get_contents($url);

        $images = strstr($all, '</head>', TRUE);

        $images = strstr($images, 'img_names');

        $images = strstr($images, '}', TRUE);
        $images = strstr($images, "{");
        $images = str_replace('{', '', $images);
        //
        $images = explode(',', $images);
        array_pop($images);

        foreach ($images as $key => $image) {
            $image = str_replace("'", "", $image);
            $image = trim($image);
            $image = substr($image, 3);
            $image = trim($image, "'");
            $images[$key] = $image;
        }

        //dd($images);
        //http://stars.happyelements.co.jp/app_help/events/95/images/cd_tblrdosz_n.png

        //just need to get the da,vo,pf values
        $client = new Client();

        // Go to the symfony.com website
        $crawler = $client->request('GET', $url);

        //get the bannar image
        $banner = $crawler->filter('strong.bannar img')->attr('src');

        $banner_image = str_replace('/index.html', '', $url) . substr($banner, 1);

        // dd($banner_image);


        //get the icon images
        $crawler->filter('div.thumb-nav a img')->each(function ($icons) {
            $baseurl = 'http://stars.happyelements.co.jp/app_help/gachas/149';

            $image = $icons->attr('src');
            $image = ltrim($image, '.');
            print '<img src="' . $baseurl . $image . '">';

        });

        // Get the latest post in this category and display the titles
        $cards = $crawler->filter('dl.cardDetail')->each(function ($node) {

            $baseurl = 'http://stars.happyelements.co.jp/app_help/events/99';
            //create a counter to match with the images array
            //images
            //looks like in the source itself the image is indeed just /
            //the actual urls come from JS
            //
            //$unbloomed = $node->filter('dt.cardDetail-image img')->attr('src');
            //the card names are in JS at the top of the script
            //$card_image = 'gboplxfd';
            //print '<img src="http://stars.happyelements.co.jp/app_help/events/94/images/cd_'.$card_image.'_n.png>';

            // print '<img src="http://stars.happyelements.co.jp/app_help/events/95/images/cd_'.$images[$imagecount].'_n.png">';
            // print '<img src="http://stars.happyelements.co.jp/app_help/events/95/images/cd_'.$images[$imagecount].'_e.png">';

            $fulltitle = $node->filter('h4.head-name')->text();

            $pieces = explode(']', $fulltitle);

            $title = str_replace('[', '', $pieces[0]);
            $character = $pieces[1];

            $da = $node->filter('div.ability-wrap dd:nth-child(2)')->text();
            $vo = $node->filter('div.ability-wrap dd:nth-child(4)')->text();
            $pf = $node->filter('div.ability-wrap dd:nth-child(6)')->text();

            //remove comma
            $da = str_replace(',', '', $da);
            $vo = str_replace(',', '', $vo);
            $pf = str_replace(',', '', $pf);

            $live = $node->filter('dl.live > dd')->text();
            $live = explode(':', $live);
            $live_name = $live[0];
            $live_skill = $live[1];

            $lesson = $node->filter('dl.lesson > dd')->text();
            $lesson = explode(':', $lesson);
            $lesson_name = $lesson[0];
            $lesson_skill = $lesson[1];

            $card = [];
            $card['boy'] = $character;
            $card['title'] = $title;
            $card['da'] = $da;
            $card['vo'] = $vo;
            $card['pf'] = $pf;
            $card['live_name'] = $live_name;
            $card['live_skill'] = $live_skill;
            $card['lesson_name'] = trim($lesson_name);
            $card['lesson_skill'] = trim($lesson_skill);

            $card = array_map('trim', $card);

            // print '<pre>';
            // print_r($card);
            // print '</pre>';

            //find the skill ids for the skills
            $skill = Skill::where('japanese_description', '=', $card['live_skill'])->first();
            $card['live_skill_id'] = $skill->id;

            $skill = Skill::where('japanese_description', '=', $card['lesson_skill'])->first();
            $card['lesson_skill_id'] = $skill->id;

            //costumes
            $costumes = $node->filter('li.itemList')->each(function ($outfit) {
                $outfits[] = $outfit->text();

                return $outfits;
            });

            //flatten
            foreach ($costumes as $costume) {
                foreach ($costume as $morecostume) {
                    $outfits[] = $morecostume;
                }
            }

            //not every card has outfits
            if (isset($outfits)) {
                foreach ($outfits as $outfit) {
                    $card['outfits'][] = trim($outfit);
                }
            }

            return $card;

        });
        print '<hr>';
        // print '<pre>';
        // print_r($cards);
        // print '</pre>';

        $baseurl = 'http://stars.happyelements.co.jp/app_help/gachas/149';

        //add in card images
        foreach ($cards as $key => $card) {
            //print $images[$key];
            print '<img src="' . $baseurl . '/images/cd_' . $images[$key] . '_n.png">';
            print '<img src="' . $baseurl . '/images/cd_' . $images[$key] . '_e.png">';
            print '<pre>';
            print_r($card);
            print '</pre>';
            print '<hr>';
        }


    }


    /**
     * Testing Email
     *
     * @return \Illuminate\Http\Response
     */
    public function emailTest()
    {

        $email = env('MAIL_ADDRESS');

        Mail::to($email)->send('test');

        return redirect('/home/tools/');

    }


    /**
     * Show the event Data page
     *
     * @return \Illuminate\Http\Response
     */
    public function eventData()
    {
        //get the current event
        $current_event = Event::where('active', '=', 1)->first();

        return view('home.eventData')
            ->with('current_event', $current_event);
    }


    /**
     * adding the data
     *
     * @return \Illuminate\Http\Response
     */
    public function addEventData(Request $request)
    {
        $d = new Eventpoint;

        $d->event_id = $request->event_id;
        $d->position = 0;
        $d->participants = $request->participants;
        $d->rank_1 = $request->rank_1;
        $d->tier_1 = $request->tier_1;
        $d->rank_2 = $request->rank_2;
        $d->tier_2 = $request->tier_2;
        $d->rank_3 = $request->rank_3;
        $d->tier_3 = $request->tier_3;
        $d->rank_4 = $request->rank_4;
        $d->tier_4 = $request->tier_4;
        $d->rank_5 = $request->rank_5;
        $d->tier_5 = $request->tier_5;
        $d->rank_6 = $request->rank_6;
        $d->tier_6 = $request->tier_6;
        $d->rank_7 = $request->rank_7;
        $d->tier_7 = $request->tier_7;
        $d->rank_8 = $request->rank_8;
        $d->tier_8 = $request->tier_8;
        $d->rank_9 = $request->rank_9;
        $d->tier_9 = $request->tier_9;
        $d->rank_10 = $request->rank_10;
        $d->tier_10 = $request->tier_10;
        $d->rank_11 = $request->rank_11;
        $d->tier_11 = $request->tier_11;
        $d->rank_12 = 0;
        $d->tier_12 = 0;
        $d->rank_13 = 0;
        $d->tier_13 = 0;
        $d->rank_14 = 0;
        $d->tier_14 = 0;
        $d->rank_15 = 0;
        $d->tier_15 = 0;
        $d->rank_16 = 0;
        $d->tier_16 = 0;
        $d->rank_17 = 0;
        $d->tier_17 = 0;
        $d->rank_18 = 0;
        $d->tier_18 = 0;
        $d->rank_19 = 0;
        $d->tier_19 = 0;
        $d->rank_max = 300000;
        $d->updated_by = Auth::user()->id;
        //normalize to JST    
        date_default_timezone_set('Asia/Tokyo');
        $d->jst_created_at = date("Y-m-d H:i:s");

        // calculate the normalized date
        $event = Event::find($request->event_id);
        $start = new \DateTime($event->start);
        $current = new \DateTime($d->jst_created_at);
        $difference = $start->diff($current);
        $days = $difference->d;
        // get the current time
        $time = substr($d->jst_created_at, -8);
        //account for first day being 0th
        $days = $days + 1;
        // deal with padding
        if ($days < 10) {
            $days = '0' . $days;
        }
        $normalized_date = '2000-01-' . $days . ' ' . $time;
        $d->normalized_date = $normalized_date;
        date_default_timezone_set('UTC');
        $d->save();

        return redirect('/home');
    }


    /**
     * Adding slides - from tools page
     *
     * @return \Illuminate\Http\Response
     */
    public function addSlides(Request $request)
    {
        $chapter_id = $request->input('chapter_id');
        $boys = $request->input('boys');
        $amount = $request->input('amount');

        for ($i = 1; $i <= $amount; $i++) {
            //insert each of the slides
            $s = new Slide;
            $s->chapter_id = $chapter_id;
            $s->slide = $i;
            //$s->updated_by = Auth::
            $s->save();
        }

        //add the boys to this chapter
        if (is_array($boys)) {
            foreach ($boys as $boy) {
                $c = new Chapterboy;
                $c->chapter_id = $chapter_id;
                $c->boy_id = $boy;
                $c->updated_by = Auth::user()->id;
                $c->save();
            }
        }


        return redirect('/home/translations/');
    }


    /**
     * Adding generated text - from tools page
     *
     * @return \Illuminate\Http\Response
     */
    public function addGeneratedText(Request $request)
    {
        $chapter_id = $request->input('chapter_id');
        $text = $request->input('text_g');

        //need to parse $text into JSON
        $data = json_decode($text);

        foreach ($data as $slide) {
            $c = Slide::where('chapter_id', '=', $chapter_id)->where('slide', '=', $slide->id)->first();
            $c->text_g = $slide->english;
            $c->text_j = $slide->japanese;
            $c->save();
        }


        return redirect('/home/tools/');
    }

    /**
     * UI for editing CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function editCSS()
    {
        return view('home.editCSS');
    }


    /**
     * save CSS
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCSS(Request $request)
    {
        //update the file


        file_put_contents("./css/boy.css", $request->contents) or die("can't open file");

        echo json_encode(array('result' => 'saved'));
    }


    /////emails

    /**
     * view emails
     *
     * @return \Illuminate\Http\Response
     */
    public function messages()
    {
        //get all the messages
        $messages = Message::where('status', '=', 0)->orderBy('created_at', 'desc')->get();

        return view('home.messages')
            ->with('messages', $messages);
    }


    /**
     * clear message
     *
     * @return \Illuminate\Http\Response
     */
    public function messageClear(Request $request)
    {
        //clear the message

        $message = Message::find($request->message_id);

        $message->status = 1;

        $message->save();

        return redirect('/home/messages/');
    }


    /**
     * delete message
     *
     * @return \Illuminate\Http\Response
     */
    public function messageDelete(Request $request)
    {
        //clear the message

        $message = Message::find($request->message_id);
        $message->delete();

        return redirect('/home/messages/');
    }

    /////suggestions

    /**
     * view suggestions
     *
     * @return \Illuminate\Http\Response
     */
    public function suggestions()
    {
        //get all the suggestions
        $suggestions = Cardsuggestion::where('status', '=', 0)->get();


        return view('home.suggestions')
            ->with('suggestions', $suggestions);
    }

    /**
     * clear suggestions
     *
     * @return \Illuminate\Http\Response
     */
    public function suggestionClear(Request $request)
    {
        //clear the suggestion

        $suggestion = Cardsuggestion::find($request->suggestion_id);

        $suggestion->status = 1;

        $suggestion->save();

        return redirect('/home/suggestions/');
    }


    /////features

    /**
     * view features
     *
     * @return \Illuminate\Http\Response
     */
    public function features()
    {
        //get all the messages
        $features = Feature::where('status', '=', 0)->orderBy('created_at', 'desc')->get();

        return view('home.features')
            ->with('features', $features);
    }


    /**
     * clear feature request
     *
     * @return \Illuminate\Http\Response
     */
    public function featureApprove(Request $request)
    {
        //clear the message

        $message = Feature::find($request->feature_id);

        $message->status = 1;

        $message->save();

        return redirect('/home/features');
    }


    /**
     * delete feature request
     *
     * @return \Illuminate\Http\Response
     */
    public function featureDelete(Request $request)
    {
        //clear the feature

        $message = Feature::find($request->feature_id);
        $message->delete();

        return redirect('/home/features');
    }





///card issues

    /**
     * view issues
     *
     * @return \Illuminate\Http\Response
     */
    public function cardIssues()
    {
        //get all the issues
        $issues = Cardissue::where('status', '=', 0)->orderBy('created_at', 'desc')->get();


        return view('home.cardissues')
            ->with('issues', $issues);
    }

    /**
     * clear issues
     *
     * @return \Illuminate\Http\Response
     */
    public function cardIssueClear(Request $request)
    {
        //clear the issue

        $issue = Cardissue::find($request->issue_id);

        $issue->status = 1;

        $issue->save();

        return redirect('/home/cardissues/');
    }


}
