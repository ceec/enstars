@extends('layouts.layout')

@section('title')
@parent
{{$minievent->name_e}} - Minievent | enstars.info
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
      $event_type = 'character/'.$story->boy_id;
    }

		//determine image class from phone source
		if ($minievent->source == 'lg') {
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

.minievent-choice1-lg {
   position: absolute; 
   top: 130px; 
   left: 150px; 
   width: 250px;
   height: 25px;
   font-size: 12px;
   background-color: white;
}

.minievent-choice2-lg {
   position: absolute; 
   top: 185px; 
   left: 150px; 
   width: 250px;
   height: 25px;
   font-size: 12px;
   background-color: white;
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


		    <h1>{{$minievent->name_e}}</h1>

		    @foreach ($slides as $slide)
		    	@if ($slide->slide > 1)
		        <div class="row">
        			<div class="col-md-7">
<?php
						$slide_number = str_pad($slide->slide,2,'0',STR_PAD_LEFT);
?>
				    	<div class="slide-{{$source}}">
				        	<img src="/images/translate/{{$event_type}}/{{$story->id}}/minievent/{{$minievent->id}}_{{$slide_number}}.{{$minievent->file_type}}">
                  @if ($slide->slide_type == 3)
                    <?php $x = 1; ?>
                    @foreach($choices as $choice)
                      @if($choice->slide == 1)
                        <p class="minievent-choice{{$x}}-{{$source}}">{{$choice->text_e}}</p>
                        <?php $x++; ?>
                      @endif
                    @endforeach
                  @endif
				        		<p class="name-text-{{$source}}">{{$boy->first_name}}</p>
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
        @foreach ($choices as $choice)
          @if ($choice->slide == 1)
            <h3>{{$choice->text_e}}</h3>
          @else
            <div class="row">
              <div class="col-md-7">
<?php
            $slide_number = str_pad($choice->slide,2,'0',STR_PAD_LEFT);
?>
              <div class="slide-{{$source}}">
                  <img src="/images/translate/{{$event_type}}/{{$story->id}}/minievent/choice/{{$minievent->id}}_{{$choice->choice_id}}_{{$slide_number}}.{{$minievent->file_type}}">
                    <p class="name-text-{{$source}}">{{$boy->first_name}}</p>
                  <p class="slide-text-{{$source}}">{!! $choice->text_e !!}</p>
                </div>
                </div>
                <div class="col-md-5 bottom-align-text">
                <p>{!! $choice->notes !!}</p>
                </div>
           </div>
           <br>
          @endif
          <?php $choiceid = 0; ?>     
        @endforeach



</div>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})
</script>
@endsection
