@extends('layouts.layout')

@section('title')
@parent
{{$card->english_name}} | enstars.info
@stop

@section('content')
<div class="container">
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
        	<h1>{{$card->name_e}}</h1>
         <div class="row">
            <div class="col-md-6">
                <div class="panel {{$color_class}}">
                  <div class="row">
                    <div class="col-md-6">
                        <img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png">
                    </div>
                    <div class="col-md-6">
                         <img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}b.png">
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Released:</h2>
                <h2>Obtained by:</h2>
                <h2>Stats:</h2>
                <h2>Dream Festival Skill:</h2>
                <h2>Lesson Skill:</h2>
            </div>
         </div>   
         <div class="row">
            <div class="col-md-12">
                <img class="img-responsive" src="/images/cards/get/{{$card->boy_id}}_{{$card->card_id}}.png">
            </div>
         </div>   
</div>
@endsection
