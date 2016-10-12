@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="col-md-6">
    		<h2>Add new Chapter Slides</h2>
			{!! Form::open(['url' => '/add/translation/slides']) !!}
			{!! Form::text('chapter_id','',['class'=>'form-control ',  'placeholder'=>'Chapter ID']) !!} <br>
			{!! Form::text('amount', '',['class'=>'form-control',  'placeholder'=>'Amount']) !!} <br>
			 {!! Form::submit('Add') !!} 
			{!! Form::close() !!}  
    	</div>
    	<div class="col-md-6">
    	</div>    	
   	</div>
    
</div>
@endsection
