@extends('layouts.layout')

@section('title')
@parent
Release Notes | enstars.info
@stop

@section('content')

<div class="container">
  @foreach($notes as $note) 
    Version: {{$note->version}}<br>
    Released: {{$note->release_date}}<br><br>

    {!! $note->notes !!}
    <hr>

  @endforeach
</div> <!-- end container -->
@endsection
