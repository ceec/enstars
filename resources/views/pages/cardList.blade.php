@extends('layouts.layout')

@section('title')
@parent
Contact Us | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        <table class="table">
          <tr>
            <th>Id</th>
            <th>Boy</th>
            <th>Type</th>
            <th>Stars</th>
            <th>Base Da</th>
            <th>Base Vo</th>
            <th>Base Pf</th>
            <th>Name J</th>
            <th>Name E</th>
          </tr>
        @foreach($cards as $card)
          <tr>
            <td>{{$card->id}}</td>
            <td>{{$card->boy_id}}
            <td>{{$card->color}}</td>
            <td>{{$card->stars}}</td>
            <td>{{$card->da}}</td>
            <td>{{$card->vo}}</td>
            <td>{{$card->pf}}</td>
            <td><a href="/card/{{$card->id}}">{{$card->name_j}}</a></td>
            <td><a href="/card/{{$card->id}}">{{$card->name_e}}</a></td>
          </tr>
        @endforeach
        </table>



        </div>

    </div>
</div>
@endsection
