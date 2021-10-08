@extends('layouts.layout')

@section('title')
    @parent
    Collection - {{$user->name}} | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Cards - {{$user->name}}</h1>
                <h3>5 Stars - {{count($fivestarcards)}} cards</h3>
                <div style="display: flex;flex-wrap: wrap;">
                    @foreach($fivestarcards as $card)
                        <a href="/card/{{ $card->id }}" style="margin: 8px;">
                            <img src="/images/cards/{{ $card->boy_id }}_{{ $card->card_id }}.png"
                                 style="width:180px;height:auto;">
                        </a>
                    @endforeach
                </div>
                <h3>4 Stars - {{count($fourstarcards)}} cards</h3>
                <div style="display: flex;flex-wrap: wrap;">
                    @foreach($fourstarcards as $card)
                        <a href="/card/{{ $card->id }}" style="margin: 8px;">
                            <img src="/images/cards/{{ $card->boy_id }}_{{ $card->card_id }}.png"
                                 style="width:180px;height:auto;">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
