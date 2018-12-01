@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Add New Scout</h1>
    
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

			{!! Form::open(['url' => '/add/scout']) !!}
    <div class="row">
    	<div class="col-md-6">
            <div class="form-group">
              <label for="name_j">Japanese Name</label>
               {!! Form::text('name_j','',['class'=>'form-control','id'=>'name_j']) !!}
            </div>                  
			      <div class="form-group">
              <label for="name_e">Name</label>
               {!! Form::text('name_e','',['class'=>'form-control','id'=>'name_e']) !!}
            </div>   
			      <div class="form-group">
              <label for="name_s">Name Silly</label>
               {!! Form::text('name_s','',['class'=>'form-control','id'=>'name_s']) !!}
            </div>               
            <div class="form-group">
              <label for="s-name">Type Id</label>
               {!! Form::select('type_id',[1=>"Normal",2=>"Story",3=>"Revival"],['class'=>'form-control','id'=>'story_id','placeholder'=>'Event Type']) !!}
            </div>                
            <div class="form-group">
              <label for="s-name">Start Date</label>
               {!! Form::text('start','0',['class'=>'form-control','id'=>'chapter_id','placeholder'=>'Chapter id translated here, dont need to write content']) !!}
            </div>              
            <div class="form-group">
              <label for="s-name">End Date</label>
               {!! Form::text('end','',['class'=>'form-control','id'=>'content']) !!}
            </div>    
      </div>
      <div class="col-md-6">
            <div class="form-group">
              <label for="image">Text - Japanese</label>
               {!! Form::text('text_j','',['class'=>'form-control','id'=>'image']) !!}
            </div>
            <div class="form-group">
              <label for="image">Text</label>
               {!! Form::text('text','',['class'=>'form-control','id'=>'image']) !!}
            </div>            
            <div class="form-group">
              <label for="website">Website</label>
               {!! Form::text('website','',['class'=>'form-control','id'=>'website']) !!}
            </div>                  
            <div class="form-group">
              <label for="url">Url</label>
               {!! Form::text('url','',['class'=>'form-control','id'=>'url','placeholder'=>'']) !!}
            </div>           
      </div>                                                                      
            {!! Form::submit('Add') !!}
            {!! Form::close() !!}
			
    	</div>
   	</div>

</div>


@endsection
