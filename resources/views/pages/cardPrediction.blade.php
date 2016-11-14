@extends('layouts.layout')

@section('title')
@parent
Card Prediction | enstars.info
@stop

@section('content')
<div class="container">

        	<h1>Card Prediction</h1>
         <div class="row">
            <div class="col-md-12">
            @foreach($boys as $boy)
                <?php
                    print '<pre>';
                    print_r($boy);
                    print '</pre>';
                ?>
                {{$boy->first_name}}  {{$boy->last_name}}<br>
            @endforeach
            </div>
         </div>   
 
</div>
@endsection
