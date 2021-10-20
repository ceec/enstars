@extends('layouts.layout')

@section('title')
    @parent
    Translated Character Stories| enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>Translated Character Stories</h1>
                @foreach ($character_stories as $story)
                    <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                @endforeach


            </div>

        </div>
    </div>
@endsection
