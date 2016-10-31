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

                            //format starting date
                            $start_date = date('F j, Y',strtotime($source->start));

                            //image url
                            $scout_image = '/images/cards/get/'.$card->boy_id.'_'.$card->card_id.'png';

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
                <h3>Released: {{$start_date}}</h3> 
                @if ($from == 'pool')
                    <h3>Introduced in: Original Card</h3>
                @elseif ($from == 'scout')
                    <h3>Introduced in: Scout: <a href="/scout/{{$source->id}}">{{$source->name_e}}</a></h3>
                @elseif ($from == 'event')
                    <h3>Introduced in: Event: <a href="/event/{{$source->id}}">{{$source->name_e}}</a></h3>
                @endif
                
                @if ($dorifes_skill->id == 0)
                    <h3>Dream Festival Skill: {{$dorifes_skill->english_description}} </h3>
                @else
                    <h3>Dream Festival Skill: <a href="/skill/{{$dorifes_skill->id}}">{{$dorifes_skill->english_description}}</a></h3>
                @endif

                @if ($lesson_skill->id == 0)
                    <h3>Lesson Skill: {{$lesson_skill->english_description}} </h3>
                @else
                    <h3>Lesson Skill: <a href="/skill/{{$lesson_skill->id}}">{{$lesson_skill->english_description}}</a></h3>
                @endif
                
            </div>
         </div>   
         <div class="row">
            <div class="col-md-12">
                @if (file_exists($scout_image))
                <img class="img-responsive" src="/images/cards/get/{{$card->boy_id}}_{{$card->card_id}}.png">
                @endif
            </div>
         </div>   
</div>
@endsection
