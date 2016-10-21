@extends('layouts.layout')

@section('title')
@parent
enstar.info| Ensemble Stars Information
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h1>News</h1>
            @foreach ($blogs as $blog)
                <?php
                    $nicedate = date('F d, Y',strtotime($blog->created_at));
                    $nicetime = date('h:i A',strtotime($blog->created_at));

                    if ($blog->updated_by == 1) {
                        $blog->updated_by = 'CC';
                    }
                ?>            
                @if ($blog->image !='')
                    <div class="">
                        <a href="/{{$blog->type}}/{{$blog->url}}"><img class="img-responsive" src="/images/{{$blog->image}}" alt=""></a>
                    </div>
                @endif

                <h2>
                    <a href="/{{$blog->type}}/{{$blog->url}}">{{$blog->title}}</a><br>
                    <small>{{$nicedate}} by {{$blog->updated_by}}</small>
                </h2>                

                <br>
                <br>
                <br>
                <br>
            @endforeach

            <!-- Pager -->
            {{$blogs->links()}}

            <hr>
            <div class="row">
                <div class="col-md-4">
                    <h3>Current Event</h3>
                    <img class="img-responsive" src="/images/events/2.png">
                </div>
                 <div class="col-md-4">
                    <h3>Current Gacha</h3>
                     <img class="img-responsive" src="/images/gachas/2.png">
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
                        <h4>All</h4>
                        @foreach($all as $each)
                            <a href="/skill/{{$each->id}}">{{$each->english_description}}</a><br>
                        @endforeach            
                        
                        <h4>Red</h4>
                        @foreach($reds as $red)
                            <a href="/skill/{{$red->id}}">{{$red->english_description}}</a><br>
                        @endforeach    
                        
                        <h4>Blue</h4>
                        @foreach($blues as $blue)
                            <a href="/skill/{{$blue->id}}">{{$blue->english_description}}</a><br>
                        @endforeach    
                        
                        <h4>Yellow</h4>
                        @foreach($yellows as $yellow)
                            <a href="/skill/{{$yellow->id}}">{{$yellow->english_description}}</a><br>
                        @endforeach                        
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
