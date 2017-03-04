@extends('layouts.layout')

@section('title')
@parent
Dashboard | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<h1>{{Auth::user()->name}} Cards</h1>
                <h3>5 Stars - {{$fivestarcards_count}} cards</h3>
                <div class="row">
                    <?php $x=1; ?>
                    @foreach($fivestarcards as $card)
                        {{ $card->display('mini') }}    
                        <?php
                            if ($x%6==0) {
?>
                            </div>
                            <div class="row">
<?php                            
                            }
                            $x++;
                        ?>
                    @endforeach
                </div>  
                <h3>4 Stars - {{$fourstarcards_count}} cards</h3>
                <div class="row">
                    <?php $x=1; ?>
                    @foreach($fourstarcards as $card)
                        {{ $card->display('mini') }}    
                        <?php
                            if ($x%6==0) {
?>
                            </div>
                            <div class="row">
<?php                            
                            }
                            $x++;
                        ?>
                    @endforeach
                </div>                  
                <h3>3 Stars - {{$threestarcards_count}} cards</h3>

        </div>

    </div>
</div>
@endsection
