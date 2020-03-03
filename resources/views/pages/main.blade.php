@extends('layouts.layout')

@section('title')
@parent
enstars.info - Information and Translations for Ensemble Stars!
@stop

@section('content')
<div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Current Event</h3>
                    <!-- Unit Collection hard coded -->
                    <!--<h4>Unit Collection Eden</h4>
                    <a href="/unitcollection/eden"><img class="img-responsive" src="/images/collections/9.png" alt="Unit Collection Eden"></a><br>
                    -->
                    @foreach ($current_event as $event)
                        <h4>{{$event->name_e}}</h4>
                        <a href="/event/{{$event->url}}"><img class="img-responsive" src="/images/events/{{$event->id}}.png" alt="{{$event->name_e}}"></a><br>
                        <?php
                            //this date is in JST but intrepreted in local? MST?
                            //switch to JST
                            
                            date_default_timezone_set('Asia/Tokyo');
                        ?>                        
                        @if ($event->end > date('Y-m-d h:i:s'))
                            <h4>Time Remaining:<br> <span id="time-remaining"></span></h4>
                            
                            <?php
                                  //convert from JST to UTC
  $utc_end = date('Y-m-d H:i:s',strtotime($event->end) - 60 * 60 * 9);
                            ?>

                            <script>
                            var eventEnd = "<?php print $utc_end;?>Z";
                            //console.log(eventEnd);
var eventID = "<?php print $event->id; ?>";
                            //get current time left in event, update it every second.
var timeLeft = function() {
  var now = Date.now();
  ///this is in MST. Need to get it in JST
  var end = new Date(eventEnd);
  //console.log(eventEnd);
  //console.log(end);
  //how many miliseconds long between the end of the event and now
  var diff = end.getTime() - now;  
  //console.log(end.getTime());
  //calculate time left
  var days = Math.floor(diff /(1000 * 60 * 60 * 24));
  //get the remanining time
  var fullDays = (days * 1000 * 60 * 60 * 24);
  var remaining = diff - fullDays;
  
  var hours = Math.floor(remaining /(1000 * 60 * 60));
  var fullHours = (hours * 1000 * 60 * 60);
  
  remaining = diff - (fullDays + fullHours);

  var minutes = Math.floor(remaining/(1000 * 60));
  var fullMinutes = (minutes * 1000 * 60);
  remaining = diff - (fullDays + fullHours + fullMinutes);
  
  var seconds = Math.floor(remaining/(1000));
  
  var timeSpan = document.getElementById('time-remaining');
  timeSpan.textContent = days+' days '+hours+' hours '+minutes+' minutes '+seconds+' seconds';
  
  //lpLeft(diff);
}


