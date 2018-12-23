@extends('layouts.app')

@section('content')
<div class="container">
<h1>Feature Requests</h1>
	<div class="row">
		<div class="col-md-12">
      <h2>New Feature Requests</h2>
      @foreach($features as $feature)
        <p>{{$feature->created_at}} | {{$feature->feature}}
        <br>
        Submitted by:{{$feature->submitted_by}}</p>
            {!! Form::open(['url' => '/home/feature/approve']) !!}
            {!! Form::hidden('feature_id',$feature->id) !!}                                                                       
            {!! Form::submit('Approve') !!}
            {!! Form::close() !!}

            {!! Form::open(['url' => '/home/feature/delete']) !!}
            {!! Form::hidden('feature_id',$feature->id) !!}                                                                       
            {!! Form::submit('Delete') !!}
            {!! Form::close() !!}
        <hr>
      @endforeach
		</div>
	</div>

</div>
@endsection
