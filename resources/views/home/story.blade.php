@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$story->name_e}} Chapters</h1>
    @foreach ($chapters as $chapter)
        {{$chapter->percent}}% <a href="/home/translations/{{$story->id}}/{{$chapter->id}}">{{$chapter->name_e}}</a><br>
    @endforeach
    <div class="row">
    </div>
</div>
@endsection
