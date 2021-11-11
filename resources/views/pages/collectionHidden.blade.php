@extends('layouts.layout')

@section('title')
    @parent
    Collection - {{$user->name}} | enstars.info
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$user->name}} has made their collection private.</h1>


            </div>

        </div>
    </div>
@endsection
