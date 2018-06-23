@extends('layouts.app')

@section('content')
<div class="container">
<h1>Suggestions </h1>
	<div class="row">
		<div class="col-md-12">
      <h2>New Issues</h2>
      @foreach($issues as $issue)
        <p>{{$issue->created_at}} | {{$issue->card_id}} - {{$issue->message}}</p>
            {!! Form::open(['url' => '/home/cardissues/clear']) !!}
            {!! Form::hidden('issue_id',$issue->id) !!}                                                                       
            {!! Form::submit('Clear') !!}
            {!! Form::close() !!}
        <hr>
      @endforeach
		</div>
	</div>

</div>
@endsection
