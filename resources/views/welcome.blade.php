@extends('layouts.layout')

@section('title')
    @parent
    Enstars Info
@stop

@section('content')

    <div class="container">
        <h1>All the Ensemble Stars Cards!</h1>
        <div class="row">
            <div class="col-md-8">
                <h2>Stats</h2>

                <h4>Total Cards: {{$total_cards}}</h4>
                <h4>Entered 5 Star Cards: {{$total_five_star}}</h4>
                <h4>Entered 4 Star Cards: {{$total_four_star}}</h4>
                <h4>Entered 3 Star Cards: {{$total_three_star}}</h4>
                <h4>Entered 2 Star Cards: {{$total_two_star}}</h4>
                <h4>Entered 1 Star Cards: {{$total_one_star}}</h4>

                <h4><strong>Completion: {{$entered_cards}}/{{$total_cards}}  {{$percent}}%</strong></h4>

                <h2>Stories</h2>
                <h4>Event Stories</h4>
                @foreach ($event_stories as $story)
                    <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                @endforeach

                <h4>Scout Stories</h4>
                @foreach ($scout as $story)
                    <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                @endforeach

                <h4>Character Stories</h4>
                @foreach ($character_stories as $story)
                    <a href="/story/{{$story->id}}">{{$story->name_e}}</a><br>
                @endforeach

                <h2>Tags</h2>
                @foreach($tags as $tag)
                    <a href="/tag/{{$tag->tag}}">{{$tag->tag}}</a><br>
                @endforeach

                <h3>Skills</h3>

                <h4>All</h4>
                @foreach($all as $each)
                    <a href="/skill/{{$each->id}}">{{$each->english_description}}</a><br>
                @endforeach

                <h4>Red</h4>
                @foreach($reds as $red)
                    <a href="/skill/{{$red->id}}">{{$red->english_description}}</a><br>
                @endforeach

                <h4>Blue</h4>
                @foreach($blues as $blue)
                    <a href="/skill/{{$blue->id}}">{{$blue->english_description}}</a><br>
                @endforeach

                <h4>Yellow</h4>
                @foreach($yellows as $yellow)
                    <a href="/skill/{{$yellow->id}}">{{$yellow->english_description}}</a><br>
                @endforeach

                <h3>Units</h3>
                @foreach($units as $unit)
                    <a href="/unit/{{$unit->name}}">{{$unit->name}}</a><br>
                @endforeach
            </div>
            <div class="col-md-4">
                @foreach($boys as $boy)
                    <?php



                    //name pretty for url
                    $url = strtolower($boy->first_name);
                    ?>
                    {{$boy->entered}}/{{$boy->total}} <a href="/idol/{{$url}}">{{$boy->english_name}}
                        - {{$boy->japanese_name}}</a>
                    @if($boy->to_be_entered > 0)
                        To be entered: {{$boy->to_be_entered}}
                    @endif

                    <br>

                @endforeach
            </div>

        </div>
    </div>
@endsection
