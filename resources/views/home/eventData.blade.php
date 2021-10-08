@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <h2>Add Event Data</h2>
                {!! Form::open(['url' => '/add/event/data']) !!}
                {!! Form::text('event_id',$current_event->id,['class'=>'form-control ',  'placeholder'=>'Event ID','tabindex'=>'1']) !!}
                <br>
                <br>
                Rank<br>
                {!! Form::text('rank_1', '1',['class'=>'']) !!} {!! Form::text('tier_1', '',['class'=>'',  'placeholder'=>'Rank 1 Points','tabindex'=>'2']) !!}
                <br>
                {!! Form::text('rank_2', '2000',['class'=>'']) !!} {!! Form::text('tier_2', '',['class'=>'',  'placeholder'=>'Rank 2 Points','tabindex'=>'3']) !!}
                <br>
                {!! Form::text('rank_3', '4000',['class'=>'']) !!} {!! Form::text('tier_3', '',['class'=>'',  'placeholder'=>'Rank 3 Points','tabindex'=>'4']) !!}
                <br>
                {!! Form::text('rank_4', '6000',['class'=>'']) !!} {!! Form::text('tier_4', '',['class'=>'',  'placeholder'=>'Rank 4 Points','tabindex'=>'5']) !!}
                <br>
                {!! Form::text('rank_5', '8500',['class'=>'']) !!} {!! Form::text('tier_5', '',['class'=>'',  'placeholder'=>'Rank 5 Points','tabindex'=>'6']) !!}
                <br>
                {!! Form::text('rank_6', '11000',['class'=>'']) !!} {!! Form::text('tier_6', '',['class'=>'',  'placeholder'=>'Rank 6 Points','tabindex'=>'7']) !!}
                <br>
                {!! Form::text('rank_7', '15000',['class'=>'']) !!} {!! Form::text('tier_7', '',['class'=>'',  'placeholder'=>'Rank 7 Points','tabindex'=>'8']) !!}
                <br>
                {!! Form::text('rank_8', '19000',['class'=>'']) !!} {!! Form::text('tier_8', '',['class'=>'',  'placeholder'=>'Rank 8 Points','tabindex'=>'9']) !!}
                <br>
                {!! Form::text('rank_9', '23000',['class'=>'']) !!} {!! Form::text('tier_9', '',['class'=>'',  'placeholder'=>'Rank 9 Points','tabindex'=>'10']) !!}
                <br>
                {!! Form::text('rank_10', '28000',['class'=>'']) !!} {!! Form::text('tier_10', '',['class'=>'',  'placeholder'=>'Rank 10 Points','tabindex'=>'11']) !!}
                <br>
                {!! Form::text('rank_11', '35000',['class'=>'']) !!} {!! Form::text('tier_11', '',['class'=>'',  'placeholder'=>'Rank 11 Points','tabindex'=>'12']) !!}
                <br>
                {!! Form::text('participants', '',['class'=>'form-control','placeholder'=>'Total Player Amount','tabindex'=>'13']) !!}

                <br>
                {!! Form::submit('Add') !!}
                {!! Form::close() !!}
            </div>
            <div class="col-md-6">
            </div>
        </div>

    </div>
@endsection
