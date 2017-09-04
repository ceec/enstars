@extends('layouts.layout')

@section('title')
@parent
Contact Us | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <h1>Cards - {{$user->name}}</h1>
                <h3>5 Stars - {{count($fivestarcards)}} cards</h3>
                <div class="row">
                    <?php $x=1; ?>
                    @foreach($fivestarcards as $card)
                    <?php
                        // print '<pre>';
                        // print_r($card);
                        // print '</pre>';
                        // exit;
                    ?>
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
                <h3>4 Stars - {{count($fourstarcards)}} cards</h3>
                <div class="row">
                    <?php $x=1; ?>
                    @foreach($fourstarcards as $card)
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
