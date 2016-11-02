@extends('layouts.layout')

@section('title')
@parent
enstars.info - Information and Translations for Ensemble Stars!
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h3>News</h3>
            @foreach ($blogs as $blog)
                <?php
                    $nicedate = date('F d, Y',strtotime($blog->created_at));
                    $nicetime = date('h:i A',strtotime($blog->created_at));

                    if ($blog->updated_by == 1) {
                        $blog->updated_by = 'ankee';
                    } else if ($blog->updated_by == 3) {
                        $blog->updated_by = 'cherushi';
                    }
                ?>            
                @if ($blog->image !='')
                    <div class="">
                        <a href="/{{$blog->type}}/{{$blog->url}}"><img class="img-responsive" src="/images/{{$blog->image}}" alt=""></a>
                    </div>
                @endif

                <h4>
                    <a href="/{{$blog->type}}/{{$blog->url}}">{{$blog->title}}</a><br>
                    <small>{{$nicedate}} by {{$blog->updated_by}}</small>
                </h4>                
            @endforeach
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <h3>Current Event</h3>
                    @foreach ($current_event as $event)
                        <a href="/event/{{$event->url}}"><img class="img-responsive" src="/images/events/{{$event->id}}.png" alt="{{$event->name_e}}"></a>
                    @endforeach
                </div>
                 <div class="col-md-4">
                    <h3>Current Scout</h3>
                    @foreach ($current_scout as $scout)
                       <a href="/scout/{{$scout->url}}"><img class="img-responsive" src="/images/scouts/{{$scout->id}}.png" alt="{{$scout->name_e}}"></a><br>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <h3>Translated Stories</h3>
                        <h4>Event Stories</h4>
                        @foreach ($event_stories as $story)
                            <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                        @endforeach

                        <h4>Gacha Stories</h4>
                        @foreach ($gacha_stories as $story)
                            <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                        @endforeach

                        <h4>Character Stories</h4>
                        @foreach ($character_stories as $story)
                            <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                        @endforeach                    
                        </div>
                <div class="col-md-4">
                    <h3>Tags</h3>
                        @foreach($tags as $tag)
                            <a href="/tag/{{$tag->tag}}">{{$tag->tag}}</a><br>
                        @endforeach
                </div>                
                <div class="col-md-4">
                    <h3>Lesson Skills</h3>
                        <h4>Jewels</h4>
                        Red: 
                        <a href="/skill/jewel/red/small">Small</a>
                        <a href="/skill/jewel/red/medium"><img src="/images/red_medium.png"></a> 
                        <a href="/skill/jewel/red/large">Large</a>
                        <a href="/skill/jewel/red/all">All</a>
                        <br>
                        Blue:
                        <a href="/skill/jewel/blue/small">Small</a>
                        <a href="/skill/jewel/blue/medium"><img src="/images/blue_medium.png"></a>                         
                        <a href="/skill/jewel/blue/large">Large</a>
                        <a href="/skill/jewel/blue/all">All</a>                        
                        <br>
                        Yellow:
                        <a href="/skill/jewel/yellow/small">Small</a>
                        <a href="/skill/jewel/yellow/medium"><img src="/images/yellow_medium.png"></a>
                        <a href="/skill/jewel/yellow/large">Large</a>
                        <a href="/skill/jewel/yellow/all">All</a>  
                        <br>
                        All:
                        <a href="/skill/jewel/all/small">Small</a>
                        <a href="/skill/jewel/all/medium">Medium</a>                   

                </div> 
                <div class="col-md-4">
                    <h3>Units</h3>
                    <?php
                        //split the units in half for better layout
                    ?>
                        @foreach($units as $unit)
                            <a href="/unit/{{$unit->name}}">{{$unit->name}}</a><br>
                        @endforeach
                </div>                               
            </div>

        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-2">
            <h3>Students</h3>
            @foreach($boys as $boy)
                <?php 
                    //name pretty for url
                    $url = strtolower($boy->first_name);
                ?>

                <a href="/idol/{{$url}}">{{$boy->first_name}} {{$boy->last_name}}</a>  <br>
            @endforeach

            <h3>Teachers</h3>
            @foreach($teachers as $boy)
                <?php 
                    //name pretty for url
                    $url = strtolower($boy->first_name);
                ?>

                <a href="/idol/{{$url}}">{{$boy->first_name}} {{$boy->last_name}}</a>  <br>
            @endforeach            
        </div>

    </div>
</div>
@endsection
