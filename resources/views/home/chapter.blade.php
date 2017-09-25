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
    <h1><div class="col-xs-6"> {!! Form::text('name_e',$chapter->name_e,['class'=>'form-control name_e','id'=>$chapter->id]) !!} </div>- {{$story->name_e}} <small>({{$count}} slides)</small>

    @if ($chapter->complete == 1)
        <button id="display-chapter" class="btn btn-danger chapter-display" data-id="{{$chapter->id}}" data-display="hide">Hide</button></h1>
    @else 
        <button id="display-chapter" class="btn btn-success chapter-display" data-id="{{$chapter->id}}" data-display="display">Display</button></h1>
    @endif
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
			
			{!! Form::textarea('text_j',$slide->text_j,['class'=>'form-control ajaxTest','id'=>'j-'.$slide->id, 'rows' => 3, 'cols' => 100, 'placeholder'=>'Japanese Text']) !!} <br>
			{!! Form::textarea('text_e', $slide->text_e,['class'=>'form-control ajaxTest','id'=>'e-'.$slide->id, 'rows' => 3, 'cols' => 100, 'placeholder'=>'English Text']) !!} 
            @foreach($boys as $key => $boy)
                <button class="add-boy-css" data-class="{{$boy}}" data-slide="{{$slide->id}}">{{$boy}}</button> 
            @endforeach
            <br>
			{!! Form::textarea('notes', $slide->notes,['class'=>'form-control ajaxTest', 'id'=>'n-'.$slide->id, 'rows' => 3, 'cols' => 100, 'placeholder'=>'Notes']) !!} <br>
			{!! Form::hidden('slide_id', $slide->id) !!}
			{!! Form::hidden('chapter_id', $chapter->id) !!}
			{!! Form::hidden('story_id', $story->id) !!}
			{!! Form::select('boy_id', $boys,$slide->boy_id, ['class'=>'dropdownAjax','id'=>'s-'.$slide->id, 'placeholder' => 'Speaker']) !!}   {{$slide->slide}} | Last updated: <span id="lastupdated-{{$slide->id}}">{{$slide->updated_at}}</span>
			
    	</div>
   	</div>
   	<br><br>
    @endforeach
</div>
            <script>

            //adding in class names to textarea with button press - Christine -2017-09-24
            function getInputSelection(el) {
    var start = 0, end = 0, normalizedValue, range,
        textInputRange, len, endRange;

    if (typeof el.selectionStart == "number" && typeof el.selectionEnd == "number") {
        start = el.selectionStart;
        end = el.selectionEnd;
    } else {
        range = document.selection.createRange();

        if (range && range.parentElement() == el) {
            len = el.value.length;
            normalizedValue = el.value.replace(/\r\n/g, "\n");

            // Create a working TextRange that lives only in the input
            textInputRange = el.createTextRange();
            textInputRange.moveToBookmark(range.getBookmark());

            // Check if the start and end of the selection are at the very end
            // of the input, since moveStart/moveEnd doesn't return what we want
            // in those cases
            endRange = el.createTextRange();
            endRange.collapse(false);

            if (textInputRange.compareEndPoints("StartToEnd", endRange) > -1) {
                start = end = len;
            } else {
                start = -textInputRange.moveStart("character", -len);
                start += normalizedValue.slice(0, start).split("\n").length - 1;

                if (textInputRange.compareEndPoints("EndToEnd", endRange) > -1) {
                    end = len;
                } else {
                    end = -textInputRange.moveEnd("character", -len);
                    end += normalizedValue.slice(0, end).split("\n").length - 1;
                }
            }
        }
    }

    return {
        start: start,
        end: end
    };
}

function replaceSelectedText(el, text) {
    var sel = getInputSelection(el), val = el.value;
    el.value = val.slice(0, sel.start) + text + val.slice(sel.end);
}


$('.add-boy-css').on('click',function(){
    var text = window.getSelection().toString();
    
    //this would have to be the closest text area.
    var slideID = $(this).data("slide");
    var className = $(this).data("class");
    
    //get selected text
    var text = window.getSelection().toString();

    //wrap selected text in a class with boy's name <span class="Tori">text</span>
    var el = document.getElementById("e-"+slideID);
    replaceSelectedText(el, '<span class="'+className+'">'+text+'</span>');

    //save added classes 
    var slideName = 'text_e';
    var slideValue = $('#e-'+slideID).val();

    slideContentAjax(slideID,slideName,slideValue);

});





	//lets copy code
	//http://stackoverflow.com/questions/14042193/how-to-trigger-an-event-in-input-text-after-i-stop-typing-writing
	var delay = (function(){
  		var timer = 0;
  		return function(callback, ms){
  			clearTimeout (timer);
  			timer = setTimeout(callback, ms);
 		};
	})();

    //2017-08-30 adding ajax for the title box


$('.name_e').keyup(function(test) {
    var $self = $(this);
    //make this global to get into the delay function
    name_e = $self.val();
    chapterID = $self.attr('id');


  delay(function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            type: "POST",
            url: '/add/chapterName',
            data: {chapter_id:chapterID,name_e:name_e},
            dataType: 'json',
            success: function (data) {
                //console.log(data);
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });
  }, 1000 );
});



//http://stackoverflow.com/questions/28051963/jquery-keypress-function-with-multiple-input-with-same-id


//saving slide content
function slideContentAjax(slideID,slideName,slideValue) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

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
}



//save the content of the textareas on keyup
$('.ajaxTest').keyup(function(test) {
	var $self = $(this);
	//make this global to get into the delay function
	slideValue = $self.val();
	slideID = $self.attr('id');

    //remove the first two characters - Christine 2017-09-24
    slideID = slideID.slice(2);

	slideName = $self.attr('name');

  //wait one second
  delay(function(){
    //save the content
    slideContentAjax(slideID,slideName,slideValue);
  }, 1000 );
});




///submit the speaker box
    $('.dropdownAjax').change(function() {
		var $self = $(this);
		//make this global to get into the delay function
		slideSpeaker = $self.val();
		slideID = $self.attr('id');
		slideName = $self.attr('name');
        //remove the first two characters - Christine 2017-09-24
        slideID = slideID.slice(2);

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
