@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Event Stories</h2>
    @foreach ($event_stories as $story)
    <a href="/home/translations/{{$story->id}}">{{$story->name_e}}</a><br>
    @endforeach

    <h2>Gacha Stories</h2>
    @foreach ($gacha_stories as $story)
    <a href="/home/translations/{{$story->id}}">{{$story->name_e}}</a><br>
    @endforeach

    <h2>Character Stories</h2>
    @foreach ($character_stories as $story)
    <a href="/home/translations/{{$story->id}}">{{$story->name_e}}</a><br>
    @endforeach

    <div class="row">
    </div>
</div>
@endsection
