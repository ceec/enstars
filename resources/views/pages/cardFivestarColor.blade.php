@extends('layouts.layout')

@section('title')
@parent
5 star History | enstars.info
@stop

@section('content')
<div class="container">

        	<h1>5 Star History - Color Time</h1>
            <div class="row">
                <div class="col-md-12">
                <style>
                .white-link {
                    color: white;
                }

                .white-link:hover {
                    color: white;
                }

                </style>

                <table class="table-condensed table-bordered">
                    <tr>
                        <th>Event</th>
                        <th>Ranking 5</th>
                        <th>Ranking Boy</th>                        
                        <th>Points 5</th>
                        <th>Boy</th>
                        <th>Points 5</th>
                         <th>Boy</th>
                          
                    </tr>


                    @foreach($events as $event)

                        @if(($event->id !== 14) && ($event->id != 28))

                        <tr>
                        <td>{{$event->name_e}}</td>
                        <?php

                        ?>
                        

                        @foreach($event->cards()->where('stars','=','5')->get() as $card)

                        <?php
                            if ($card->color == 'red') {
                                $button_class = 'btn-danger';
                            } else if($card->color == 'blue') {
                                $button_class = 'btn-primary';
                            } else if ($card->color == 'yellow'){
                                $button_class = 'btn-warning';
                          }

                        ?>


                            @if ($event->rank_5 == $card->id)
                            <td class="{{$button_class}}"><a href="/card/{{$card->id}}" class="white-link">{{$card->id}}</a></td>
                            <td>{{$card->boy->first_name}}</td>
                            @endif
                            
                            
                        @endforeach

                        @foreach($event->cards()->where('stars','=','5')->get() as $card)

                        <?php
                            if ($card->color == 'red') {
                                $button_class = 'btn-danger';
                            } else if($card->color == 'blue') {
                                $button_class = 'btn-primary';
                            } else if ($card->color == 'yellow'){
                                $button_class = 'btn-warning';
                          }

                        ?>

                            @if ($event->rank_5 !== $card->id)
                                <td class="{{$button_class}}"><a href="/card/{{$card->id}}" class="white-link">{{$card->id}}</a></td>
                                <td style="background-color:#{{str_pad($card->boy_id,2).'5'}}">{{$card->boy->first_name}}</td>
                            @endif
                            
                            
                        @endforeach


                        </tr>
                        @endif
                    @endforeach

                    </table>
                </div>
            </div> 
 
</div>
@endsection
