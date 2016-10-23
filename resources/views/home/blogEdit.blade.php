@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Editing {{$blog->title}}</h1>
    

    <div class="row">
    	<div class="col-md-12">
			{!! Form::open(['url' => '/edit/blog']) !!}

            <div class="form-group">
              <label for="active">Active 1 - visible 0 - not visible</label>
              {!! Form::select('active',[0,1],$blog->active,['class'=>'form-control', 'id'=>'active']) !!} 
            </div>
            <div class="form-group">
              <label for="japanese-name">Title</label>
               {!! Form::text('title',$blog->title,['class'=>'form-control','id'=>'title']) !!}
            </div>                  
			      <div class="form-group">
              <label for="blurb">Blurb - Short description that shows up on the main page</label>
               {!! Form::text('blurb',$blog->blurb,['class'=>'form-control','id'=>'blurb']) !!}
            </div>   
            <div class="form-group">
              <label for="s-name">Content</label>
               {!! Form::textarea('content',$blog->content,['class'=>'form-control','id'=>'content']) !!}
            </div>    
            <div class="form-group">
              <label for="image">Image - Not Required most probably wont have one</label>
               {!! Form::text('image',$blog->image,['class'=>'form-control','id'=>'image']) !!}
            </div>
            <div class="form-group">
              <label for="url">Url Slug - URL friendly characters (no spaces just characters) eg this-is-a-good-url </label>
               {!! Form::text('url',$blog->url,['class'=>'form-control','id'=>'url']) !!}
            </div>                  
               {!! Form::hidden('blog_id',$blog->id) !!}                                                                       
            {!! Form::submit('Edit') !!}
            {!! Form::close() !!}
			
    	</div>
   	</div>

</div>


@endsection
