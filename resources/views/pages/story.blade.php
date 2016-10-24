@extends('layouts.layout')

@section('title')
@parent
{{$story->name_e}} | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

		    <h1>{{$story->name_e}} Chapters</h1>

		    @foreach ($chapters as $chapter)
		    	@if ($chapter->complete == 1)
		        	<a href="/story/{{$story->id}}/{{$chapter->chapter}}">{{$chapter->name_e}}</a><br>
		    	@else
		    		{{$chapter->name_e}}<br>
		    	@endif
		    @endforeach


        </div>

    </div>
</div>
@endsection
