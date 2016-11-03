@extends('layouts.layout')

@section('title')
@parent
All Scouts | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        	<h1>All Scouts</h1>

            @foreach($scouts as $scout)
<?php
                //friendly dates
                $start_date = date('F d, Y',strtotime($scout->start));
                $end_date = date('F d, Y',strtotime($scout->end));    
?>            
            <div class="row">
                <div class="col-md-3">
                    <a href="/scout/{{$scout->url}}"><img class="img-responsive" src="/images/scouts/{{$scout->id}}.png"></a>
                </div>
                <div class="col-md-9">
                     <a href="/scout/{{$scout->url}}"><h3>{{$scout->name_e}}</h3><br>{{$start_date}} to {{$end_date}}</a>
                </div>
            </div>
            <hr>
            @endforeach


    </div>
</div>
@endsection
