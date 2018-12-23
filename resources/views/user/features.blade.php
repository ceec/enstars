@extends('layouts.layout')

@section('title')
@parent
Feature Suggestions | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

          <h1>Feature Requests</h1>
          <a href="/user/feature/suggest">Suggest New Feature</a>
          <br><br>
          @foreach($features as $feature)
          <div>
            <p>
              {{$feature->feature}}
            </p>
            Suggested by {{$feature->user->name}} on {{$feature->created_at}}
          </div>
          <hr>
          @endforeach

        </div>
    </div>
</div>
@endsection
