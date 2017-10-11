@extends('layouts.layout')

@section('title')
@parent
All Events | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        	<h1>All Events</h1>

            @foreach($events as $event)
<?php
                //friendly dates
                $start_date = date('F d, Y',strtotime($event->start));
                $end_date = date('F d, Y',strtotime($event->end));    
?>            
            <div class="row">
                <div class="col-md-3">
                    <a href="/event/{{$event->url}}"><img class="img-responsive" src="/images/events/{{$event->id}}.png"></a>
                </div>
                <div class="col-md-6">
                     <a href="/event/{{$event->url}}"><h3>{{$event->name_e}}</h3><br>{{$start_date}} to {{$end_date}}</a>
                </div>
                <div class="col-md-3">
<?php
                $user = Auth::user();
?>
                @if (isset($user))
                    @if(isset($event->user_event))
                        Rank: <input type="number" id="rank-event-{{$event->id}}" value="{{$event->user_event->rank}}"><br>
                        Points: <input type="number" id="points-event-{{$event->id}}" value="{{$event->user_event->points}}">
                        <button class="btn btn-primary update-event" data-id="{{$event->id}}">Update</button>
                    @else
                    <div class="user-event">
                        <button class="btn btn-success add-event" data-id="{{$event->id}}">Add Event</button>
                    </div>
                    @endif
                @endif
    
                </div>
            </div>
            <hr>
            @endforeach


    </div>
</div>
<script>
    //updating the event
    $('body').on('click','.update-event',function() {
        var eventID = $(this).data('id');
        var rank = $('#rank-event-'+eventID).val();
        var points = $('#points-event-'+eventID).val();

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //e.preventDefault(); 
        $.ajax({

            type: "POST",
            url: '/update/user/event',
            data: {event_id:eventID,rank:rank,points:points},
            dataType: 'json',
            success: function (data) {
                window.location.reload();
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });
    });

    //adding data
    $('body').on('click','.add-event',function() {
        var eventID = $(this).data('id');

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            type: "POST",
            url: '/add/user/event',
            data: {event_id:eventID},
            dataType: 'json',
            success: function (data) {
                window.location.reload();
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });
    });    
    </script>

@endsection
