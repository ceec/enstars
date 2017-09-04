@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Add New Blog Post</h1>
    
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
    	<div class="col-md-12">
			{!! Form::open(['url' => '/add/blog']) !!}


            <div class="form-group">
              <label for="japanese-name">Title</label>
               {!! Form::text('title','',['class'=>'form-control','id'=>'title']) !!}
            </div>                  
			      <div class="form-group">
              <label for="blurb">Blurb - Short description that shows up on the main page</label>
               {!! Form::text('blurb','',['class'=>'form-control','id'=>'blurb']) !!}
            </div>   
            <div class="form-group">
              <label for="s-name">Story</label>
               {!! Form::number('story_id','',['class'=>'form-control','id'=>'story_id','placeholder'=>'Story id translated here, dont need to write content']) !!}
            </div>                
            <div class="form-group">
              <label for="s-name">Chapter</label>
               {!! Form::number('chapter_id','',['class'=>'form-control','id'=>'chapter_id','placeholder'=>'Chapter id translated here, dont need to write content']) !!}
            </div>              
            <div class="form-group">
              <label for="s-name">Content</label>
               {!! Form::textarea('content','',['class'=>'form-control','id'=>'content']) !!}
            </div>    
            <div class="form-group">
              <label for="image">Image - Not Required most probably wont have one</label>
               {!! Form::text('image','',['class'=>'form-control','id'=>'image']) !!}
            </div>
            <div class="form-group">
              <label for="url">Url Slug - URL friendly characters (no spaces just characters) eg this-is-a-good-url </label>
               {!! Form::text('url','',['class'=>'form-control','id'=>'url']) !!}
            </div>                  
                                                                       
            {!! Form::submit('Add') !!}
            {!! Form::close() !!}
			
    	</div>
   	</div>

</div>


@endsection
