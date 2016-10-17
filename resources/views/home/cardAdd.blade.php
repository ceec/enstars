@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Add New Card</h1>
    

    <div class="row">
    	<div class="col-md-4">
        Picture would be here
    	<img class="img-responsive" src="">
    	</div>
    	<div class="col-md-8">
			{!! Form::open(['url' => '/add/card']) !!}
                  <div class="form-group">
                    <label for="boy">Boy</label>
                    {!! Form::select('boy_id', $boys,'' ,['class'=>'form-control', 'id'=>'boy','placeholder' => 'Boy']) !!} 
                  </div>
                  <div class="form-group">
                    <label for="japanese-name">Japanese Name</label>
                     {!! Form::text('japanese_name','',['class'=>'form-control','id'=>'japanese-name']) !!}
                  </div>                  
			      <div class="form-group">
                    <label for="english-name">English Name</label>
                     {!! Form::text('english_name','',['class'=>'form-control','id'=>'english-name']) !!}
                  </div>   
                  <div class="form-group">
                    <label for="stars">Stars</label>
                    <select name="stars" class="form-control" id="stars">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                  </div>    
                  <div class="form-group">
                    <label for="type">Type</label>
                    <select name="color" class="form-control" id="type">
                        <option value="red">Dance</option>
                        <option value="blue">Vocal</option>
                        <option value="yellow">Performance</option>
                    </select>
                  </div>   
                  <div class="form-group">
                    <label for="lesson-skill">Lesson Skill</label>
                    {!! Form::select('lesson_id', $lesson_skills,'' ,['class'=>'form-control', 'id'=>'lesson-skill','placeholder' => 'Lesson Skill']) !!} 
                  </div>
                  <div class="form-group">
                    <label for="dorifes-id">Dream Festival Skill</label>
                    {!! Form::select('dorifes_id', $dorifes_skills,'' ,['class'=>'form-control', 'id'=>'dorifes-id','placeholder' => 'Dream Festival Skill']) !!} 
                  </div>                                                                         
            {!! Form::submit('Add') !!}
            {!! Form::close() !!}
			
    	</div>
   	</div>

</div>


@endsection
