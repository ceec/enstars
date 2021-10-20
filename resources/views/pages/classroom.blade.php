@extends('layouts.layout')

@section('title')
    @parent
    Class {{$classroom->class}} | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>Class {{$classroom->class}}</h1>
                <div class="row">
                    <?php $x = 1; ?>
                    @foreach($boys as $boy)
                        <div class="col-md-3">
                            <h2><a href="/idol/{{ strtolower($boy->first_name)}}">{{$boy->english_name}}</a></h2>
                            <h2>{{$boy->japanese_name}}</h2>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($x % 4 == 0) {
                        ?>
                </div>
                <div class="row">
                    <?php
                    }
                    $x++;
                    ?>
                    @endforeach
                </div>


            </div>

        </div>
        <h2>Events</h2>
        <h2>Stories</h2>
    </div>
@endsection
