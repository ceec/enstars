@extends('layouts.layout')

@section('title')
    @parent
    {{$boy->english_name}} | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$boy->first_name}} {{$boy->last_name}}</h1>
                {{-- enstars!! cards --}}
                <div style="display: flex; flex-wrap: wrap;">
                    @foreach($basic_cards as $card)
                        {{ $card->display() }}
                    @endforeach
                </div>
                <hr>
                {{-- old enstars cards --}}
                <div style="display: flex; flex-wrap: wrap;">
                    @foreach($cards as $card)
                        {{ $card->display() }}
                    @endforeach
                </div>
            </div>
        </div>

        <h2>Information</h2>
        <div class="row">
            <div class="col-md-6">
                @if ($boy->unit_id > 0)
                    <h3>Unit: <a href="/unit/{{$boy->unit->url}}">{{$boy->unit->name}}</a></h3>
                @endif
                @if ($boy->class_id > 0)
                    <h3>Class: <a href="/class/{{$boy->classroom->class}}">{{$boy->classroom->class}}</a></h3>
            @endif
            <!--<h3>Club: <a href="">{{$boy->unit_id}}</a></h3>-->

            </div>
            <div class="col-md-6">
            </div>
        </div>
        <h2>Stories</h2>
        @foreach($chapters as $chapter)
            @if($chapter->chapter->complete == 1)
                <a href="/story/{{$chapter->chapter->story->id}}">{{$chapter->chapter->story->name_e}}</a> - <a
                        href="/story/{{$chapter->chapter->story->id}}/{{$chapter->chapter->chapter}}">{{$chapter->chapter->name_e}}</a>
                <br>
            @endif
        @endforeach
        <script src="/js/enstars.js"></script>
    </div>
@endsection
