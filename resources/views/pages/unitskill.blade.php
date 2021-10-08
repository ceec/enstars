@extends('layouts.layout')

@section('title')
    @parent
    {{$skill->name_e}} | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>+{{$skill->percent}}% {{$skill->type}} - {{$skill->name_e}}</h1>
                <p>{!! $skill->description_e !!}</p>
                @foreach ($boys as $boy)
                    <div class="row">
                        <div class="col-md-12">
                            {{$boy->first_name}} {{$boy->last_name}}
                        </div>
                        {{--<div class="col-md-10">--}}
                        {{--    <div class="row">--}}
                        {{--        @foreach($boy->cards as $card)--}}
                        {{--            {{ $card->display() }}--}}
                        {{--        @endforeach--}}
                        {{--    </div>--}}
                        {{--</div>--}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
