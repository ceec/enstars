@extends('layouts.layout')

@section('title')
@parent
Dashboard | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Account Options - <a href="/user/dashboard">{{Auth::user()->name}}</a></h1>

        	<div class="row">
        		<div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
            

                                                                       
                    
                            <h3>Collection Visibility:  
                            @if($user->display_collection == 1)
                                Displayed
                            @else
                                Hidden
                            @endif       
                            </h3>                 
                        </div>
                        <div class="col-md-8">
                            <br>
                            {!! Form::open(['url' => '/update/user/account']) !!}
                             @if ($user->display_collection == 1)
                                {!! Form::submit('Hide Collection',['name'=>'display_collection']) !!}
                            @else 
                                {!! Form::submit('Display Collection',['name'=>'display_collection']) !!}
                            @endif 

                            
                            {!! Form::close() !!}                                                            
                        </div>
                    </div>



                        

        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection
