@extends('layouts.layout')

@section('title')
@parent
All Events | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        	<h1>All Events</h1>

            @foreach($events as $event)
<?php
                //friendly dates
                $start_date = date('F d, Y',strtotime($event->start));
                $end_date = date('F d, Y',strtotime($event->end));    
?>            
            <div class="row">
                <div class="col-md-3">
                    <a href="/event/{{$event->url}}"><img class="img-responsive" src="/images/events/{{$event->id}}.png"></a>
                </div>
                <div class="col-md-9">
                     <a href="/event/{{$event->url}}"><h3>{{$event->name_e}}</h3><br>{{$start_date}} to {{$end_date}}</a>
                </div>
            </div>
            <hr>
            @endforeach


    </div>
</div>
@endsection
