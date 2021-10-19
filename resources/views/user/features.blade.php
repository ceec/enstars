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
                        {!! Form::open(['url' => '/user/add/feature/comment']) !!}

                        <div class="form-group">
                            <label for="url">Feature</label>
                            {!! Form::textarea('feature','',['class'=>'form-control','id'=>'url','placeholder'=>'Describe the feature you would like to see!']) !!}
                        </div>
                        {!! Form::submit('Add') !!}
                        {!! Form::close() !!}

                    </div>
                    <hr>
                @endforeach

            </div>
        </div>
    </div>
@endsection
