@extends('layouts.layout')

@section('title')
@parent
{{$event->name}} | Ensemble Stars
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$event->name}} <small>{{$event->start}} - {{$event->end}}</small></h1>

            <h2>Cards</h2>
                <div class="row">

                </div>


        </div>

    </div>
</div>
@endsection
