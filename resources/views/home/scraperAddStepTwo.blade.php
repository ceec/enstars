@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Add New Event/Scout - Step 2</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(['url' => '/add/scraper/step/two']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name_j">Japanese Name</label>
                    {!! Form::text('name_j',$scraper['japanese_name'],['class'=>'form-control','id'=>'name_j']) !!}
                </div>
                <div class="form-group">
                    <label for="s-name">Start Date</label>
                    {!! Form::text('start',$scraper['start_date'],['class'=>'form-control','id'=>'chapter_id','placeholder'=>'Chapter id translated here, dont need to write content']) !!}
                </div>
                <div class="form-group">
                    <label for="s-name">End Date</label>
                    {!! Form::text('end',$scraper['end_date'],['class'=>'form-control','id'=>'content']) !!}
                </div>
                <div class="form-group">
                    <label for="url">Url</label>
                    {!! Form::text('website',$scraper['url'],['class'=>'form-control','id'=>'url']) !!}
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" class="form-control" id="type">
                        <option value="1">gachas</option>
                        <option value="4">events</option>
                        <option value="2">story scout</option>
                        <option value="3">revival scout</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="url">Short Url</label>
                    {!! Form::text('url','',['class'=>'form-control','id'=>'url','placeholder'=>'']) !!}
                </div>
                {!! Form::submit('Add') !!}
                {!! Form::close() !!}
            </div>


        </div>
    </div>

    </div>


@endsection
