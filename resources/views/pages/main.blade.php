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
                    @if($event->game_id == 2)

                        <a href="/event/{{$event->url}}">
                            <img class="img-responsive"
                                 src="/images/events/{{$event->id}}.png"
                                 alt="{{$event->name_e}}">
                            <h4>{{$event->name_e}}</h4>
                        </a>

                        <br>
                    @endif
                    <?php
                    // This date is in JST but intrepreted in local? MST?
                    // Switch to JST

                    date_default_timezone_set('Asia/Tokyo');

                    // Convert from JST to UTC
                    $utc_end = date('Y-m-d H:i:s', strtotime($event->end) - 60 * 60 * 9);

                    // Set up variables for the countdowns

                    if ($event->game_id == 2) {
                        $basic_end = $utc_end;
                        $basic_id = $event->id;
                    } else {
                        $music_end = $utc_end;
                        $music_id = $event->id;
                    }
                    ?>
                    @if ($event->end > date('Y-m-d h:i:s'))
                        @if ($event->game_id == 2)
                            <h4>Basic Time Remaining:<br> <span id="basic-time-remaining"></span></h4>
                        @else
                            <h4>Music Time Remaining:<br> <span id="music-time-remaining"></span></h4>
                        @endif
                        <?php

                        ?>
                    @endif
                @endforeach

                <script>
                    var eventEndBasic = "<?php print $basic_end;?>Z";
                    //console.log(eventEndBasic);
                    var eventEndMusic = "<?php print $music_end;?>Z";
                    //console.log(eventEndMusic);

                    var basicID = "<?php print $basic_id; ?>";
                    //console.log(basicID);

                    // Get current time left in event, update it every second.

                    var timeLeft = function () {
                        var now = Date.now();
                        ///this is in MST. Need to get it in JST
                        var end = new Date(eventEndBasic);
                        //console.log(eventEnd);
                        //console.log(end);
                        //how many miliseconds long between the end of the event and now
                        var diff = end.getTime() - now;
                        //console.log(end.getTime());
                        //calculate time left
                        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        //get the remanining time
                        var fullDays = (days * 1000 * 60 * 60 * 24);
                        var remaining = diff - fullDays;

                        var hours = Math.floor(remaining / (1000 * 60 * 60));
                        var fullHours = (hours * 1000 * 60 * 60);

                        remaining = diff - (fullDays + fullHours);

                        var minutes = Math.floor(remaining / (1000 * 60));
                        var fullMinutes = (minutes * 1000 * 60);
                        remaining = diff - (fullDays + fullHours + fullMinutes);

                        var seconds = Math.floor(remaining / (1000));

                        var timeSpanName = 'basic-time-remaining';
                        //console.log(timeSpanName);
                        var timeSpan = document.getElementById(timeSpanName);


                        timeSpan.textContent = days + ' days ' + hours + ' hours ' + minutes + ' minutes ' + seconds + ' seconds';
                    }

                    var timeLeftMusic = function () {
                        var now = Date.now();
                        ///this is in MST. Need to get it in JST
                        var end = new Date(eventEndMusic);
                        //console.log(eventEnd);
                        //console.log(end);
                        //how many miliseconds long between the end of the event and now
                        var diff = end.getTime() - now;
                        //console.log(end.getTime());
                        //calculate time left
                        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        //get the remanining time
                        var fullDays = (days * 1000 * 60 * 60 * 24);
                        var remaining = diff - fullDays;

                        var hours = Math.floor(remaining / (1000 * 60 * 60));
                        var fullHours = (hours * 1000 * 60 * 60);

                        remaining = diff - (fullDays + fullHours);

                        var minutes = Math.floor(remaining / (1000 * 60));
                        var fullMinutes = (minutes * 1000 * 60);
                        remaining = diff - (fullDays + fullHours + fullMinutes);

                        var seconds = Math.floor(remaining / (1000));

                        var timeSpanName = 'music-time-remaining';
                        //console.log(timeSpanName);
                        var timeSpan = document.getElementById(timeSpanName);


                        timeSpan.textContent = days + ' days ' + hours + ' hours ' + minutes + ' minutes ' + seconds + ' seconds';
                    }

                    //show remaining time, calculate points/LP
                    var showTime = setInterval(timeLeft, 1000);
                    var showTimeMusic = setInterval(timeLeftMusic, 1000);
                </script>
            </div>
            <div class="col-md-4">
                <h3>Current Scout</h3>
                @foreach ($current_scout as $scout)
                    <a href="/scout/{{$scout->url}}">
                        <img class="img-responsive" src="/images/scouts/{{$scout->id}}.png"
                             alt="{{$scout->name_e}}">
                        <h4>{{$scout->name_e}}</h4>
                    </a>
                    <br>
                @endforeach
            </div>
            <div class="col-md-4">
                @if (Auth::guest())
                    <h4>Want a way to track all your cards?</h4>
                    <a href="/register">Create an account!</a>
                @endif
                <h3>News</h3>
                <a href="https://enstars.info/news/missing-card-images">Help Needed Collecting Card Images</a>
                <p>Website is undergoing updates! If you see something funky, <a href="/contact">please let us know!</a></p>
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
        <br>
        <div class="row">
            <div class="col-md-12">
                @foreach($yume_boys as $boy)
                    <?php
                    //name pretty for url
                    $url = strtolower($boy->first_name);
                    ?>

                    <a class="boys" href="/idol/{{$url}}">
                        <img src="/images/boys/{{$boy->id}}.png"
                             title="{{$boy->first_name}} {{$boy->last_name}}"
                             alt="{{$boy->first_name}} {{$boy->last_name}}">
                    </a>
                @endforeach
                <br><br>
                @foreach($yume_teachers as $boy)
                    <?php
                    //name pretty for url
                    $url = strtolower($boy->first_name);
                    ?>

                    <a class="boys" href="/idol/{{$url}}">
                        <img src="/images/boys/{{$boy->id}}.png"
                             title="{{$boy->first_name}} {{$boy->last_name}}"
                             alt="{{$boy->first_name}} {{$boy->last_name}}">
                    </a>
                @endforeach
            </div>
            <div class="col-md-12">
                <h3>Others</h3>
                @foreach($others as $boy)
                    <?php
                    //name pretty for url
                    $url = strtolower($boy->first_name);
                    ?>

                    <a class="boys" href="/idol/{{$url}}"><img class="img-responsive"
                                                               src="/images/boys/{{$boy->id}}.png"
                                                               title="{{$boy->first_name}} {{$boy->last_name}}"
                                                               alt="{{$boy->first_name}} {{$boy->last_name}}"></a>
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
                        <td><a href="/skill/jewel/red/medium"><img src="/images/red_medium.png" alt="medium"></a></td>
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
                        <td><a href="/skill/jewel/yellow/small"><img src="/images/yellow_small.png" alt="small"></a>
                        </td>
                        <td><a href="/skill/jewel/yellow/medium"><img src="/images/yellow_medium.png" alt="medium"></a>
                        </td>
                        <td><a href="/skill/jewel/yellow/large"><img src="/images/yellow_large.png" alt="large"></a>
                        </td>
                        <td><a href="/skill/jewel/yellow/all">All</a></td>
                    </tr>
                    <tr>
                        <td>All</td>
                        <td><a href="/skill/jewel/all/small">Small</a></td>
                        <td><a href="/skill/jewel/all/medium">Med</a></td>
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
