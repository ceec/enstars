@extends('layouts.layout')

@section('title')
@parent
{{$skill->name_e}} | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>+{{$skill->percent}}% {{$skill->type}} - {{$skill->name_e}}</h1>
            <p>{!! $skill->description_e !!}</p>

            @foreach ($boys as $boy)
                <div class="row">
                    <div class="col-md-2">
                        {{$boy->first_name}} {{$boy->last_name}}
                    </div>
                <div class="col-md-10">
                    <div class="row">
                    <?php $x=1; ?>
                    @foreach($boy->cards as $card)
                        <div class="col-md-2">
                                <div class="panel">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a href="/card/{{$card->id}}">
                                            <div class="card-container"><img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png"></div>
                                        </a>    
                                    </h3>
                                  </div>
                                </div>   
                        </div>             
                        <?php
                            if ($x%5==0) {
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

            @endforeach


        </div>

    </div>
</div>
@endsection
