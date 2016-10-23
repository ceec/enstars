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


class DataController extends Controller {

    /**
     * generate the card release gantt, this should be generating the DATA for the gannt, gannt display should be other page.
     *
     * @return \Illuminate\Http\Response
     */
    public function cardsReleased() {
        //get all the boys
        $boys = Boy::where('class','!=','')->orderBy('first_name','asc')->get();

        //would need to get all the events in chronological order
       //$scouts = Scout::orderBy('start','asc')->get();


        // {
        //     "category": "Koga",
        //     "segments": [{
        //       "start": "2016-10-15",
        //       "end": "2016-10-25",
        //       "task": "Rockin Star"
        //     },
        //         {
        //       "start": "2016-10-15",
        //       "end": "2016-10-25",
        //       "task": "Rockin Star"
        //     }]


        //want to look like above - need to have it do the boy first then go through each boy and find their events

        foreach ($boys as $boy) {
            //need to start the array here
            $result['category'] = $boy->first_name;

            //get all the cards
            $cards = Card::where('boy_id','=',$boy->id)->get();
            foreach($cards as $card) {
                //get the info
                $boy = Boy::where('id','=',$card->boy_id)->first();

                if ($card->scout_id != 0) {
                    //get that scout
                    $scout = Scout::where('id','=',$card->scout_id)->first();
                    
                    $dates[$card->id]['start'] = date('Y-m-d',strtotime($scout->start));
                    $dates[$card->id]['end'] = date('Y-m-d',strtotime($scout->end));
                    $dates[$card->id]['task'] = $scout->name_e;
                                     
                }


            }

            $result['segments'] = array_values($dates);

            $main[] = $result;
            unset($result);
            $result = array();

            unset($dates);
            $dates = array();
        } //end boys

            // print '<pre>';
            // print_r($main);
            // print '</pre>';

        //barf out appropriate json here
        //how should do this
        // foreach($scouts as $scout) {
        //     //get the boys in that scout
        //     $cards = Card::where('scout_id','=',$scout->id)->get();
        //     $x=0;
        //     foreach($cards as $card) {
        //         //get the info
        //         $boy = Boy::where('id','=',$card->boy_id)->first();


        //         $result['category'] = $boy->first_name;
        //         $result['segments'][$x]['start'] = date('Y-m-d',strtotime($scout->start));
        //         $result['segments'][$x]['end'] = date('Y-m-d',strtotime($scout->end));
        //         $result['segments'][$x]['task'] = $scout->name_e;

        //         $main[] = $result;
        //         $x += $x;
        //     }
        // }


        echo json_encode($main);

    } 



}
