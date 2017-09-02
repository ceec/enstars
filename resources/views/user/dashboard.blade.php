@extends('layouts.layout')

@section('title')
@parent
Dashboard | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Dashboard - <a href="/user/{{Auth::user()->name}}">{{Auth::user()->name}}</a></h1>
        	<div class="row">
        		<div class="col-md-3">
                        
                    <img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png">
        		</div>
                <div class="row">
                    <div class="col-md-4">
                        <h3><a href="{{ url('/user/'.Auth::user()->name.'/cards') }}">My Cards</a></h3>
                        <h3><a href="{{ url('/user/'.Auth::user()->name.'/scouts') }}">My Scouts</a></h3>
                    </div>
                    <div class="col-md-8">

                    </div>
                </div>
                <div class="col-md-3">
                    
                </div>
        		<div class="col-md-6">
        			
        		</div>
        	</div>
            <div class="row">

            </div>


        </div>

    </div>
</div>
@endsection
