@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Blog Posts</h1>
    

    <div class="row">
    	<div class="col-md-12">
      @foreach($blogs as $blog)
        {{date('Y-m-d',strtotime($blog->created_at))}} <a href="/home/blog/edit/{{$blog->id}}">{{ $blog->title }}</a><br>

      @endforeach
			
    	</div>
   	</div>

</div>


@endsection
