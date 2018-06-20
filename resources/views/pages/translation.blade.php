@extends('layouts.layout')

@section('title')
@parent
All Translated Stories| enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">

                    <h1>Translated Stories</h1>
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
        <div class="col-md-6">

                    <h1>Badly Translated Stories</h1>
                        <h4>Event Stories</h4>
                        @foreach ($event_stories_bad as $story)
                            <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                        @endforeach

                        <h4>Gacha Stories</h4>
                        @foreach ($gacha_stories_bad as $story)
                            <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                        @endforeach

                        <h4>Character Stories</h4>
                        @foreach ($character_stories_bad as $story)
                            <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                        @endforeach   

        </div>
    </div>
</div>
@endsection
