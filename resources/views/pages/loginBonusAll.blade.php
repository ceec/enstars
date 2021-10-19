@extends('layouts.layout')

@section('title')
    @parent
    {{$skill->english_description}} | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>{{$skill->english_description}}</h1>
                <div class="row">

                </div>

            </div>

        </div>
    </div>
@endsection
