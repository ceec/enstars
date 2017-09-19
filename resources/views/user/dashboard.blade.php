@extends('layouts.layout')

@section('title')
@parent
Dashboard | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Dashboard - <a href="/user/dashboard">{{Auth::user()->name}}</a></h1>
        	<div class="row">
        		<div class="col-md-3">
                        
                    <img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png">
        		</div>
                <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <h3><a href="{{ url('/user/'.Auth::user()->name.'/cards') }}">Cards</a></h3>
                        <h3><a href="{{ url('/user/'.Auth::user()->name.'/account') }}">Account Options</a></h3>
                        <h3><a href="{{ url('/collection/'.Auth::user()->name) }}">Collection</a></h3>
                       <!-- <h3><a href="{{ url('/user/'.Auth::user()->name.'/scouts') }}">My Scouts</a></h3>-->
                    </div>
                    <div class="col-md-8">
                        <h3>How to add cards</h3>
                        <p>When you are logged into an account all cards on the boy card list pages get a new Add button. Click on it to add the card to your collection!</p>
                        <h3>Updating card stats</h3>
                        <p>Once the card is in your collection, tracking features for that card are available on each card's page. Add in how many copies you have any other stats!</p>
                        <h3>How to share your collection</h3>
                        <p>The <a href="/collection/{{Auth::user()->name}}">Collection</a> is viewable to anyone, no account needed. Use it to share your collection with others.</p>
                        <p>Want to keep your collection private? Use the button on the top of the collection page to show/hide visibility.</p>
                    </div>
                </div>
                </div>
        	</div>
            <div class="row">

            </div>


        </div>

    </div>
</div>
@endsection
