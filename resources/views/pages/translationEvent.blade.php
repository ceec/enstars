@extends('layouts.layout')

@section('title')
    @parent
    Translated Event Stories| enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>Translated Event Stories</h1>
                @foreach ($event_stories as $story)
                    <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                @endforeach


            </div>

        </div>
    </div>
@endsection
