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
                <?php
                if ($skill->type_id == 1) {
                    $friendly_name = 'dance';
                } else if ($skill->type_id == 2) {
                    $friendly_name = 'vocal';
                } else {
                    $friendly_name = 'performance';
                }
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-responsive" src="/images/{{$friendly_name}}.png">
                            </div>
                            <div class="col-md-8">
                                <a href="/unitskill/{{$skill->url}}"><h3>+{{$skill->percent}}% {{$skill->type}}
                                        - {{$skill->name_e}}</h3></a>
                            </div>
                        </div>
                    <!--<a href="/unitskill/{{$skill->url}}"></a>-->

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
