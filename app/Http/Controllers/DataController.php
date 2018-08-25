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
        $boys = Boy::where('classroom_id','!=','7')->where('classroom_id','!=','10')->orderBy('first_name','asc')->get();

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



        // //okoay i cheated and put this all hardcoded into the db, want it to be dynamic though!
        // //do tier_2 first
        // //get all the events
        // $events = Eventpoint::select('event_id')->distinct()->get();

        // //loop through the points

        // foreach($events as $event) {
        //     //get the event
        //     $event_info = Event::find($event->event_id);

        //     //somehow need to chunk the dates
        //     $date = $event_info->start;

        //     while($date < $event_info->end) {
        //         //keep creating times
        //         $date = date('Y-m-d H:i:s',strtotime($date." + 1 day "));
        //         $dates[] = $date;
        //     }


        //     //okay have a chunk of dates in $dates

        //     //loop through that events data
        //     $data = Eventpoint::where('event_id','=',$event->event_id)->get();
            

        //     foreach($data as $point) {
        //         //check where it is in the array
        //         if ($point->created_at < $dates[0]) {
        //             //change the date to 1
        //             //2000-01-01 whatever time
        //             $final = substr_replace($point->created_at,'2000-01-01',0,10);
                    
        //             echo($final);
        //             echo '<hr>';
        //         } else if ($point->created_at > $dates[9]){
        //             $final = substr_replace($point->created_at,'2000-01-10',0,10);
        //         }
        //         $dates2[] = $final;
        //     }
            
        //     print_r($dates2);

        //     dd($dates);


            //get the start date and end date of that event
            //ok why isnt this working
            //$start_date = $event_info->start;
            //$end_date = $event_info->end;

            //slice the event




        //}

        

        // for ($i=0; $i < 21; $i++) { 
        //     $points = Eventpoint::where('position','=',$i)->get();
        //     foreach ($points as $key => $point) {
        //         $data[$point->event_id.'_points'] = $point->tier_2;
        //         $data[$point->event_id.'_rank'] = $point->rank_2;                    

        //     }

        //     $data['position'] = $i;
        //     $result[] = $data;

        //     unset($data);
        // }

        //order by lowest to highest normalized date, grab distinct
        $points = Eventpoint::select('normalized_date')->where('normalized_date','!=',null)->orderBy('normalized_date','ASC')->distinct()->get();

        foreach($points as $point) {
            //grab all the points for that time
            $times = Eventpoint::where('normalized_date','=',$point->normalized_date)->get();

            //get those events
            foreach($times as $time) {
                $event = $time->event_id.'_'.$time->rank_2;
                $events[$event] = $time->tier_2;
                $data[$time->normalized_date] = $events;
                
            }

            unset($events);
        }

        //okay have the data points arranged with their dates, add date to each list
        foreach($data as $date => $points) {
            $data[$date]['timestamp'] = $date;
        }

            // dd($data);

            // $data['timestamp'] = $point->normalized_date;






            // //check if theres multiple
            // echo json_encode($point->normalized_date);
            // $check = Eventpoint::where('normalized_date','=',$point->normalized_date)->count();
            // echo $check;
            // if ($check > 1 ) {
            //     //need to remove hmmm

            //     //loop through and combine into one dp
            //     $specifics = Eventpoint::where('normalized_date','=',$point->normalized_date)->get();
            //     foreach($specifics as $specific) {
            //         //get each points data
            //         $eventspecific = $specific->event_id.'_'.$specific->rank_2;
                    
            //         $test2[$eventspecific] = $point->tier_2;


            //         $data[] = $test2;                    
            //     }

            //     $test2['timestamp'] = $point->normalized_date;

            // } else {
            //     //add the distinct point
            //     //$test = (object)[];
            //    // $test->$point->event_id.'_'.$point->rank_2 = $point->tier_2;
            //     //$test->timestamp = $point->normalized_time;
            //     $event = $point->event_id.'_'.$point->rank_2;
            //     //$test->$event = $point->tier_2;

            //     $test['timestamp'] = $point->normalized_date;
            //     $test[$event] = $point->tier_2;


            //     $data[] = $test;
            // }

            // echo '<hr>';
        //}

        //turn from associated array into indexed array
        $data = array_values($data);

       
        echo json_encode($data);

    } 


    /**
     * data for current event border
     *
     * @return \Illuminate\Http\Response
     */
    public function eventBorder($event_id) {

        //get current event
        $event = Event::find($event_id);

        $points = Eventpoint::where('event_id','=',$event->id)->get();

        //if there arent any, just return []
        //when bad url is passed
        if (empty($points[0])) {
            $points = [];
        } else {
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
        }

        echo json_encode($points);

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


    /**
     * data for card frequency per boy
     *
     * @return \Illuminate\Http\Response
     */
    public function frequencyChart($boy_id) {
        $cards2018 = Card::where('boy_id','=',$boy_id)->where('created_at','>','2017-12-31')->orderBy('created_at','asc')->get();

      
        foreach($cards2018 as $card) {
            $data2018['x'] = date('W',strtotime($card->created_at));
            $data2018['y'] = $card->stars;
            $data2018['source'] = $card->event_id;
            $data[] = $data2018;
        }

        echo json_encode($data);
    }



}
