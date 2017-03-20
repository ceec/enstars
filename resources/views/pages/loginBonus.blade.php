@extends('layouts.layout')

@section('title')
@parent
{{$event->name_e}} - Login Event | enstars.info
@stop

@section('content')
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
   top: 215px; 
   left: 52px; 
   width: 70px;
   height: 16px;
   font-size: 12px;
   color: #FFF;
   background-color: #39b7d8;
}

.slide-text-lg { 
   position: absolute; 
   top: 234px; 
   left: 45px; 
   width: 200px;
   height: 45px;
   font-size: 10.5px;
   background-color: #ede7e7;
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
        	<h1>{{$event->name_e}}</h1>
            <div class="row">
            @foreach ($days as $day)
<?php


                //determine image class from phone source
                if ($day->source == 'lg') {
                    $source = "lg";
                } else {
                    $source = "iphone";
                }
    ?>               
                 <div class="col-md-6">     
                        <div class="slide-{{$source}}">
                            <img src="/images/bonus/{{$event->id}}/day_{{$day->day}}.{{$day->file_type}}">
                            @if ($day->boy_id !=0)
                                <p class="name-text-{{$source}}">{{$day->boy->first_name}}</p>
                            @endif                            
                            <p class="slide-text-{{$source}}">{!! $day->text_e !!}</p>
                        </div>                 
                 <p>Day {{$day->day}} - {{$day->date}}</p>
                </div>

               
            @endforeach
             </div>

</div>
@endsection
