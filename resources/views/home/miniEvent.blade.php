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
    <h1>{{$minievent->name_e}} - {{$story->name_e}} <small>({{$count}} slides)</small>

    @if ($minievent->complete == 1)
        <button id="display-chapter" class="btn btn-danger chapter-display" data-id="{{$minievent->id}}" data-display="hide">Hide</button></h1>
    @else 
        <button id="display-chapter" class="btn btn-success chapter-display" data-id="{{$minievent->id}}" data-display="display">Display</button></h1>
    @endif
    @foreach ($slides as $slide)
    <?php
    	//i just had to put zero prefixes
    	$slide_number = str_pad($slide->slide,2,'0',STR_PAD_LEFT);
    ?>
    <div class="row">
    	<div class="col-md-6">
    	<img class="img-responsive" src="/images/translate/{{$event_type}}/{{$story->id}}/minievent/{{$minievent->id}}_{{$slide_number}}.{{$minievent->file_type}}">
    	</div>
    	<div class="col-md-6">
			{!! Form::textarea('text_j',$slide->text_j,['class'=>'form-control ajaxTest','id'=>$slide->id, 'choice_type'=>'text','rows' => 3, 'cols' => 100, 'placeholder'=>'Japanese Text']) !!} <br>
			{!! Form::textarea('text_e', $slide->text_e,['class'=>'form-control ajaxTest','id'=>$slide->id,'choice_type'=>'text', 'rows' => 3, 'cols' => 100, 'placeholder'=>'English Text']) !!} <br>
			{!! Form::textarea('notes', $slide->notes,['class'=>'form-control ajaxTest', 'id'=>$slide->id, 'choice_type'=>'text','rows' => 3, 'cols' => 100, 'placeholder'=>'Notes']) !!} <br>
			{!! Form::hidden('slide_id', $slide->id) !!}
			{!! Form::hidden('minievent_id', $minievent->id) !!}
			{!! Form::hidden('story_id', $story->id) !!}
            Last updated: <span id="lastupdated-{{$slide->id}}">{{$slide->updated_at}}</span>
			
    	</div>
   	</div>
   	<br><br>
    @endforeach

    
        @foreach($choices as $choice)
            @if ($choice->slide == 1)
            <h2>Choice {{$choice->choice_id}}: 
                {!! Form::text('text_e', $choice->text_e,['class'=>'form-control ajaxTest','id'=>$choice->id, 'choice_type'=>'choice', 'rows' => 3, 'cols' => 100, 'placeholder'=>'English Text']) !!} 
                </h2>
            @elseif ($choice->slide > 1)
                <?php
                    //i just had to put zero prefixes
                    $slide_number = str_pad($choice->slide,2,'0',STR_PAD_LEFT);                 
                ?>            
                <div class="row">
                    <div class="col-md-6">
                    <img class="img-responsive" src="/images/translate/{{$event_type}}/{{$story->id}}/minievent/choice/{{$minievent->id}}_{{$choice->choice_id}}_{{$slide_number}}.{{$minievent->file_type}}">
                    </div>
                    <div class="col-md-6">
                        {!! Form::textarea('text_j',$choice->text_j,['class'=>'form-control ajaxTest','id'=>$choice->id, 'choice_type'=>'choice','rows' => 3, 'cols' => 100, 'placeholder'=>'Japanese Text']) !!} <br>
                        {!! Form::textarea('text_e', $choice->text_e,['class'=>'form-control ajaxTest','id'=>$choice->id, 'choice_type'=>'choice','rows' => 3, 'cols' => 100, 'placeholder'=>'English Text']) !!} <br>
                        {!! Form::textarea('notes', $choice->notes,['class'=>'form-control ajaxTest', 'id'=>$choice->id, 'choice_type'=>'choice','rows' => 3, 'cols' => 100, 'placeholder'=>'Notes']) !!} <br>
                        {!! Form::hidden('slide_id', $choice->id) !!}
                        {!! Form::hidden('minievent_id', $minievent->id) !!}
                        {!! Form::hidden('story_id', $story->id) !!}
                        Last updated: <span id="lastupdated-{{$choice->id}}">{{$choice->updated_at}}</span>
                    </div>
                </div>
                <br><br>
            @endif
            
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
    type = $self.attr('choice_type');

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
            url: '/add/minievent/translationajax',
            data: {slide_id:slideID,name:slideName,value:slideValue,type:type},
            dataType: 'json',
            success: function (data) {
            	//update the timestamp
            	$('#lastupdated-'+slideID).html(data.date);
                //console.log(data);
            },
            error: function (data) {
                console.log('Error:', data.responseText);
            }
        });




    //console.log(slideValue);
    //console.log(slideID);
    //console.log(slideName);
  }, 1000 );
});



    //displaying/hiding the chapter
    $('body').on('click','.chapter-display',function() {
        var chapterID = $(this).data('id');

        var display = $(this).data('display');

        var show;

        if (display == 'display') {
            //need to display it
            show = 1;
        } else {
            //need to hide it 
            show = 0;
        }

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        //e.preventDefault(); 
        $.ajax({

            type: "POST",
            url: '/add/chapterDisplay',
            data: {chapter_id:chapterID,show:show},
            dataType: 'json',
            success: function (data) {
                if (data.chapter == 1) {
                    $('#display-chapter').html('Hide')
                    $('#display-chapter').removeClass('btn-success').addClass('btn-danger');
                    $('#display-chapter').data('display','hide');
                } else {
                    $('#display-chapter').html('Display');
                    $('#display-chapter').removeClass('btn-danger').addClass('btn-success');
                    $('#display-chapter').data('display','display');
                }
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });



    });
</script>
@endsection
