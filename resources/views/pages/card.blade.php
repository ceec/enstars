@extends('layouts.layout')

@section('title')
    @parent
    {{$card->name_e}} | enstars.info
@stop

@section('content')
    <style>
        .card-title {
            font-weight: 400;
        }
    </style>
    <div class="container">
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

        // if ($card->scout_id != 0) {
        //     //its from a scout
        //     $from = 'scout';
        // } else if ($card->event_id !=0) {
        //     //its from an event
        //     $from = 'event';
        // } else {
        //     $from = 'pool';
        // }

        if ($source) {
            //format starting date
            $start_date = date('F j, Y', strtotime($source->start));
        } else {
            $start_date = 'Original Card';
        }


        //image url
        $scout_image = '/images/cards/get/' . $card->boy_id . '_' . $card->card_id . '.png';
        //echo $scout_image;

        // This chunk should all be moved to the controller

        if ($stats->game_id == 3) {
            $imageurl = "/images/cards/music/";
        } else {
            $imageurl = "/images/cards/";
        }
        ?>
        <h1>{{$card->name_e}} <small><a
                        href="/idol/{{ strtolower($boy->first_name)}}">{{$boy->first_name}} {{$boy->last_name}}</a></small>
        </h1>
        @if ($card->game_id > 1)
            <h5><a href="/card/{{$card->id}}/basic">Basic</a> | <a href="/card/{{$card->id}}/music">Music</a></h5>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="panel {{$color_class}}">
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-responsive" src="{{$imageurl.$card->boy_id}}_{{$card->card_id}}.png"
                                 onerror="this.src='/images/missingcard.png'">
                        </div>
                        <div class="col-md-6">
                            <img class="img-responsive" src="{{$imageurl.$card->boy_id}}_{{$card->card_id}}b.png"
                                 onerror="this.src='/images/missingcard.png'">
                        </div>
                    </div>
                    <p>{{$card->sentence_e}}</p>
                </div>
            </div>
            <div class="col-md-6">
                <h4><span class="card-title">Released:</span> {{$start_date}}</h4>
                @if ($card->scout_id != 0)
                    <h4><span class="card-title">Introduced in Scout:</span> <a
                                href="/scout/{{$source->url}}">{{$source->name_e}}</a></h4>
                @elseif ($card->event_id !=0)
                    <h4><span class="card-title">Introduced in Event:</span> <a
                                href="/event/{{$source->url}}">{{$source->name_e}}</a></h4>
                    @if($card->eventcard)
                        {{$card->eventcard->type}} {{$card->stars}} star
                    @endif
                @elseif ($card->collaboration_id !=0)
                    <h4><span class="card-title">Introduced in Collaboration:</span> <a
                                href="/collaboration/{{$source->url}}">{{$source->name_e}}</a></h4>
                @elseif ($card->collection_id !=0)
                    <h4><span class="card-title">Introduced in Unit Collection:</span> <a
                                href="/collection/{{$source->url}}">{{$source->name_e}}</a></h4>
                @else
                    <h4><span class="card-title">Introduced in:</span> Original Card</h4>
                @endif

                <hr>
                @if ($dorifes_skill->id == 0)
                    <h4><span class="card-title">Dream Festival Skill:</span> {{$dorifes_skill->english_description}}
                    </h4>
                @else
                    <h4><span class="card-title">Dream Festival Skill:</span> <a
                                href="/skill/{{$dorifes_skill->id}}">{{$dorifes_skill->english_description}}</a></h4>
                @endif
                <h4>{{$stats->dorifes_e}}</h4>
                @if ($lesson_skill->id == 0)
                    <h4><span class="card-title">Lesson Skill:</span> {{$lesson_skill->english_description}} </h4>
                @else
                    <h4><span class="card-title">Lesson Skill:</span> <a
                                href="/skill/{{$lesson_skill->id}}">{{$lesson_skill->english_description}}</a></h4>
                @endif
                <h4>{{$stats->lesson_e}}</h4>
                <hr>

                <div class="row">
                    <div class="col-md-2">
                        @if ($stats->da !== 0)
                            Base stats<br>
                            Da: {{$stats->da}}<br>
                            Vo: {{$stats->vo}}<br>
                            Pf: {{$stats->pf}}
                        @endif
                    </div>
                    <div class="col-md-3">
                        @if ($stats->da_max !== 0)
                            Max stats 1 Copy<br>
                            Da: {{$stats->da_max}}<br>
                            Vo: {{$stats->vo_max}}<br>
                            Pf: {{$stats->pf_max}}
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if ($stats->da_max5 !== 0)
                            Max stats 5 Copies<br>
                            Da: {{$stats->da_max5}}<br>
                            Vo: {{$stats->vo_max5}}<br>
                            Pf: {{$stats->pf_max5}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <a href="/cardissue/{{$card->id}}">See something wrong with this card? Let us know!</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (file_exists($scout_image))
                    <img class="img-responsive" src="/images/cards/get/{{$card->boy_id}}_{{$card->card_id}}.png">
                @endif

                @if (!Auth::guest())
                    @if ($user_card !='')
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Card Statistics

                                    {!! Form::open(['url' => '/user/edit/dashboardCard','style'=>'display:inline!important']) !!}
                                    {!! Form::hidden('card_id', $card->id) !!}
                                    {!! Form::hidden('usercard_id', $user_card->id) !!}
                                    {!! Form::submit('Set as Dashboard Card',['class'=>'btn btn-primary btn-xs']) !!}
                                    {!! Form::close() !!}
                                    <span class="pull-right">Added:   {{$user_card->created_at}}</span>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {!! Form::open(['url' => '/user/edit/card']) !!}
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="copies">Copies</label>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::number('copies',$user_card->copies,['class'=>'form-control','id'=>'copies','min'=>'1','max'=>'5']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="level">Level</label>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::number('level',$user_card->level,['class'=>'form-control','id'=>'level']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="percent">Percent</label>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::number('percent',$user_card->percent,['class'=>'form-control','id'=>'percent']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="dance">Dance</label>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::number('da',$user_card->da,['class'=>'form-control','id'=>'dance']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="vocal">Vocal</label>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::number('vo',$user_card->vo,['class'=>'form-control','id'=>'vocal']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="performance">Pf</label>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::number('pf',$user_card->pf,['class'=>'form-control','id'=>'performance']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="display">Card Display</label>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::select('bloom', array('0' => 'Unbloomed', '1' => 'Bloomed'), $user_card->bloom,['class'=>'form-control','id'=>'bloom']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="affection">Affection</label>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::number('affection',$user_card->affection,['class'=>'form-control','id'=>'vocal']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::hidden('card_id', $card->id) !!}
                                                {!! Form::hidden('usercard_id', $user_card->id) !!}
                                                {!! Form::submit('Update Statistics',['class'=>'btn btn-primary']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endif
                @endif

                @if (!Auth::guest())
                    @if (Auth::user()->role_id == 2)
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Admin - Edit Card Id:{{$card->id}} Picture: {{$card->boy_id}}
                                    _{{$card->card_id}}.png<span class="pull-right">Last Updated on {{$card->updated_at}} by {{$updated_by->name}} </span>
                                </h3>
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['url' => '/edit/card']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-inline">
                                            <label for="japanese-name">Japanese Name</label>
                                            {!! Form::text('japanese_name',$card->name_j,['class'=>'form-control','id'=>'japanese-name']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="english-name">English Name</label>
                                            {!! Form::text('english_name',$card->name_e,['class'=>'form-control','id'=>'english-name']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="sentence-j">Japanese Sentence (when scouted or on promo
                                                materials)</label>
                                            {!! Form::text('sentence_j',$card->sentence_j,['class'=>'form-control','id'=>'sentence-j']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="sentence-e">English Sentence (when scouted or on promo
                                                materials)</label>
                                            {!! Form::text('sentence_e',$card->sentence_e,['class'=>'form-control','id'=>'sentence-e']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-inline">
                                            <label for="event_id">Event ID</label>
                                            {!! Form::number('event_id',$card->event_id,['class'=>'form-control','id'=>'event_id']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="scout_id">Scout ID</label>
                                            {!! Form::number('scout_id',$card->scout_id,['class'=>'form-control','id'=>'scout_id']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="stars">Stars</label>
                                            {!! Form::text('stars',$card->stars,['class'=>'form-control','id'=>'stars']) !!}
                                        </div>
                                        {!! Form::hidden('card_id', $card->id) !!}
                                        {!! Form::submit('Edit') !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <hr>
                                {!! Form::open(['url' => '/edit/cardstat']) !!}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-inline">
                                            <label for="stars">Type</label>
                                            {!! Form::text('type_id',$stats->type_id,['class'=>'form-control','id'=>'color']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="da">Da</label>
                                            {!! Form::text('da',$stats->da,['class'=>'form-control','id'=>'da']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="vo">Vo</label>
                                            {!! Form::text('vo',$stats->vo,['class'=>'form-control','id'=>'vo']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="pf">Pf</label>
                                            {!! Form::text('pf',$stats->pf,['class'=>'form-control','id'=>'pf']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-inline">
                                            <label for="da_max">Da Max</label>
                                            {!! Form::text('da_max',$stats->da_max,['class'=>'form-control','id'=>'da_max']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="vo_max">Vo Max</label>
                                            {!! Form::text('vo_max',$stats->vo_max,['class'=>'form-control','id'=>'vo_max']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="pf_max">Pf Max</label>
                                            {!! Form::text('pf_max',$stats->pf_max,['class'=>'form-control','id'=>'pf_max']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-inline">
                                            <label for="da_max5">Da Max 5</label>
                                            {!! Form::number('da_max5',$stats->da_max5,['class'=>'form-control','id'=>'da_max5','max'=>'100000000']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="vo_max5">Vo Max 5</label>
                                            {!! Form::number('vo_max5',$stats->vo_max5,['class'=>'form-control','id'=>'vo_max5','max'=>'100000000']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="pf_max5">Pf Max 5</label>
                                            {!! Form::number('pf_max5',$stats->pf_max5,['class'=>'form-control','id'=>'pf_max5','max'=>'100000000']) !!}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h3>Leveled Skills</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-inline">
                                            <label for="dorifes_j">Japanese Dorifes Skill </label>
                                            {!! Form::text('dorifes_j',$stats->dorifes_j,['class'=>'form-control','id'=>'dorifes_j']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="dorifes_e">English Dorifes Skill</label>
                                            {!! Form::text('dorifes_e',$stats->dorifes_e,['class'=>'form-control','id'=>'dorifes_e']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="lesson_j">Japanese Lesson Skill </label>
                                            {!! Form::text('lesson_j',$stats->lesson_j,['class'=>'form-control','id'=>'lesson_j']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="lesson_e">English Lesson Skill</label>
                                            {!! Form::text('lesson_e',$stats->lesson_e,['class'=>'form-control','id'=>'lesson_e']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-inline">
                                            <label for="dorifes-id">Dream Festival Skill</label>
                                            {!! Form::select('dorifes_id', $dorifes_skills,$stats->dorifes_id,['class'=>'form-control', 'id'=>'dorifes-id','placeholder' => 'Dream Festival Skill']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="lesson-skill">Lesson Skill</label>
                                            {!! Form::select('lesson_id', $lesson_skills,$stats->lesson_id ,['class'=>'form-control', 'id'=>'lesson-skill','placeholder' => 'Lesson Skill']) !!}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h3>Uneveled Skills</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-inline">
                                            <label for="u_dorifes_j">Japanese Dorifes Skill </label>
                                            {!! Form::text('u_dorifes_j',$stats->u_dorifes_j,['class'=>'form-control','id'=>'u_dorifes_j']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="u_dorifes_e">English Dorifes Skill</label>
                                            {!! Form::text('u_dorifes_e',$stats->u_dorifes_e,['class'=>'form-control','id'=>'u_dorifes_e']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="u_lesson_j">Japanese Lesson Skill </label>
                                            {!! Form::text('u_lesson_j',$stats->u_lesson_j,['class'=>'form-control','id'=>'u_lesson_j']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="u_lesson_e">English Lesson Skill</label>
                                            {!! Form::text('u_lesson_e',$stats->u_lesson_e,['class'=>'form-control','id'=>'u_lesson_e']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-inline">
                                            <label for="u_dorifes-id">Dream Festival Skill</label>
                                            {!! Form::select('u_dorifes_id', $dorifes_skills,$stats->u_dorifes_id,['class'=>'form-control', 'id'=>'u_dorifes-id','placeholder' => 'Dream Festival Skill']) !!}
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="u_lesson-skill">Lesson Skill</label>
                                            {!! Form::select('u_lesson_id', $lesson_skills,$stats->u_lesson_id ,['class'=>'form-control', 'id'=>'u_lesson-skill','placeholder' => 'Lesson Skill']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::hidden('cardstat_id', $stats->id) !!}
                            {!! Form::submit('Edit') !!}
                            {!! Form::close() !!}
                        </div>
            </div>
            @endif
            @endif
        </div>
    </div>
    </div>
@endsection
