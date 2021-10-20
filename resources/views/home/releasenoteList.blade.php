@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Release Notes</h1>

        @foreach($notes as $note)
            <a href="/home/releasenote/edit/{{$note->id}}">{{$note->version}} - {{$note->release_date}}</a><br>
        @endforeach


    </div>


@endsection
