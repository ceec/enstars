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
                <div class="col-md-12">
                    <div class="row">
                    <?php $x=1; ?>
                    @foreach($cards as $card)
                        {{ $card->display() }}          
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
                <div class="row">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                            <h3>Mini Events</h3>
                            @foreach ($minievents as $event)
                                @if ($event->complete == 1)
                                     <a href="/minievent/{{$event->id}}">{{$event->name_e}}</a><br>
                                @else
                                    {{$event->name_e}}<br>
                                @endif
                                   
                            @endforeach
                    </div>                    

                <div class="row">
                    <div class="col-md-8">
                        @if (isset($points->participants) && ($event->active === 0))
                        <h2>Final Ranking - Total Participants {{$points->participants}}</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Points Needed</th>
                                    <th>Reward<th>
                                </tr>
                            </thead>
                            @for ($i = 1; $i < 20; $i++)
                            <?php
                                $rank = "rank_".$i;
                                $next_rank = "rank_".($i + 1);
                                $tier = "tier_".$i;
                            ?>
                            <tr>
                                <td>
                                    {{$points->$rank}} -
                                    @if ($i < 19)
                                        {{$points->$next_rank - 1}}
                                    @else
                                        {{$points->rank_max}}
                                    @endif
                                </td>
                                <td>
                                    {{$points->$tier}}
                                </td>
                                <td>
                                    @if ($rewards[$i-1]['5_star'] > 0) 
                                        @foreach($cards as $card)
                                            @if ($card->id == $event->rank_5)
                                            {{ $card->display('mini','x'.$rewards[$i-1]['5_star']) }} 
                                            @endif      
                                        @endforeach
                                    @endif 
                                    @if ($rewards[$i-1]['4_star'] > 0) 
                                        @foreach($cards as $card)
                                            @if ($card->id == $event->rank_4)
                                            {{ $card->display('mini','x'.$rewards[$i-1]['4_star']) }} 
                                            @endif      
                                        @endforeach                                
                                    @endif
                                    @if ($rewards[$i-1]['3_star'] > 0) 
                                        @foreach($cards as $card)
                                            @if ($card->id == $event->rank_3)
                                            {{ $card->display('mini','x'.$rewards[$i-1]['3_star']) }} 
                                            @endif      
                                        @endforeach                                
                                    @endif       
                                    @if ($rewards[$i-1]['points'] > 0) 
                                         {{$rewards[$i-1]['points']}} Points
                                    @endif                                                           
                                </td>
                            </tr>
                            @endfor
                        </table>
                         @endif     
                    </div>
                </div>    
                      
                <!--<div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                {{$event->rank_5}}
                            </td>
                            <td>
                                {{$event->points_5}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{$event->rank_4}}
                            </td>
                            <td>
                                {{$event->points_4}}
                            </td>                        
                        </tr>
                        <tr>
                            <td>
                                {{$event->rank_3}}
                            </td>
                            <td>
                                {{$event->points_3_da}} {{$event->points_3_vo}} {{$event->points_3_pf}} 
                            </td>                        
                        </tr>
                    </table>
                </div>-->
            </div>
        </div>

    </div>
     <script src="/js/enstars.js"></script>        
</div>
@endsection
