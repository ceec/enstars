@extends('layouts.layout')

@section('title')
@parent
enstar.info| Ensemble Stars Information
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9 post">
                <!-- Blog Post -->
                <!-- Title -->
                <h1>{{$blog->title}}</h1>
                <!-- Author and time -->
                <?php
                    $nicedate = date('F d, Y',strtotime($blog->created_at));

                    //$blog->content = html_entity_decode($blog->content);
                ?>
                <p>
                    Posted on {{$nicedate}} by <a href="#">{{$blog->author}}</a>
                </p>
                <hr>
                <!-- Post Content -->
                <?php print $blog->content; ?>
                <hr>
                    <div id="disqus_thread"></div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-2">
            <h3>Students</h3>
            @foreach($boys as $boy)
                <?php 
                    //name pretty for url
                    $url = strtolower($boy->first_name);
                ?>

                <a href="/idol/{{$url}}">{{$boy->first_name}} {{$boy->last_name}}</a>  <br>
            @endforeach

            <h3>Teachers</h3>
            @foreach($teachers as $boy)
                <?php 
                    //name pretty for url
                    $url = strtolower($boy->first_name);
                ?>

                <a href="/idol/{{$url}}">{{$boy->first_name}} {{$boy->last_name}}</a>  <br>
            @endforeach            
        </div>

    </div>
</div>
@endsection
