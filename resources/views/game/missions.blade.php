@extends('layouts.layout')

@section('title')
@parent
Missions | enstars.info
@stop

@section('content')

<div class="container">
  <h2>Missions</h2>
  @foreach($missions as $mission) 
    {{$mission->jp}} : {{$mission->en}}<br>
  @endforeach
</div> <!-- end container -->
@endsection
