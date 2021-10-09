@extends('layouts.layout')

@section('title')
    @parent
    {{$event->name_e}} | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$event->name_e}} <small>{{date('F j, Y H:i',strtotime($event->start))}}
                        - {{date('F j, Y H:i',strtotime($event->end))}}</small></h1>
                <p>{!! $event->text !!}</p>
                <div class="row">
                    <div class="col-md-12">
                        <div style="display: flex; flex-wrap: wrap;">
                            @foreach($cards as $card)
                                {{ $card->display() }}
                            @endforeach
                        </div>
                        <p><a href="{{$event->website}}">Event Website</a></p>
                        <div class="row">
                            @if ($event->game_id==1)
                                <div class="col-md-6">
                                    <h3>Graph</h3>
                                    <style>
                                        #chartdiv {
                                            width: 100%;
                                            height: 300px;
                                        }
                                    </style>
                                    <div id="chartdiv"></div>
                                    <?php
                                    //convert from JST to UTC
                                    $utc_end = date('Y-m-d H:i:s', strtotime($event->end) - 60 * 60 * 9);
                                    ?>
                                    <script>
                                        var eventEnd = "<?php print $utc_end;?> UTC";
                                        var eventID = "<?php print $event->id; ?>";
                                    </script>
                                    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
                                    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
                                    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
                                    <script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
                                    <script src="/js/eventChart.js"></script>
                                </div>
                            @endif
                            <div class="col-md-3" id="story">
                                @if ($chapters != '')
                                    <h3>Event Story</h3>
                                    @foreach ($chapters as $chapter)
                                        @if ($chapter->complete == 1)
                                            <a href="/story/{{$story->id}}/{{$chapter->chapter}}">{{$chapter->name_e}}</a>
                                            <br>
                                        @else
                                            {{$chapter->name_e}}<br>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if ($minievents != "[]")
                                    <h3>Mini Talk</h3>
                                    @foreach ($minievents as $event)
                                        @if ($event->complete == 1)
                                            <a href="/minievent/{{$event->id}}">{{$event->name_e}}</a><br>
                                        @else
                                            {{$event->name_e}}<br>
                                        @endif
                                    @endforeach
                                @endif
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
                                                <th>Reward
                                                <th>
                                            </tr>
                                            </thead>
                                            @for ($i = 1; $i < 12; $i++)
                                                <?php
                                                $rank = "rank_" . $i;
                                                $next_rank = "rank_" . ($i + 1);
                                                $tier = "tier_" . $i;
                                                ?>
                                                <tr>
                                                    <td>
                                                        {{$points->$rank}}
                                                    </td>
                                                    <td>
                                                        {{$points->$tier}}
                                                    </td>
                                                    <td>
                                                        @if ($rewards[$i-1]['5_star'] > 0)
                                                            @foreach($cards as $card)
                                                                @if ($card->id == $event->rank_5)
                                                                    <a href="/card/{{ $card->id }}">
                                                                        <img style="width:128px;height:auto;"
                                                                             src="/images/cards/{{ $card->boy_id }}_{{ $card->card_id }}.png">
                                                                    </a>
                                                                    {{ 'x'.$rewards[$i-1]['5_star'] }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if ($rewards[$i-1]['4_star'] > 0)
                                                            @foreach($cards as $card)
                                                                @if ($card->id == $event->rank_4)
                                                                    <a href="/card/{{ $card->id }}">
                                                                        <img style="width:128px;height:auto;"
                                                                             src="/images/cards/{{ $card->boy_id }}_{{ $card->card_id }}.png">
                                                                    </a>
                                                                    {{ 'x'.$rewards[$i-1]['4_star'] }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if ($rewards[$i-1]['3_star'] > 0)
                                                            @foreach($cards as $card)
                                                                @if ($card->id == $event->rank_3)
                                                                    <a href="/card/{{ $card->id }}">
                                                                        <img style="width:128px;height:auto;"
                                                                             src="/images/cards/{{ $card->boy_id }}_{{ $card->card_id }}.png">
                                                                    </a>
                                                                    {{ 'x'.$rewards[$i-1]['3_star'] }}
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
                        </div>
                    </div>
                </div>


                @if (!Auth::guest())
                    @if (Auth::user()->isAdmin())
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Admin - Edit Event {{$event->id}}<span class="pull-right">Last Updated on {{$event->updated_at}} by {{$event->name}} </span>
                                </h3>
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['url' => '/edit/event']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="active">Active</label>
                                            {!! Form::select('active',[1=>"Current",0=>"Old"],$event->active,['class'=>'form-control','id'=>'active']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="japanese-name">Japanese Name</label>
                                            {!! Form::text('japanese_name',$event->name_j,['class'=>'form-control','id'=>'japanese-name']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="english-name">English Name</label>
                                            {!! Form::text('english_name',$event->name_e,['class'=>'form-control','id'=>'english-name']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="english-name">Description</label>
                                            {!! Form::textarea('text', $event->text,['class'=>'form-control', 'id'=>'text', 'rows' => 3, 'cols' => 100, 'placeholder'=>'Description']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="start">Start</label>
                                            {!! Form::text('start',$event->start,['class'=>'form-control','id'=>'start']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="end">End</label>
                                            {!! Form::text('end',$event->end,['class'=>'form-control','id'=>'end']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="rank_5">Rank 5 Star Card</label>
                                            {!! Form::text('rank_5',$event->rank_5,['class'=>'form-control','id'=>'rank_5']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="rank_4">Rank 4 Star Card</label>
                                            {!! Form::text('rank_4',$event->rank_4,['class'=>'form-control','id'=>'rank_4']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="rank_3">Rank 3 Star Card</label>
                                            {!! Form::text('rank_3',$event->rank_3,['class'=>'form-control','id'=>'rank_3']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="points_5">Points 5 Star Card</label>
                                            {!! Form::text('points_5',$event->points_5,['class'=>'form-control','id'=>'points_5']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="points_4">Points 4 Star Card</label>
                                            {!! Form::text('points_4',$event->points_4,['class'=>'form-control','id'=>'points_4']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="points_3_da">Points 3 Star Card - Dance</label>
                                            {!! Form::text('points_3_da',$event->points_3_da,['class'=>'form-control','id'=>'points_3_da']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="points_3_vo">Points 3 Star Card - Vocal</label>
                                            {!! Form::text('points_3_vo',$event->points_3_vo,['class'=>'form-control','id'=>'points_3_vo']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="points_3_pf">Points 3 Star Card - Performance</label>
                                            {!! Form::text('points_3_pf',$event->points_3_pf,['class'=>'form-control','id'=>'points_3_pf']) !!}
                                        </div>
                                        {!! Form::hidden('event_id', $event->id) !!}
                                        {!! Form::submit('Edit') !!}
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::open(['url' => '/edit/event/card']) !!}
                                        <div class="form-group">
                                            <label for="card_id">Card</label>
                                            {!! Form::text('card_id','',['class'=>'form-control','id'=>'card_id']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            {!! Form::text('type','',['class'=>'form-control','id'=>'type']) !!}
                                        </div>
                                        {!! Form::hidden('event_id', $event->id) !!}
                                        {!! Form::submit('Edit') !!}
                                        {!! Form::close() !!}
                                        <br>
                                        <h3>Cards</h3>
                                        @foreach($eventcards as $card)
                                            {{$card->card_id}} {{$card->type}}<br>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endif
                @endif


                <script src="/js/enstars.js"></script>
            </div>
@endsection
