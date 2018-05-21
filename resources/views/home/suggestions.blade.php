@extends('layouts.app')

@section('content')
<div class="container">
<h1>Suggestions </h1>
	<div class="row">
		<div class="col-md-12">
      <h2>New Suggestions</h2>
      <table class="table">
        <thead>
          <tr>
            <td>ID</td>
            <td>Stars</td>
            <td>Color</td>
            <td>Japanese Name</td>
            <td>English Name</td>
            <td>Japanese Sentence</td>
            <td>English Sentence</td>
            <td>Da</td>
            <td>Vo</td>
            <td>Pf</td>
            <td>Da Max 1</td>
            <td>Vo Max 1</td>
            <td>Pf Max 1</td>
            <td>Da Max 5</td>
            <td>Vo Max 5</td>
            <td>Pf Max 5</td>            
          </tr>
        </thead>
      @foreach($suggestions as $suggestion)
        <tr class="info">
          <td>{{$suggestion->card->id}}</td>
          <td>{{$suggestion->card->stars}}</td>
          <td>{{$suggestion->card->color}}</td>
          <td>{{$suggestion->card->name_j}}</td>
          <td>{{$suggestion->card->name_e}}</td>
          <td>{{$suggestion->card->sentence_j}}</td>
          <td>{{$suggestion->card->sentence_e}}</td>
          <td>{{$suggestion->card->da}}</td>
          <td>{{$suggestion->card->vo}}</td>
          <td>{{$suggestion->card->pf}}</td>
          <td>{{$suggestion->card->da_max}}</td>
          <td>{{$suggestion->card->vo_max}}</td>
          <td>{{$suggestion->card->pf_max}}</td>    
          <td>{{$suggestion->card->da_max5}}</td>
          <td>{{$suggestion->card->vo_max5}}</td>
          <td>{{$suggestion->card->pf_max5}}</td>                
        </tr>       
        <tr class="warning">
          <td>{{$suggestion->acard_id}}</td>
          <td>{{$suggestion->stars}}</td>
          <td>{{$suggestion->color}}</td>
          <td>{{$suggestion->name_j}}</td>
          <td>{{$suggestion->name_e}}</td>
          <td>{{$suggestion->sentence_j}}</td>
          <td>{{$suggestion->sentence_e}}</td>
          <td>{{$suggestion->da}}</td>
          <td>{{$suggestion->vo}}</td>
          <td>{{$suggestion->pf}}</td>
          <td>{{$suggestion->da_max}}</td>
          <td>{{$suggestion->vo_max}}</td>
          <td>{{$suggestion->pf_max}}</td>    
          <td>{{$suggestion->da_max5}}</td>
          <td>{{$suggestion->vo_max5}}</td>
          <td>{{$suggestion->pf_max5}}</td>                
        </tr>   
        <tr>
          <td>
            {!! Form::open(['url' => '/home/suggestion/clear']) !!}
            {!! Form::hidden('suggestion_id',$suggestion->id) !!}                                                                       
            {!! Form::submit('Clear') !!}
            {!! Form::close() !!}
          </td>
        </tr>
        <tr>
          <td><br></td>
        </tr>                             
      @endforeach
      </table>
		</div>
	</div>

</div>
@endsection
