@extends('layouts.layout')

@section('title')
@parent
Dashboard | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<h1>{{Auth::user()->name}} Cards</h1>
                <div class="row">
                    <?php $x=1; ?>
                    <?php 


                    //{{ $card->display('mini') }}    

                    ?>
                    @foreach($cards as $card)
                        {{ $card->display('mini') }}    
                        <?php
                            if ($x%6==0) {
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
</div>
@endsection
