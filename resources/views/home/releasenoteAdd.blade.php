@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Add New Release Note</h1>
    
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

			{!! Form::open(['url' => '/add/releasenote']) !!}
    <div class="row">
    	<div class="col-md-6">
            <div class="form-group">
              <label for="version">Version</label>
               {!! Form::text('version','',['class'=>'form-control','id'=>'version']) !!}
            </div>                  
			      <div class="form-group">
              <label for="release_date">Release Date</label>
               {!! Form::date('release_date','',['class'=>'form-control','id'=>'release_date']) !!}
            </div>   
			      <div class="form-group">
              <label for="notes">Notes</label>
               {!! Form::textarea('notes','',['class'=>'form-control','id'=>'notes']) !!}
            </div>    
            {!! Form::submit('Add') !!}
            {!! Form::close() !!}                                     
      </div>                                                                   

			
    	</div>
   	</div>

</div>


@endsection
