@extends('layouts.layout')

@section('title')
@parent
Contact Us | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        <table id="card-table" class="table tablesorter">
          <thead>
          <tr>
            <th>Id</th>
            <th>Boy</th>
            <th>Type</th>
            <th>Stars</th>
            <th>Base Da</th>
            <th>Base Vo</th>
            <th>Base Pf</th>
            <th>Max Da</th>
            <th>Max Vo</th>
            <th>Max Pf</th>            
            <th>Name J</th>
            <th>Name E</th>
            <th>Road</th>
          </tr>
          </thead>
        @foreach($cards as $card)
          <tr>
            <td>{{$card->id}}</td>
            <td>{{$card->boy_id}}
            <td>{{$card->color}}</td>
            <td>{{$card->stars}}</td>
            <td>{{$card->da}}</td>
            <td>{{$card->vo}}</td>
            <td>{{$card->pf}}</td>
            <td>{{$card->da_max}}</td>
            <td>{{$card->vo_max}}</td>
            <td>{{$card->pf_max}}</td>            
            <td><a href="/card/{{$card->id}}">{{$card->name_j}}</a></td>
            <td><a href="/card/{{$card->id}}">{{$card->name_e}}</a></td>
            <td><?php if(count($card->idolRoad->pluck(1)) > 0) { print 'yes';} ?></td>
          </tr>
        @endforeach
        </table>



        </div>

    </div>
</div>
<script type="text/javascript" src="/js/jquery.tablesorter.js"></script>
<script>
$(function(){
  $("#card-table").tablesorter();
});
</script>
@endsection
