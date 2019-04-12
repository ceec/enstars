@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8">
            <h2>Event Stories</h2>
            @foreach ($event_stories as $story)
            {{$story->percent}}% <a href="/home/translations/{{$story->id}}">{{$story->name_e}}</a><br>
            @endforeach

            <h2>Scout Stories</h2>
            @foreach ($scout_stories as $story)
             {{$story->percent}}% <a href="/home/translations/{{$story->id}}">{{$story->name_e}}</a><br>
            @endforeach

            <h2>Character Stories</h2>
            @foreach ($character_stories as $story)
             {{$story->percent}}% <a href="/home/translations/{{$story->id}}">{{$story->name_e}}</a><br>
            @endforeach
        </div>
        <div class="col-md-4">
            <h2>Settings</h2>
            <a href="/home/edit/css">Edit Boy CSS</a>
        </div>

    </div>
</div>
@endsection
