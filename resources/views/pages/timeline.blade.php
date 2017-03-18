@extends('layouts.layout')

@section('title')
@parent
Timeline | enstars.info
@stop

@section('content')
<div class="container">
    <h1>Timeline</h1>
    <div class="row">
        <div class="col-md-12">

        @foreach ($scouts as $scout)
            {{$scout->name_e}}<br>
        @endforeach
        </div>
    </div>    
</div>
@endsection
