@extends('layouts.layout')

@section('content')
    <div class="container">

        <h1>All News</h1>


        <div class="row">
            <div class="col-md-12">
                @foreach($blogs as $blog)
                    <a href="/news/{{$blog->url}}"><h4>{!! $blog->title !!}</h4></a>
                    {{date('F j, Y',strtotime($blog->created_at))}} by {{$blog->author->name}}
                    <hr>

                @endforeach

            </div>
        </div>

    </div>


@endsection
