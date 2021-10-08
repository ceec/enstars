@extends('layouts.layout')

@section('title')
    @parent
    Dashboard | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Cards - <a href="/user/dashboard">{{Auth::user()->name}}</a></h1>
                <h3>5 Stars
                    <small> - {{count($fivestarcards)}} cards</small>
                </h3>
                <div style="display: flex;flex-wrap: wrap">
                    @foreach($fivestarcards as $card)
                        {{ $card->display() }}
                    @endforeach
                </div>
                <h3>4 Stars
                    <small> - {{count($fourstarcards)}} cards</small>
                </h3>
                <div style="display: flex;flex-wrap: wrap">
                    @foreach($fourstarcards as $card)
                        {{ $card->display() }}
                    @endforeach
                </div>
                <h3>3 Stars
                    <small> - {{count($threestarcards)}} cards</small>
                </h3>
                <div style="display: flex;flex-wrap: wrap">
                    @foreach($threestarcards as $card)
                        {{ $card->display() }}
                    @endforeach
                </div>

            </div>

        </div>
    </div>
@endsection
