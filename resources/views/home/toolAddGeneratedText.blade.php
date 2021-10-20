@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h2>Upload Generated Text</h2>
                {!! Form::open(['url' => '/add/translation/generatedText']) !!}
                {!! Form::textarea('text_g','',['class'=>'form-control ',  'placeholder'=>'Generated Text']) !!} <br>
                {!! Form::text('chapter_id', '',['class'=>'form-control',  'placeholder'=>'Chapter ID']) !!} <br>
                {!! Form::submit('Add') !!}
            </div>


            {!! Form::close() !!}
        </div>

    </div>
@endsection
