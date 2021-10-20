@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Messages </h1>
        <div class="row">
            <div class="col-md-12">
                <h2>New Messages</h2>
                @foreach($messages as $message)
                    <p>{{$message->created_at}} | {{$message->message}}</p>
                    {!! Form::open(['url' => '/home/message/clear']) !!}
                    {!! Form::hidden('message_id',$message->id) !!}
                    {!! Form::submit('Clear') !!}
                    {!! Form::close() !!}

                    {!! Form::open(['url' => '/home/message/delete']) !!}
                    {!! Form::hidden('message_id',$message->id) !!}
                    {!! Form::submit('Delete') !!}
                    {!! Form::close() !!}
                    <hr>
                @endforeach
            </div>
        </div>

    </div>
@endsection
