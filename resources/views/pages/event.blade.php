@extends('layouts.layout')

@section('title')
@parent
{{$event->name_e}} | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$event->name_e}} <small>{{$event->start}} - {{$event->end}}</small></h1>
            <p>{!! $event->text !!}</p>
            <div class="row">
            <div class="row">
                <div class="col-md-2">
                        @if ($chapters != '')
                            <h3>Event Story</h3>
                            @foreach ($chapters as $chapter)
                                @if ($chapter->complete == 1)
                                    <a href="/story/{{$story->id}}/{{$chapter->chapter}}">{{$chapter->name_e}}</a><br>
                                @else
                                    {{$chapter->name_e}}<br>
                                @endif
                            @endforeach
                        @endif
                </div>
                <div class="col-md-10">
                    <div class="row">
                    <?php $x=1; ?>
                    @foreach($cards as $card)
                    	<div class="col-md-3">
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
</div>
@endsection
