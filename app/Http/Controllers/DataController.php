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
use App\Eventpoint;

use App\Cardroad;


class DataController extends Controller {

    /**
     * generate the card release gantt, this should be generating the DATA for the gannt, gannt display should be other page.
     *
     * @return \Illuminate\Http\Response
     */
    public function cardsReleased() {
        //get all the boys
        $boys = Boy::where('classroom_id','!=','7')->orderBy('first_name','asc')->get();

        //would need to get all the events in chronological order
       //$scouts = Scout::orderBy('start','asc')->get();


        // {
        //     "category": "Koga",
        //     "segments": [{
        //       "start": "2016-10-15",
        //       "end": "2016-10-25",
        //       "task": "Rockin Star",
        //       "color": "#46615e"   
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


                if ($card->color == 'red') {
                    $card->color = "#f04124";
                } else if ($card->color == 'blue') {
                    $card->color = "#008cba";
                } else if ($card->color == 'yellow') {
                    $card->color = "#e99002";
                }


                if ($card->scout_id != 0) {
                    //get that scout
                    $scout = Scout::where('id','=',$card->scout_id)->first();
                    
                    $dates[$card->id]['start'] = date('Y-m-d',strtotime($scout->start));
                    $dates[$card->id]['end'] = date('Y-m-d',strtotime($scout->end));
                    $dates[$card->id]['task'] = $scout->name_e;
                    $dates[$card->id]['stars'] = $card->stars;
                    $dates[$card->id]['color'] = $card->color;
                                     
                } else if ($card->event_id != 0) {
                    //get that event
                    $event = Event::where('id','=',$card->event_id)->first();
                    
                    $dates[$card->id]['start'] = date('Y-m-d',strtotime($event->start));
                    $dates[$card->id]['end'] = date('Y-m-d',strtotime($event->end));
                    $dates[$card->id]['task'] = $event->name_e;    
                    $dates[$card->id]['stars'] = $card->stars;   
                    $dates[$card->id]['color'] = $card->color;        
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



    /**
     *  data for timeline gantt
     *
     * @return \Illuminate\Http\Response
     */
    public function timeline() {
        //want same formatting as below but with events
        $events = Event::where('start','<','2016-05-21')->orderBy('start','desc')->get();

        //formatting goal

      //   "category": "Events",
      //   "segments": [ {
      //     "start": "2016-01-01",
      //     "end": "2016-01-14",
      //     "color": "#b9783f",
      //     "task": "Gathering requirements"
      //   } ]        

            $result['category'] = "Events";

        foreach($events as $event) {
            $dates[$event->id]['start'] = date('Y-m-d',strtotime($event->start));
            $dates[$event->id]['end'] = date('Y-m-d',strtotime($event->end));
            $dates[$event->id]['task'] = $event->name_e;
            $dates[$event->id]['color'] = $event->color;          

           
        }


            $result['segments'] = array_values($dates);

            $main[] = $result;
            unset($result);
            $result = array();

            unset($dates);
            $dates = array();   

        // foreach ($boys as $boy) {
        //     //need to start the array here
        //     $result['category'] = $boy->first_name;

        //     //get all the cards
        //     $cards = Card::where('boy_id','=',$boy->id)->get();
        //     foreach($cards as $card) {
        //         //get the info
        //         $boy = Boy::where('id','=',$card->boy_id)->first();

        //         if ($card->scout_id != 0) {
        //             //get that scout
        //             $scout = Scout::where('id','=',$card->scout_id)->first();
                    
        //             $dates[$card->id]['start'] = date('Y-m-d',strtotime($scout->start));
        //             $dates[$card->id]['end'] = date('Y-m-d',strtotime($scout->end));
        //             $dates[$card->id]['task'] = $scout->name_e;
        //             $dates[$card->id]['color'] = $boy->color;
                                     
        //         } else if ($card->event_id != 0) {
        //             //get that event
        //             $event = Event::where('id','=',$card->event_id)->first();
                    
        //             $dates[$card->id]['start'] = date('Y-m-d',strtotime($event->start));
        //             $dates[$card->id]['end'] = date('Y-m-d',strtotime($event->end));
        //             $dates[$card->id]['task'] = $event->name_e;       
        //             $dates[$card->id]['color'] = $boy->color;        
        //         }


        //     }

        //     $result['segments'] = array_values($dates);

        //     $main[] = $result;
        //     unset($result);
        //     $result = array();

        //     unset($dates);
        //     $dates = array();
        // } //end boys



        echo json_encode($main);

    } 



    /**
     * data for event history line graph
     *
     * @return \Illuminate\Http\Response
     */
    public function eventHistory() {

        //need to separate by border


        //do tier_2 first

        for ($i=0; $i < 21; $i++) { 
            $points = Eventpoint::where('position','=',$i)->get();
            foreach ($points as $key => $point) {
                $data[$point->event_id.'_points'] = $point->tier_2;
                $data[$point->event_id.'_rank'] = $point->rank_2;                    

            }

            $data['position'] = $i;
            $result[] = $data;

            unset($data);
        }
       
        echo json_encode($result);

    } 


    /**
     * data for current event border
     *
     * @return \Illuminate\Http\Response
     */
    public function eventBorder() {

        //get current event
        $event = Event::where('active','=','1')->first();

        $points = Eventpoint::where('event_id','=',$event->id)->get();

        //add in the 0 data point for event start
        //is this not copying it???, its not is this that reference thing i never understood???
        //use clone instead
        $start = clone $points[0];
        $start->participants = 0;
        $start->tier_1 = 0;
        $start->tier_2 = 0;
        $start->tier_3 = 0;
        $start->tier_4 = 0;
        $start->tier_5 = 0;
        $start->tier_6 = 0;
        $start->tier_7 = 0;
        $start->tier_8 = 0;
        $start->tier_9 = 0;
        $start->tier_10 = 0;
        $start->tier_11 = 0;
        $start->created_at = $event->start;
        
        $points->prepend($start);


        echo json_encode($points);

        //changes made in events 50 and up, the 1200 border is now 2k

        if ($event->id > 49) {
            $data['rank2'] = 2000;     

        } else {    
            $data['rank2'] = 1200;    
        
        }
                //add zero starting points
                // $data['points2'] = 0;
                // $data['points7'] = 0;
                // $data['rank7'] = 11000;   
                // $data['points12'] = 0;
                // $data['rank12'] = 35000;   
                // $data['position'] = 'start';
                // $result[] = $data;     
                // unset($data);      

            // foreach ($points as $key => $point) {
            //     $data['points2'] = $point->tier_2;
            //     $data['rank2'] = $point->rank_2;    
            //     $data['points7'] = $point->tier_7;
            //     $data['rank7'] = $point->rank_7;   

            //     if ($event->id > 49) {
            //         $data['points12'] = $point->tier_11;
            //         $data['rank12'] = $point->rank_11; 
            //     } else {    
            //        $data['points12'] = $point->tier_12;
            //         $data['rank12'] = $point->rank_12;  
                
            //     }                
                

            //     $data['position'] = $point->position;
            //     $result[] = $data;     
            //     unset($data);                                    
            // }

       
        //echo json_encode($result);

    } 

    //////////
    //idol road tree
    /////////

    /**
     * data for current event border
     *
     * @return \Illuminate\Http\Response
     */
    public function idolRoad($card_id) {
        //building the idol road
        //$road = Cardroad::where('card_id','=',$card_id)->where('parent','=',0)->get();

        $top = Cardroad::where('card_id','=',$card_id)->where('parent','like','%u%')->where('node','like','%u%')->get();
        
        //check that any nodes with a parent that does not have u but has u -- first row up
        $upper = Cardroad::where('card_id','=',$card_id)->where('parent','not like','%u%')->where('node','like','%u%')->get();
        
        //check that parent is 0 - middle

        //check that any nodes with a parent that does not have d but has d -- first row down

        //check that nodes with a parent with a d that also has a d -- second row down.



        $top = json_encode($top);
        $upper = json_encode($upper);

        // foreach($road as $node) {
        //     $childrencheck = Cardroad::where('parent','=',$node->node)->count();
        //     if ($count > 0 ) {
        //         //there are children
        //         $children = Cardroad::where('parent','=',$node->node)->get();

        //         //add these to that node.
        //         $road

        //     }
        // }





        echo json_encode(array_merge(json_decode($top, true),json_decode($upper, true)));

    }     






}
