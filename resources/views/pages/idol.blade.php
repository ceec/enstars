@extends('layouts.layout')

@section('title')
@parent
{{$boy->english_name}} | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$boy->first_name}} {{$boy->last_name}}</h1>
                <div id="cards" class="row">
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


        </div>
    </div>
    <h2>Information</h2>
    <div class="row">
        <div class="col-md-6">
        @if ($boy->unit_id > 0)
        <h3>Unit: <a href="/unit/{{$boy->unit->url}}">{{$boy->unit->name}}</a></h3>
        @endif
        @if ($boy->class_id > 0)
        <h3>Class: <a href="/class/{{$boy->classroom->class}}">{{$boy->classroom->class}}</a></h3>
        @endif
        <!--<h3>Club: <a href="">{{$boy->unit_id}}</a></h3>-->

        </div>
        <div class="col-md-6">

        </div>
    </div>
    <h2>Stories</h2>
    <p></p>
     <script src="/js/enstars.js"></script>   
</div>
@endsection
