@extends('layouts.layout')

@section('title')
@parent
5 star History | enstars.info
@stop

@section('content')
<div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h1>5 Star History</h1>
                </div>
                <div class="col-md-4">
                    <h2 class="pull-right">
                        <a href="/graph/five-star-history/basic">Basic</a> | <a href="/graph/five-star-history/music">Music</a> | <a href="/graph/five-star-history/classic">Classic</a>
                    </h2>
                </div>
            </div>
         <div class="row">
            <div class="col-md-4">
            <table class="table">
            @foreach($boys as $boy)
                <tr>
                    <td>{{$boy->first_name}}  {{$boy->last_name}}</td>
                @foreach($boy->cards()->where('stars','=','5')->where('game_id','=',$game)->get() as $card)
                                            <?php
                            if ($card->color == 'red') {
                                $button_class = 'btn-danger';
                            } else if($card->color == 'blue') {
                                $button_class = 'btn-primary';
                            } else if ($card->color == 'yellow'){
                                $button_class = 'btn-warning';
                            }


                        ?>

                    @if(isset($card->event))
                        <td>  
                            <a href="/card/{{$card->id}}"><button class="btn {{$button_class}}">{{$card->eventcard->type}}</button></a>
                            <br>
                            {{$card->event->name_e}}<br>
                            {{date('Y-m-d',strtotime($card->event->start))}}
                        </td>
                    @elseif(isset($card->scout))
                        <td>
                            <a href="/card/{{$card->id}}"><button class="btn {{$button_class}}">Scout</button></a>
                            <br>{{$card->scout->name_e}}
                            <br>
                            {{date('Y-m-d',strtotime($card->scout->start))}}
                        </td>
                    @else
                        <td>
                            <a href="/card/{{$card->id}}"><button class="btn {{$button_class}}">Base Set</button></a>
                            <br>
                            {{date('Y-m-d',strtotime($card->created_at))}}
                        </td>
                    @endif                    
                @endforeach
                </tr>
            @endforeach
            </table>
            </div>
         </div>   
 
</div>
@endsection
