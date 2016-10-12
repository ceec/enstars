@extends('layouts.layout')

@section('title')
@parent
{{$unit->name}} | Ensemble Stars
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$unit->name}}</h1>
                <div class="row">
                    <?php $x=1; ?>
                    @foreach($boys as $boy)
                    	<div class="col-md-3">
                                <h2>{{$boy->english_name}}</h2>
                                <h2>{{$boy->japanese_name}}</h2>
    							<div class="panel">
    							  <div class="panel-heading">
    							    <h3 class="panel-title">
                                    </h3>
    							  </div>
    							</div>   
						</div>             
                        <?php
                            if ($x%4==0) {
?>
                            </div>
                            <div class="row">
<?php                            
                            }
                            $x++;
                        ?>
                    @endforeach
                </div>


        </div>

    </div>
</div>
@endsection
