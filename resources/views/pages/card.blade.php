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

                            if ($source) {
                                //format starting date
                                $start_date = date('F j, Y',strtotime($source->start));
                            } else {
                                $start_date = 'Original Card';
                            }


                            //image url
                            $scout_image = '/images/cards/get/'.$card->boy_id.'_'.$card->card_id.'.png';
                            //echo $scout_image;
                        ?>  
        	<h1>{{$card->name_e}} <small><a href="/idol/{{ strtolower($boy->first_name)}}">{{$boy->first_name}} {{$boy->last_name}}</a></small></h1>
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
                    <h3>Introduced in: Scout: <a href="/scout/{{$source->url}}">{{$source->name_e}}</a></h3>
                @elseif ($from == 'event')
                    <h3>Introduced in: Event: <a href="/event/{{$source->url}}">{{$source->name_e}}</a></h3>
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

                @if (!Auth::guest())

                    @if (Auth::user()->isAdmin())
                    
                            {!! Form::open(['url' => '/edit/card']) !!}             
                                  <div class="form-group">
                                    <label for="japanese-name">Japanese Name</label>
                                     {!! Form::text('japanese_name',$card->name_j,['class'=>'form-control','id'=>'japanese-name']) !!}
                                  </div>                  
                                  <div class="form-group">
                                    <label for="english-name">English Name</label>
                                     {!! Form::text('english_name',$card->name_e,['class'=>'form-control','id'=>'english-name']) !!}
                                  </div>   
                                  <div class="form-group">
                                    <label for="s-name">Placeholder Name</label>
                                     {!! Form::text('name_s',$card->name_s,['class'=>'form-control','id'=>'s-name']) !!}
                                  </div>   
                                  <div class="form-group">
                                    <label for="sentence-j">Japanese Sentence (when scouted or on promo materials)</label>
                                     {!! Form::text('sentence_j',$card->sentence_j,['class'=>'form-control','id'=>'sentence-j']) !!}
                                  </div>  
                                  <div class="form-group">
                                    <label for="sentence-e">English Sentence (when scouted or on promo materials)</label>
                                     {!! Form::text('sentence_e',$card->sentence_e,['class'=>'form-control','id'=>'sentence-e']) !!}
                                  </div> 
                                  <div class="form-group">
                                    <label for="dorifes_j">Japanese Dorifes Skill </label>
                                     {!! Form::text('dorifes_j',$card->dorifes_j,['class'=>'form-control','id'=>'dorifes_j']) !!}
                                  </div>  
                                  <div class="form-group">
                                    <label for="dorifes_e">English Dorifes Skill</label>
                                     {!! Form::text('dorifes_e',$card->dorifes_e,['class'=>'form-control','id'=>'dorifes_e']) !!}
                                  </div>      
                                  <div class="form-group">
                                    <label for="lesson_j">Japanese Lesson Skill </label>
                                     {!! Form::text('lesson_j',$card->lesson_j,['class'=>'form-control','id'=>'lesson_j']) !!}
                                  </div>  
                                  <div class="form-group">
                                    <label for="lesson_e">English Lesson Skill</label>
                                     {!! Form::text('lesson_e',$card->lesson_e,['class'=>'form-control','id'=>'lesson_e']) !!}
                                  </div>                                                                                           
                                <div class="form-group">
                                    <label for="stars">Stars</label>
                                     {!! Form::text('stars',$card->stars,['class'=>'form-control','id'=>'stars']) !!}
                                  </div>  
                                <div class="form-group">
                                    <label for="stars">Color</label>
                                     {!! Form::text('color',$card->color,['class'=>'form-control','id'=>'color']) !!}
                                  </div>
                                  <div class="form-group">
                                    <label for="lesson-skill">Lesson Skill</label>
                                    {!! Form::select('lesson_id', $lesson_skills,$card->lesson_id ,['class'=>'form-control', 'id'=>'lesson-skill','placeholder' => 'Lesson Skill']) !!} 
                                  </div>
                                  <div class="form-group">
                                    <label for="dorifes-id">Dream Festival Skill</label>
                                    {!! Form::select('dorifes_id', $dorifes_skills,$card->dorifes_id,['class'=>'form-control', 'id'=>'dorifes-id','placeholder' => 'Dream Festival Skill']) !!} 
                                  </div>                   
                                  {!! Form::hidden('card_id', $card->id) !!}                                                      
                            {!! Form::submit('Edit') !!}
                            {!! Form::close() !!}
                    @endif   
                @endif             
            </div>
         </div>   
</div>
@endsection
