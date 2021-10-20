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
                <div id="cards" class="row">
                    <?php $x = 1; ?>
                    @foreach($cards as $card)
                        {{ $card->card->display() }}
                        <?php
                        if ($x % 4 == 0) {
                        ?>
                </div>
                <div class="row">
                    <?php
                    }
                    $x++;
                    ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="/js/enstars.js"></script>
@endsection
