@extends('layouts.layout')

@section('title')
    @parent
    Star Medal Shop Card | enstars.info
@stop

@section('content')
    <div class="container">
        <h1>Star Medal Shop Cards</h1>
        <div class="row">
            <div class="col-md-12">
                <div id="cards" style="flex-wrap: wrap;display: flex">
                    @foreach($cards as $card)
                        {{ $card->card->display() }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="/js/enstars.js"></script>
@endsection
