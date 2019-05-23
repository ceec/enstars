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
                    <label for="s-name">Placeholder Name</label>
                     {!! Form::text('name_s','',['class'=>'form-control','id'=>'s-name']) !!}
                  </div>   
                  <div class="form-group">
                    <label for="stars">Stars</label>
                    <select name="stars" class="form-control" id="stars">
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                  </div>    
                  <div class="form-group">
                    <label for="type">Type</label>
                    <select name="color" class="form-control" id="type">
                        <option value="">Type</option>
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
<script>
      $('#type').change(function() {
        var color = $(this).val();
        //TODO: need to change the db to a lookup table or something here
        if (color === 'red') {
          type = 'dance';
        } else if (color === 'blue') {
          type = 'vocal';
        } else {
          type = 'performance';
        }
        console.log(type);
          $.get('/api/skill/dreamfestival/'+type,function(data){
            //clear out dorifes-id options
            var select = document.getElementById('dorifes-id');
            select.options.length=0;

            //need to parse this for just what I want
            for (const skill of data) {
              //create a new dorifes option
              var option = document.createElement('option');
              option.value = skill.id;
              option.innerHTML = skill.english_description;
              select.appendChild(option);
            }          

          },'json');






		// var $self = $(this);
		// //make this global to get into the delay function
		// slideSpeaker = $self.val();
		// slideID = $self.attr('id');
		// slideName = $self.attr('name');
    //     //remove the first two characters - Christine 2017-09-24
    //     slideID = slideID.slice(2);

    // $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     })

    //     //e.preventDefault(); 
    //     $.ajax({

    //         type: "POST",
    //         url: '/add/translationajax',
    //         data: {slide_id:slideID,name:slideName,value:slideSpeaker},
    //         dataType: 'json',
    //         success: function (data) {
    //         	//update the timestamp
    //         	$('#lastupdated-'+slideID).html(data.date);
    //             //console.log(data);
    //         },
    //         error: function (data) {
    //             //console.log('Error:', data);
    //         }
    //     });
    });
  </script>

@endsection
