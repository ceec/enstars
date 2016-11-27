@extends('layouts.layout')

@section('title')
@parent
Dashboard | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Dashboard</h1>
        	<div class="row">
        		<div class="col-md-3">
        			Fav card here?
        			Wanted cards?
        			Recently got cards?
        		</div>
        		<div class="col-md-9">
        			<a href="{{ url('/user/'.Auth::user()->name.'/cards') }}">My Cards</a>
        		</div>
        	</div>


        </div>

    </div>
</div>
@endsection
