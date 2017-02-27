@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="col-md-6">
    		<h2>Add Event Data</h2>
			{!! Form::open(['url' => '/add/event/data']) !!}
			{!! Form::text('event_id','46',['class'=>'form-control ',  'placeholder'=>'Event ID']) !!} <br>
            {!! Form::text('position','4',['class'=>'form-control ',  'placeholder'=>'Position']) !!} <br>
            Rank<br>
            {!! Form::text('rank_1', '1',['class'=>'']) !!} {!! Form::text('tier_1', '',['class'=>'',  'placeholder'=>'Rank 1 Points']) !!} <br>
            {!! Form::text('rank_2', '1200',['class'=>'']) !!} {!! Form::text('tier_2', '',['class'=>'',  'placeholder'=>'Rank 2 Points']) !!} <br>
            {!! Form::text('rank_3', '2500',['class'=>'']) !!} {!! Form::text('tier_3', '',['class'=>'',  'placeholder'=>'Rank 3 Points']) !!} <br>
            {!! Form::text('rank_4', '4000',['class'=>'']) !!} {!! Form::text('tier_4', '',['class'=>'',  'placeholder'=>'Rank 4 Points']) !!} <br>
            {!! Form::text('rank_5', '6000',['class'=>'']) !!} {!! Form::text('tier_5', '',['class'=>'',  'placeholder'=>'Rank 5 Points']) !!} <br>
            {!! Form::text('rank_6', '8500',['class'=>'']) !!} {!! Form::text('tier_6', '',['class'=>'',  'placeholder'=>'Rank 6 Points']) !!} <br>
            {!! Form::text('rank_7', '11000',['class'=>'']) !!} {!! Form::text('tier_7', '',['class'=>'',  'placeholder'=>'Rank 7 Points']) !!} <br>
            {!! Form::text('rank_8', '15000',['class'=>'']) !!} {!! Form::text('tier_8', '',['class'=>'',  'placeholder'=>'Rank 8 Points']) !!} <br>
            {!! Form::text('rank_9', '19000',['class'=>'']) !!} {!! Form::text('tier_9', '',['class'=>'',  'placeholder'=>'Rank 9 Points']) !!} <br>
            {!! Form::text('rank_10', '23000',['class'=>'']) !!} {!! Form::text('tier_10', '',['class'=>'',  'placeholder'=>'Rank 10 Points']) !!} <br>
            {!! Form::text('rank_11', '28000',['class'=>'']) !!} {!! Form::text('tier_11', '',['class'=>'',  'placeholder'=>'Rank 11 Points']) !!} <br>
            {!! Form::text('rank_12', '35000',['class'=>'']) !!} {!! Form::text('tier_12', '',['class'=>'',  'placeholder'=>'Rank 12 Points']) !!} <br>
            {!! Form::text('participants', '',['class'=>'form-control','placeholder'=>'Total Player Amount']) !!}

            <br>
			 {!! Form::submit('Add') !!} 
			{!! Form::close() !!}  
    	</div>
    	<div class="col-md-6">
    	</div>    	
   	</div>
    
</div>
@endsection
