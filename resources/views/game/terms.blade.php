@extends('layouts.layout')

@section('title')
@parent
Terms | enstars.info
@stop

@section('content')

<div class="container">
  <h2>Terms</h2>
  @foreach($terms as $term) 
    {{$term->jp}} : {{$term->en}}<br>
  @endforeach
</div> <!-- end container -->
@endsection
