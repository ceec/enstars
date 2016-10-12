@extends('layouts.app')

@section('content')
<div class="container">
	<?php
		$count = count($slides); 

		//set up urls

		if ($story->type == 1) {
			$event_type = 'event';
		} else if ($story->type == 2){
			$event_type = 'gacha';
		} else if ($story->type == 3) {
			$event_type = 'character/'.$story->boy_id;
		}
	?>
    <h1>{{$chapter->name_e}} - {{$story->name_e}} <small>({{$count}} slides)</small></h1>
    
    @foreach ($slides as $slide)
    <?php
    	//i just had to put zero prefixes
    	$slide_number = str_pad($slide->slide,2,'0',STR_PAD_LEFT);
    ?>
    <div class="row">
    	<div class="col-md-6">
    	<img class="img-responsive" src="/images/translate/{{$event_type}}/{{$story->id}}/{{$chapter->chapter}}_{{$slide_number}}.{{$chapter->file_type}}">
    	</div>
    	<div class="col-md-6">
			
			{!! Form::textarea('text_j',$slide->text_j,['class'=>'form-control ajaxTest','id'=>$slide->id, 'rows' => 3, 'cols' => 100, 'placeholder'=>'Japanese Text']) !!} <br>
			{!! Form::textarea('text_e', $slide->text_e,['class'=>'form-control ajaxTest','id'=>$slide->id, 'rows' => 3, 'cols' => 100, 'placeholder'=>'English Text']) !!} <br>
			{!! Form::textarea('notes', $slide->notes,['class'=>'form-control ajaxTest', 'id'=>$slide->id, 'rows' => 3, 'cols' => 100, 'placeholder'=>'Notes']) !!} <br>
			{!! Form::hidden('slide_id', $slide->id) !!}
			{!! Form::hidden('chapter_id', $chapter->id) !!}
			{!! Form::hidden('story_id', $story->id) !!}
			{!! Form::select('boy_id', $boys,$slide->boy_id, ['class'=>'dropdownAjax','id'=>$slide->id, 'placeholder' => 'Speaker']) !!}   {{$slide->slide}} | Last updated: <span id="lastupdated-{{$slide->id}}">{{$slide->updated_at}}</span>
			
    	</div>
   	</div>
   	<br><br>
    @endforeach
</div>
<script>
	//lets do some ajax woop

	//should I use $ for jQuery SEEMS SO WEIRD

	//jQuery('body').on('click','')

	//lets copy code
	//http://stackoverflow.com/questions/14042193/how-to-trigger-an-event-in-input-text-after-i-stop-typing-writing
	var delay = (function(){
  		var timer = 0;
  		return function(callback, ms){
  			clearTimeout (timer);
  			timer = setTimeout(callback, ms);
 		};
	})();



//http://stackoverflow.com/questions/28051963/jquery-keypress-function-with-multiple-input-with-same-id

$('.ajaxTest').keyup(function(test) {
	var $self = $(this);
	//make this global to get into the delay function
	slideValue = $self.val();
	slideID = $self.attr('id');
	slideName = $self.attr('name');

	//do i need to pass through the type? or just use it as a variable in PHP

  delay(function(){
  	// $.post('/add/translationajax',{slide_id:slideID,name:slideName,value:slideValue},function(data) {
  	// 	//on success dooo
  	// 	console.log('posted!');
  	// 	console.log(data);
  	// });



    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        //e.preventDefault(); 
        $.ajax({

            type: "POST",
            url: '/add/translationajax',
            data: {slide_id:slideID,name:slideName,value:slideValue},
            dataType: 'json',
            success: function (data) {
            	//update the timestamp
            	$('#lastupdated-'+slideID).html(data.date);
                //console.log(data);
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });




    //console.log(slideValue);
    //console.log(slideID);
    //console.log(slideName);
  }, 1000 );
});

///submmit the speaker box
    $('.dropdownAjax').change(function() {
		var $self = $(this);
		//make this global to get into the delay function
		slideSpeaker = $self.val();
		slideID = $self.attr('id');
		slideName = $self.attr('name');


    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        //e.preventDefault(); 
        $.ajax({

            type: "POST",
            url: '/add/translationajax',
            data: {slide_id:slideID,name:slideName,value:slideSpeaker},
            dataType: 'json',
            success: function (data) {
            	//update the timestamp
            	$('#lastupdated-'+slideID).html(data.date);
                //console.log(data);
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });



    });


</script>
@endsection
