@extends('layouts.layout')

@section('title')
@parent
5 star History | enstars.info
@stop

@section('content')
<div class="container">

        	<h1>5 Star History</h1>
         <div class="row">
            <div class="col-md-12">
            <table class="table">
            @foreach($boys as $boy)
                <tr>
                    <td>{{$boy->first_name}}  {{$boy->last_name}}</td>
                @foreach($boy->cards()->where('stars','=','5')->get() as $card)
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
                    @endif                    
                @endforeach
                </tr>
            @endforeach
            </table>
            </div>
         </div>   
 
</div>
@endsection
