@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Add New Event/Scout</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(['url' => '/add/scraper']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="url">Url</label>
                    {!! Form::text('url','',['class'=>'form-control','id'=>'url']) !!}
                </div>
                <div class="form-group">
                    <label for="type">Url</label>
                    <select name="type" class="form-control" id="type">
                        <option value="scout">gachas</option>
                        <option value="event">events</option>
                        <option value="revival">revivals</option>
                    </select>
                </div>
                {!! Form::submit('Add') !!}
                {!! Form::close() !!}
            </div>


        </div>
    </div>

    </div>


@endsection
