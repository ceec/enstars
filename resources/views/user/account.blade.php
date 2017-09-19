@extends('layouts.layout')

@section('title')
@parent
Dashboard | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Account Options - <a href="/user/dashboard">{{Auth::user()->name}}</a></h1>
        	<div class="row">
        		<div class="col-md-12">
                    <h3>Collection Visibility:                         @if ($user->display_collection == 1)
        <button id="display-chapter" class="btn btn-danger chapter-display" data-id="{{$user->display_collection}}" data-display="hide">Hide Collection</button></h1>
    @else 
        <button id="display-chapter" class="btn btn-success chapter-display" data-id="{{$user->display_collection}}" data-display="display">Display Collection</button></h1>
    @endif
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection
