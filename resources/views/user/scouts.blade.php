@extends('layouts.layout')

@section('title')
@parent
Scouts | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
    <h1>Scouts - <a href="/user/{{Auth::user()->name}}">{{Auth::user()->name}}</a></h1>
        <div class="col-md-12">

            @foreach($scouts as $scout)

            @endforeach
        	



        </div>



        </div>
    </div>
</div>
@endsection
