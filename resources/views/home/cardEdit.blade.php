@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Card -  {{$card->name_e}}</h1>
    

    <div class="row">
    	<div class="col-md-4">
      <img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png">
    	<img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}b.png">
    	</div>
    	<div class="col-md-8">
			{!! Form::open(['url' => '/home/edit/card']) !!}
                  <div class="form-group">
                    <label for="boy">Boy</label>
                    {!! Form::select('boy_id', $boys,$card->boy_id ,['class'=>'form-control', 'id'=>'boy','placeholder' => 'Boy']) !!} 
                  </div>
                  <div class="form-group">
                    <label for="card-placement">Card Placement</label>
                    {!! Form::text('place',$card->place ,['class'=>'form-control', 'id'=>'card-placement']) !!} 
                  </div>                  
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
			
    	</div>
   	</div>

</div>


@endsection
