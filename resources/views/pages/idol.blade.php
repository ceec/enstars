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


        </div>

    </div>
     <script src="/js/enstars.js"></script>   
</div>
@endsection
