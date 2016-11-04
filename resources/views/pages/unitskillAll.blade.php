@extends('layouts.layout')

@section('title')
@parent
All Unit Skills | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        	<h1>All Unit Skills</h1>

            @foreach($unit_skills as $skill)          
            <div class="row">
                <div class="col-md-3">
                    <!--<a href="/unitskill/{{$skill->url}}"><img class="img-responsive" src="/images/unitskills/{{$skill->id}}.png"></a>-->
                    <a href="/unitskill/{{$skill->url}}"><h3>{{$skill->name_e}}  +{{$skill->percent}}% {{$skill->type}}</h3></a>
                </div>
                <div class="col-md-9">
                     @foreach($skill->boys as $boy)
                        <a href="/idol/{{$boy->first_name}}">{{$boy->first_name}} {{$boy->last_name}}</a> | 
                     @endforeach
                </div>
            </div>
            <hr>
            @endforeach


    </div>
</div>
@endsection
