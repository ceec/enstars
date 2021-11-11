@extends('layouts.layout')

@section('title')
    @parent
    All Unit Collections | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <h1>All Unit Collections</h1>

            @foreach($collections as $collection)
                <?php
                //friendly dates
                $start_date = date('F d, Y', strtotime($collection->start));
                $end_date = date('F d, Y', strtotime($collection->end));
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <a href="/unitcollection/{{$collection->url}}"><img class="img-responsive"
                                                                            src="/images/collections/{{$collection->id}}.png"></a>
                    </div>
                    <div class="col-md-9">
                        <a href="/unitcollection/{{$collection->url}}"><h3>{{$collection->name_e}}</h3>
                            <br>{{$start_date}} to {{$end_date}}</a>
                    </div>
                </div>
                <hr>
            @endforeach


        </div>
    </div>
@endsection
