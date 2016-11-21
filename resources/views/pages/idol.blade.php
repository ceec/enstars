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
                                <script>
                                jQuery('body').on('click','.bloom',function() {
                                    var ID = jQuery(this).data('id');
                                    var cardID = jQuery(this).data('card-id');
                                    var boyID = jQuery(this).data('boy');
                                    jQuery('#card-'+ID).html('<img class="img-responsive" src="/images/cards/'+boyID+'_'+cardID+'b.png">');
                                    jQuery('#bloom-'+ID).removeClass('bloom').addClass('unbloom');
                                    jQuery('#bloom-'+ID).removeClass('glyphicon-certificate').addClass('glyphicon-record');                                    
                                });

                                jQuery('body').on('click','.unbloom',function() {
                                    var ID = jQuery(this).data('id');
                                    var cardID = jQuery(this).data('card-id');
                                    var boyID = jQuery(this).data('boy');   
                                    jQuery('#card-'+ID).html('<img class="img-responsive" src="/images/cards/'+boyID+'_'+cardID+'.png">');
                                    jQuery('#bloom-'+ID).removeClass('unbloom').addClass('bloom');
                                     jQuery('#bloom-'+ID).removeClass('glyphicon-record').addClass('glyphicon-certificate');
                                }); 

                             
                                </script>       
</div>
@endsection
