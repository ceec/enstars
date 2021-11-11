<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;

use Auth;

use App\Scout;
use App\Event;
use App\Skill;
use App\Boy;
use App\Cardsuggestion;
use App\Card;


class ScraperController extends Controller
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
     * Add scraper display
     *
     * @return \Illuminate\Http\Response
     */
    public function addDisplay()
    {

        return view('home.scraperAdd');
    }


    /**
     * Add scraper
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {

        //scrape
        $url = $request->input('url');
        $type = $request->input('type');

        $client = new Client();
        $crawler = $client->request('GET', $url);

        //get the japanese name
        $japanese_name = $crawler->filter('div.head-title')->text();

        $fulldate = $crawler->filter('div.date')->text();

        $dates = explode('~', $fulldate);

        foreach ($dates as $key => $date) {
            $date = trim($date);
            $date = str_replace('月', '-', $date);
            $date = str_replace('日', '', $date);
            //$dates[$key] = str_replace('','-',$date);
            $date = date('Y') . '-' . $date;

            $dates[$key] = $date;
        }

        $start_date = $dates[0];
        $end_date = $dates[1];


        $scraper['japanese_name'] = $japanese_name;
        $scraper['start_date'] = $dates[0];
        $scraper['end_date'] = $dates[1];
        $scraper['url'] = $url;
        $scraper['type'] = $type;

        return view('home.scraperAddStepTwo')
            ->with('scraper', $scraper);
    }

    /**
     * Add scraper
     *
     * @return \Illuminate\Http\Response
     */
    public function addStepTwo(Request $request)
    {

        $type = $request->input('type');
        $url = $request->input('website');

        if ($type != 4) {
            //they are scouts
            $s = new Scout;
            $s->active = 0;
            $s->name_j = $request->input('name_j');
            $s->name_e = '';
            $s->name_s = '';
            $s->type_id = $type;
            $s->start = $request->input('start');
            $s->end = $request->input('end');
            $s->text_j = '';
            $s->text = '';
            $s->website = $request->input('website');
            $s->url = $request->input('url');
            $s->updated_by = Auth::id();
            $s->save();

            $id = $s->id;

        } else {
            //its an event
        }

        $scraper['id'] = $id;
        $scraper['type'] = $type;

        //scrape all the card data, have the id now
        $client = new Client();
        $crawler = $client->request('GET', $url);

        //grab the icon
        $banner = $crawler->filter('strong.bannar img')->attr('src');
        $scraper['banner_image'] = str_replace('/index.html', '', $url) . substr($banner, 1);

        //now to grab all the cards

        //get the small images
        $scraper['small_images'] = $crawler->filter('div.thumb-nav a img')->each(function ($icons) {
            $baseurl = 'http://stars.happyelements.co.jp/app_help/gachas/144';

            $image = $icons->attr('src');
            $image = ltrim($image, '.');
            //print '<img src="'.$baseurl.$image.'">';
            return '<img src="' . $baseurl . $image . '">';

        });

        //get all the card info
        // Get the latest post in this category and display the titles
        $scraper['cards'] = $crawler->filter('dl.cardDetail')->each(function ($node) {
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

            //find the skill ids for the skills
            $skill = Skill::where('japanese_description', '=', $card['live_skill'])->first();
            $card['live_skill_id'] = $skill->id;

            $skill = Skill::where('japanese_description', '=', $card['lesson_skill'])->first();
            $card['lesson_skill_id'] = $skill->id;

            //get the boy id
            $japanese_name = str_replace(' ', '', $character);
            $boy = Boy::where('japanese_name', '=', $japanese_name)->first();
            $card['boy_id'] = $boy->id;

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


        //get the images from the raw JS
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


        //add in card images
        foreach ($scraper['cards'] as $key => $card) {
            //print $images[$key];
            $scraper['cards'][$key]['unbloomed'] = 'http://stars.happyelements.co.jp/app_help/gachas/144/images/cd_' . $images[$key] . '_n.png';
            $scraper['cards'][$key]['bloomed'] = 'http://stars.happyelements.co.jp/app_help/gachas/144/images/cd_' . $images[$key] . '_e.png';

            //lets insert into the temporary card table
            $s = new Cardsuggestion;
            $s->status = 0;
            $s->acard_id = 0;
            $s->boy_id = $card['boy_id'];

            // need to get the next card id and place
            $last_card = Card::where('boy_id', '=', $card['boy_id'])->orderBy('card_id', 'desc')->first();
            $card_id = $last_card->card_id + 1;

            $s->card_id = $card_id;
            $s->place = $card_id;

            //is there a way to get stars???
            $s->stars = 3;

            //is there a way to get color??
            //two ways either what stat is highest, or what type of live skill
            $colors['red'] = $card['da'];
            $colors['blue'] = $card['vo'];
            $colors['yellow'] = $card['pf'];
            $color = array_keys($colors, max($colors));
            $s->color = $color[0];

            $s->name_j = $card['title'];
            $s->name_e = '';
            $s->name_s = '';

            $s->da = 0;
            $s->vo = 0;
            $s->pf = 0;
            $s->da_max = $card['da'];
            $s->vo_max = $card['vo'];
            $s->pf_max = $card['pf'];
            $s->da_max5 = 0;
            $s->vo_max5 = 0;
            $s->pf_max5 = 0;

            //skills
            $s->dorifes_j = $card['live_name'];
            $s->dorifes_e = '';
            $s->dorifes_id = $card['live_skill_id'];

            $s->lesson_j = $card['lesson_name'];
            $s->lesson_e = '';
            $s->lesson_id = $card['lesson_skill_id'];

            //unleveled skills
            $s->u_dorifes_j = '';
            $s->u_dorifes_e = '';
            $s->u_lesson_j = '';
            $s->u_lesson_e = '';
            $s->u_dorifes_id = 74;
            $s->u_lesson_id = 75;

            $s->scout_id = $scraper['id'];
            $s->event_id = 0;
            //$s->collaboration_id = 0;

            $s->sentence_j = '';
            $s->sentence_e = '';
            $s->stories = 0;
            $s->suggested_name = '';
            $s->suggested_link = '';
            $s->updated_by = 1;
            $s->save();

        }

        return view('home.scraperAddStepThree')
            ->with('scraper', $scraper);
    }


    /**
     * Edit event
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //need to update event
        $e = Event::find($request->input('event_id'));
        $e->active = $request->input('active');
        $e->name_j = $request->input('japanese_name');
        $e->name_e = $request->input('english_name');
        $e->text = $request->input('text');
        $e->start = $request->input('start');
        $e->end = $request->input('end');
        $e->rank_5 = $request->input('rank_5');
        $e->rank_4 = $request->input('rank_4');
        $e->rank_3 = $request->input('rank_3');
        $e->points_5 = $request->input('points_5');
        $e->points_4 = $request->input('points_4');
        $e->points_3_da = $request->input('points_3_da');
        $e->points_3_vo = $request->input('points_3_vo');
        $e->points_3_pf = $request->input('points_3_pf');
        $e->updated_by = Auth::id();
        $e->save();


        return redirect('/event/' . $e->url);
    }

    /**
     * Edit event cards
     *
     * @return \Illuminate\Http\Response
     */
    public function editCard(Request $request)
    {
        //2019-03-31
        //New UI to add cards to events, for events that have 8+ cards
        //Going into eventcards instead of in the events table
        // the 5 start histroy graph also uses this for card sources

        $e = Event::find($request->input('event_id'));

        $ec = new Eventcard;
        $ec->card_id = $request->input('card_id');
        $ec->event_id = $request->input('event_id');
        $ec->type = $request->input('type');
        $ec->save();

        return redirect('/event/' . $e->url);
    }

}