//show remaining time, calculate points/LP
var showTime = setInterval(timeLeft,1000);
                            </script>
                        @endif
                    @endforeach             
                </div>
                <div class="col-md-4">
                    <h3>Current Scout</h3>
                    @foreach ($current_scout as $scout)
                    <h4>{{$scout->name_e}}</h4>
                       <a href="/scout/{{$scout->url}}"><img class="img-responsive" src="/images/scouts/{{$scout->id}}.png" alt="{{$scout->name_e}}"></a><br>
                    @endforeach                
                </div>
                <div class="col-md-4">
                    @if (Auth::guest())
                        <div class="">
                            <h4>Want a way to track all your cards?<h4><a href="/register">Create an account!</a>
                        </div>             
                    @endif
                    <h3>News 2019-11-14</h3>
                    <p><a href="https://enstars.info/news/unit-collection-cards-star-medal-shop-cards-and-the-future">Unit Collection Cards, Star Medal Shop Cards, and the Future!</a></p>
                        <h3>Recently Updated</h3>
                        @foreach($latest as $item)
                            @if($item['type'] == 'releasenote')
                                <a href="/game/releasenotes">{{$item['title']}}</a><br>
                            @else
                                <a href="/{{$item['type']}}/{{$item['id']}}">{{$item['title']}}</a><br>
                            @endif
                        @endforeach

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <h3>Yumenosaki Academy</h3>
                @foreach($yume_boys as $boy)
                    <?php 
                        //name pretty for url
                        $url = strtolower($boy->first_name);
                    ?>

                    <a class="boys" href="/idol/{{$url}}"><img class="img-responsive" src="/images/boys/{{$boy->id}}.png" title="{{$boy->first_name}} {{$boy->last_name}}" alt="{{$boy->first_name}} {{$boy->last_name}}"></a> 
                @endforeach
                <br><br>
                @foreach($yume_teachers as $boy)
                    <?php 
                        //name pretty for url
                        $url = strtolower($boy->first_name);
                    ?>

                    <a class="boys" href="/idol/{{$url}}"><img class="img-responsive" src="/images/boys/{{$boy->id}}.png" title="{{$boy->first_name}} {{$boy->last_name}}" alt="{{$boy->first_name}} {{$boy->last_name}}"></a> 
                @endforeach                            
                </div>
                <div class="col-md-12">
                <h3>Reimei Academy</h3>
                @foreach($rei_boys as $boy)
                    <?php 
                        //name pretty for url
                        $url = strtolower($boy->first_name);
                    ?>

                    <a class="boys" href="/idol/{{$url}}"><img class="img-responsive" src="/images/boys/{{$boy->id}}.png" title="{{$boy->first_name}} {{$boy->last_name}}" alt="{{$boy->first_name}} {{$boy->last_name}}"></a> 
                @endforeach                
                </div>
                <div class="col-md-12">
                <h3>Shuetsu Academy</h3>
                @foreach($third_boys as $boy)
                    <?php 
                        //name pretty for url
                        $url = strtolower($boy->first_name);
                    ?>

                    <a class="boys" href="/idol/{{$url}}"><img class="img-responsive" src="/images/boys/{{$boy->id}}.png" title="{{$boy->first_name}} {{$boy->last_name}}" alt="{{$boy->first_name}} {{$boy->last_name}}"></a> 
                @endforeach                
                </div>   
                <div class="col-md-12">
                <h3>Others</h3>
                @foreach($others as $boy)
                    <?php 
                        //name pretty for url
                        $url = strtolower($boy->first_name);
                    ?>

                    <a class="boys" href="/idol/{{$url}}"><img class="img-responsive" src="/images/boys/{{$boy->id}}.png" title="{{$boy->first_name}} {{$boy->last_name}}" alt="{{$boy->first_name}} {{$boy->last_name}}"></a> 
                @endforeach                
                </div>                                                
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h3>Lesson Skills</h3>
                    <h4>Jewels</h4>
                    <table class="table">
                        <tr>
                            <td>Red</td>
                            <td><a href="/skill/jewel/red/small"><img src="/images/red_small.png" alt="small"></a></td>
                            <td><a href="/skill/jewel/red/medium"><img src="/images/red_medium.png" alt="medium"></a> </td>
                            <td><a href="/skill/jewel/red/large"><img src="/images/red_large.png" alt="large"></a></td>
                            <td><a href="/skill/jewel/red/all">All</a></td>
                        </tr>
                        <tr>
                            <td>Blue</td>
                            <td><a href="/skill/jewel/blue/small"><img src="/images/blue_small.png" alt="small"></a></td>
                            <td><a href="/skill/jewel/blue/medium"><img src="/images/blue_medium.png" alt="medium"></a></td>
                            <td><a href="/skill/jewel/blue/large"><img src="/images/blue_large.png" alt="large"></a></td>
                            <td><a href="/skill/jewel/blue/all">All</a></td>
                        </tr>
                        <tr>
                            <td>Yellow</td>
                            <td><a href="/skill/jewel/yellow/small"><img src="/images/yellow_small.png" alt="small"></a></td>
                            <td><a href="/skill/jewel/yellow/medium"><img src="/images/yellow_medium.png" alt="medium"></a></td>
                            <td><a href="/skill/jewel/yellow/large"><img src="/images/yellow_large.png" alt="large"></a></td>
                            <td><a href="/skill/jewel/yellow/all">All</a></td>
                        </tr>
                        <tr>
                            <td>All</td>
                            <td><a href="/skill/jewel/all/small">Small</a></td>
                            <td> <a href="/skill/jewel/all/medium">Med</a></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                        
                    </table>                                                        
                </div>  
                <div class="col-md-4">
                    <h3>Units</h3>
                    @foreach($units as $unit)
                        <a href="/unit/{{$unit->url}}">{{$unit->name}}</a><br>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <h3>Translated Stories</h3>
                        <h4>Event Stories</h4>
                        @foreach ($event_stories as $story)

                        <?php
                            //dd($story->event());
                        ?>

                            <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                        @endforeach

                        <h4>Scout Stories</h4>
                        @foreach ($scout_stories as $story)
                            <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                        @endforeach

                        <h4>Character Stories</h4>
                        @foreach ($character_stories as $story)
                            <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                        @endforeach                    
                    </div>                                             
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h3>Tags</h3>
                    @foreach($tags as $tag)
                        <a href="/tag/{{$tag->tag}}">{{$tag->tag}}</a><br>
                    @endforeach
                </div>                
            </div>
</div>
@endsection
