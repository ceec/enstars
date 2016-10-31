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

                            if ($card->scout_id != 0) {
                                //its from a scout
                                $from = 'scout';
                            } else if ($card->event_id !=0) {
                                //its from an event
                                $from = 'event';
                            } else {
                                $from = 'pool';
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
                  <p>{{$card->sentence_e}}</p>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Released: </h3>
                @if ($from == 'pool')
                    <h3>Introduced in:</h3> Original Card
                @elseif ($from == 'scout')
                    <h3>Introduced in:</h3> Scout: <a href="/scout/{{$source->id}}">{{$source->name_e}}</a><br>
                @elseif ($from == 'event')
                    <h3>Introduced in:</h3> Event: <a href="/event/{{$source->id}}">{{$source->name_e}}</a><br>
                @endif
                
                <h3>Stats:</h3>
                <h3>Dream Festival Skill:</h3>
                @if ($skill->id == 0)
                    <h3>Lesson Skill:</h3> {{$skill->english_description}}
                @else
                    <h3>Lesson Skill:</h3> <a href="/skill/{{$skill->id}}">{{$skill->english_description}}</a>
                @endif
                
            </div>
         </div>   
         <div class="row">
            <div class="col-md-12">
                <img class="img-responsive" src="/images/cards/get/{{$card->boy_id}}_{{$card->card_id}}.png">
            </div>
         </div>   
</div>
@endsection
