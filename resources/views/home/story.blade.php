@extends('layouts.app')

@section('content')
<div class="container">
<h1>{{$story->name_e}} </h1>
	<div class="row">
		<div class="col-md-6">
			<h2>Chapters</h2>
		    @foreach ($chapters as $chapter)
		        {{$chapter->percent}}% <a href="/home/translations/{{$story->id}}/{{$chapter->id}}">{{$chapter->name_e}}</a><br>
		    @endforeach
		</div>
		<div class="col-md-6">
			<h2>Mini Events</h2>
			@foreach($mini as $event)
				<a href="/home/translations/{{$story->id}}/minievent/{{$event->id}}">{{$event->name_e}}</a><br>
			@endforeach
		</div>
	</div>

</div>
@endsection
