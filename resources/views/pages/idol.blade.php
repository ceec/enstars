@extends('layouts.layout')

@section('title')
@parent
{{$boy->english_name}} | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$boy->english_name}}</h1>
                <div class="row">
                    <?php $x=1; ?>
                    @foreach($cards as $card)
                        <?php
                            //set up the colors
                            if ($card->color == 'red') {
                                $color_class = 'panel-danger';
                            } else if ($card->color == 'blue') {
                                $color_class = 'panel-info';
                            } else if ($card->color == 'yellow') {
                                $color_class = 'panel-warning';
                            } else {
                                $color_class = 'panel-default';
                            }

                            //set up the stars
                            if ($card->stars == '1') {
                                $stars = '<span class="glyphicon glyphicon-star " aria-hidden="true"></span>';
                            } else if ($card->stars == '2') {
                                $stars = '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                            } else if ($card->stars == '3') {
                                $stars = '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                            } else if ($card->stars == '4') {
                                $stars = '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                            } else if ($card->stars == '5') {
                                $stars = '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                            } else {
                                $stars = '';
                            }
                        ?>  
                    	<div class="col-md-3">
                            @if ($stars != '')
    							<div class="panel {{$color_class}}">
    							  <div class="panel-heading">
    							    <h3 class="panel-title">
                                       <!--<div class="pull-right">{!! $stars !!}</div>-->
                                        <a href="/card/{{$card->id}}"><div class="card-container" id="card-{{$card->card_id}}"><img class="img-responsive" src="/images/cards/{{$boy->id}}_{{$card->card_id}}.png"></div></a>
                                        <span class="glyphicon glyphicon-certificate bloom" id="bloom-{{$card->card_id}}" data-id="{{$card->card_id}}" data-boy="{{$boy->id}}" aria-hidden="true"></span>
                                         {{$card->card_id}} {{$card->name_e}} ({{$card->name_s}}) 
                                    </h3>
    							  </div>
    							  <div class="panel-body">
                                  <!--  Da: {{$card->da}}  Vo: {{$card->vo}} Pf: {{$card->pf}}
    							   <p>
    							    	Dorifes Skill: {{$card->dorifes_skill}}
    							    </p>-->
    							    <p>
    							    	Lesson Skill: {{$card->lesson_skill}}
    							    </p>
    							  </div>
    							</div>
                            @elseif (($stars =='') && ($card->card_id != 1))
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">{{$card->card_id}} Unknown</h3>
                                        <!--<img class="img-responsive" src="/images/cards/{{$boy->id}}_{{$card->card_id}}.png">-->

                                    </div>
                                    <div class="panel-body">
                                        @if ($card->suggested_name == '')
                                        Suggest Name/Description: 
                                        {!! Form::open(['url' => '/add/name']) !!}
                                        {!! Form::text('name') !!}
                                        {!! Form::hidden('first_name', $boy->first_name) !!}
                                        {!! Form::hidden('card_id', $card->id) !!}
                                        {!! Form::submit('Add') !!}
                                        {!! Form::close() !!}
                                        @else
                                        Name/Description: {{$card->suggested_name}}
                                        @endif
                                        <br><br>
                                        @if ($card->suggested_link == '')
                                        Suggest Link: 
                                        {!! Form::open(['url' => '/add/link']) !!}
                                        {!! Form::text('link') !!}
                                        {!! Form::hidden('first_name', $boy->first_name) !!}
                                        {!! Form::hidden('card_id', $card->id) !!}
                                        {!! Form::submit('Add') !!}
                                        {!! Form::close() !!}
                                        @else
                                        Link: <a href="{{$card->suggested_link}}" >{{$card->suggested_name}}</a>
                                        @endif
                                    </div>
                                </div>
                            @else
                            @endif       
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
                                <script>
                                jQuery('body').on('click','.bloom',function() {
                                    var cardID = jQuery(this).data('id');
                                    var boyID = jQuery(this).data('boy');
                                    jQuery('#card-'+cardID).html('<img class="img-responsive" src="/images/cards/'+boyID+'_'+cardID+'b.png">');
                                    jQuery('#bloom-'+cardID).removeClass('bloom').addClass('unbloom');
                                    jQuery('#bloom-'+cardID).removeClass('glyphicon-certificate').addClass('glyphicon-record');                                    
                                });

                                jQuery('body').on('click','.unbloom',function() {
                                    var cardID = jQuery(this).data('id');
                                    var boyID = jQuery(this).data('boy');
                                    jQuery('#card-'+cardID).html('<img class="img-responsive" src="/images/cards/'+boyID+'_'+cardID+'.png">');
                                    jQuery('#bloom-'+cardID).removeClass('unbloom').addClass('bloom');
                                     jQuery('#bloom-'+cardID).removeClass('glyphicon-record').addClass('glyphicon-certificate');
                                }); 

                             
                                </script>    
</div>
@endsection
