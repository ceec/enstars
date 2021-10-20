@extends('layouts.layout')

@section('title')
    @parent
    Feature Requests | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>Suggest New Feature</h1>

                {!! Form::open(['url' => '/user/add/feature']) !!}

                <div class="form-group">
                    <label for="url">Feature</label>
                    {!! Form::textarea('feature','',['class'=>'form-control','id'=>'url','placeholder'=>'Describe the feature you would like to see!']) !!}
                </div>
                {!! Form::submit('Add') !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
