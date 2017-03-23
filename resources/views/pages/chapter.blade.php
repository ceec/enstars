@extends('layouts.layout')

@section('title')
@parent
{{$chapter->name_e}} | enstars.info
@stop

@section('content')
	<?php
		$count = count($slides); 

		//set up urls

		if ($story->type == 1) {
			$event_type = 'event';
		} else if ($story->type == 2){
			$event_type = 'gacha';
		} else if ($story->type == 3) {
			$event_type = 'character';
		}

    if ($story->type == 3) {
      //add in the boy id
      $event_type = 'character/'.$story->boy_id;
    }

		//determine image class from phone source
		if ($chapter->source == 'lg') {
			$source = "lg";
		} else {
			$source = "iphone";
		}
	?>

	<style>
	.slide-lg { 
   position: relative; 
   width: 560px; 
    overflow: hidden;
}

	.slide-iphone { 
   position: relative; 
   width: 100%; 
}



.name-text-lg {
   position: absolute; 
   top: 230px; 
   left: 120px; 
   width: 70px;
   height: 20px;
   font-size: 12px;
   color: #FFF;
   background-color: #26a2de;
}

.slide-text-lg { 
   position: absolute; 
   top: 250px; 
   left: 120px; 
   width: 330px;
   height: 75px;
   font-size: 12px;
   background-color: white;
}

.name-text-iphone {
   position: absolute; 
   top: 230px; 
   left: 140px; 
   width: 70px;
   height: 20px;
   font-size: 12px;
   color: #FFF;
   background-color: #26a2de;
}

.slide-text-iphone { 
   position: absolute; 
   top: 250px; 
   left: 140px; 
   width: 330px;
   height: 75px;
   font-size: 12px;
   background-color: white;
  /* box-shadow: 0 0 5px 10px #FFF;*/
}

  .row {
      position: relative;
  }


@media (min-width: 992px) {
  .bottom-align-text {
    position: absolute;
    bottom: 0;
    right: 0;
  }
  }



	</style>
<div class="container">


		    <h1>{{$story->name_e}} - {{$chapter->name_e}}
          @if (isset($next_chapter->chapter))
            <small><a href="/story/{{$story->id}}/{{$next_chapter->chapter}}">Next Chapter</a></small>
          @endif
          
        </h1>

		    @foreach ($slides as $slide)
		    	@if ($slide->slide > 1)
		        <div class="row">
        			<div class="col-md-7">
<?php
						$slide_number = str_pad($slide->slide,2,'0',STR_PAD_LEFT);
?>
				    	<div class="slide-{{$source}}">
				        	<img src="/images/translate/{{$event_type}}/{{$story->id}}/{{$chapter->chapter}}_{{$slide_number}}.{{$chapter->file_type}}">
				        	@if ($slide->boy_id !=0)
				        		<p class="name-text-{{$source}}">{{$slide->boy_name}}</p>
				        	@endif
				        	<p class="slide-text-{{$source}}">{!! $slide->text_e !!}</p>
				        </div>
		          	</div>
		          	<div class="col-md-5 bottom-align-text">
		          	<p>{!! $slide->notes !!}</p>
		          	</div>
   				 </div>
   				 <br>
   				 @endif
		    @endforeach
          @if (isset($previous_chapter->chapter))
            <h4><a href="/story/{{$story->id}}/{{$previous_chapter->chapter}}">Previous Chapter</a>
          @endif
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          @if (isset($next_chapter->chapter))
            <a href="/story/{{$story->id}}/{{$next_chapter->chapter}}">Next Chapter</a></h4>
          @endif


</div>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})
</script>
@endsection
