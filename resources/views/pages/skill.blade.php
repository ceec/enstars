@extends('layouts.layout')

@section('title')
@parent
{{$skill->english_description}} | Ensemble Stars
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$skill->english_description}}</h1>
                <div class="row">
                    <?php $x=1; ?>
                    @foreach($cards as $card)
                    	<div class="col-md-3">
    							<div class="panel">
    							  <div class="panel-heading">
    							    <h3 class="panel-title">
                                        <div class="card-container"><img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png"></div>
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
