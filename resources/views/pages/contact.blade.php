@extends('layouts.layout')

@section('title')
@parent
Contact Us | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Contact Us</h1>


            {!! Form::open(['url' => '/contact/send']) !!}


            <div class="form-group">
              <label for="name">Name</label>
               {!! Form::text('name','',['class'=>'form-control','id'=>'name']) !!}
            </div>                  
                  <div class="form-group">
              <label for="email">Email</label>
               {!! Form::text('email','',['class'=>'form-control','id'=>'email']) !!}
            </div>   
            <div class="form-group">
              <label for="s-name">Message</label>
               {!! Form::textarea('message','',['class'=>'form-control','id'=>'message']) !!}
            </div>    
               {!! Form::hidden('enstars','',['class'=>'form-control','id'=>'message']) !!}
                                                                       
            {!! Form::submit('Send') !!}
            {!! Form::close() !!}


        </div>

    </div>
</div>
@endsection
