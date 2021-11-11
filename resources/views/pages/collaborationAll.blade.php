@extends('layouts.layout')

@section('title')
    @parent
    All Collaborations | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <h1>All Collaborations</h1>

            @foreach($collaborations as $collaboration)
                <?php
                //friendly dates
                $start_date = date('F d, Y', strtotime($collaboration->start));
                $end_date = date('F d, Y', strtotime($collaboration->end));
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <a href="/collaboration/{{$collaboration->url}}"><img class="img-responsive"
                                                                              src="/images/collaborations/{{$collaboration->id}}.png"></a>
                    </div>
                    <div class="col-md-9">
                        <a href="/collaboration/{{$collaboration->url}}"><h3>{{$collaboration->name_e}}</h3>
                            <br>{{$start_date}} to {{$end_date}}</a>
                    </div>
                </div>
                <hr>
            @endforeach


        </div>
    </div>
@endsection
