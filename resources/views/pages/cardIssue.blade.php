@extends('layouts.layout')

@section('title')
@parent
Contact Us | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Card Issue for {{$card->id}}</h1>
          <div cass="row">
            <div class="col-md-3">
              <a href="/card/{{$card->id}}"><img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png"></a>
            </div>
            <div class="col-md-9">
                          {!! Form::open(['url' => '/cardissue/send']) !!}
            <div class="form-group">
              <label for="s-name">Message</label>
               {!! Form::textarea('message','',['class'=>'form-control','id'=>'message']) !!}
            </div>    
               {!! Form::hidden('card_id',$card->id,['class'=>'form-control','id'=>'message']) !!}
                                                                       
            {!! Form::submit('Send') !!}
            {!! Form::close() !!}

            </div>
          </div>



        </div>

    </div>
</div>
@endsection
