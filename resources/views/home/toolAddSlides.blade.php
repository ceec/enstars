@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="col-md-4">
    		<h2>Add new Chapter Slides</h2>
			{!! Form::open(['url' => '/add/translation/slides']) !!}
			{!! Form::text('chapter_id','',['class'=>'form-control ',  'placeholder'=>'Chapter ID']) !!} <br>
			{!! Form::text('amount', '',['class'=>'form-control',  'placeholder'=>'Amount']) !!} <br>
			 {!! Form::submit('Add') !!} 
    	</div>
    	<div class="col-md-8">
        <div class="row">
            <div class="col-md-4">
             @foreach($boys as $id => $boy)
                    
               {{$boy}}  <input type="checkbox" name="boys[]" value="{{$id}}"> <br>
               @if ($id == 32)
               </div>
                <div class="col-md-4">
               @endif
               
             @endforeach 
             </div>      
             </div>       
    	</div>    	

        {!! Form::close() !!}  
   	</div>
    
</div>
@endsection
