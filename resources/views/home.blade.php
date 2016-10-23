@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                <div class="row">
                    <?php $x=1; ?>
                    @if(!empty($cards))
                        @foreach($cards as $card)
                            <?php
                                //set up the colors
                                if ($card->color == 'red') {
                                    $color_class = 'panel-danger';
                                } else if ($card->color == 'blue') {
                                    $color_class = 'panel-info';
                                } else if ($card->color == 'yellow') {
                                    $color_class = 'panel-warning';
                                } else {
                                    $color_class = 'panel-default';
                                }
                            ?>  
                            <div class="col-md-3">
                                    <div class="panel {{$color_class}}">
                                      <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <div class="card-container" id="card-{{$card->card_id}}"><img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png"></div>
                                            <span class="glyphicon glyphicon-certificate bloom" id="bloom-{{$card->card_id}}" data-id="{{$card->card_id}}" aria-hidden="true"></span>
                                        </h3>
                                      </div>
                                    </div>
         
                            </div>             
                            <?php
                                if ($x%4==0) {
?>
                                </div>
                                <div class="row">
<?php                            
                                }
                                $x++;
                            ?>
                        @endforeach
                    @endif

                </div>


                <div class="row">
                    <div class="col-md-4">
                        <a href="/home/translations">Translations</a><br>

                    </div>
                    <div class="col-md-4">
                        <h3>Blog</h3>
                        <a href="/home/blog/add">Add New Blog</a><br>
                        <a href="/home/blog/list">Edit Blog</a><br>
                    </div>
                    <div class="col-md-4">
                       <h3>Cards</h3>
                        <a href="/home/card/add">Add New Card</a><br>
                        <a href="">Edit Card</a><br>                    
                    </div>                                        
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
