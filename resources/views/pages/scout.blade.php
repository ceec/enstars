@extends('layouts.layout')

@section('title')
@parent
{{$scout->name_e}} | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$scout->name_e}} <small>{{$scout->start}} - {{$scout->end}}</small></h1>
            <p>{!! $scout->text !!}</p>
            <div class="row">
                <div class="col-md-2">
                    @if ($scout->type_id == 1)
                        @if ($chapters != '')
                            <h3>Scout Story</h3>
                            @foreach ($chapters as $chapter)
                                @if ($chapter->complete == 1)
                                    <a href="/story/{{$story->id}}/{{$chapter->chapter}}">{{$chapter->name_e}}</a><br>
                                @else
                                    {{$chapter->name_e}}<br>
                                @endif
                            @endforeach
                        @endif
                    @else


                    @endif
                </div>
                <div class="col-md-10">
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
