@extends('layouts.layout')

@section('title')
@parent
{{$collaboration->name_e}} | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$collaboration->name_e}} <small>{{date('F j, Y H:i',strtotime($collaboration->start))}} - {{date('F j, Y H:i',strtotime($collaboration->end))}}</small></h1>
            <p>{!! $collaboration->text !!}</p>
            <div class="row">
                <div class="col-md-12">
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
            <p><a href="{{$collaboration->website}}">Scout Website</a></p>
            <div class="row">
                            <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>

                @if (!Auth::guest())
                    @if (Auth::user()->isAdmin())
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Admin - Edit Collaboration {{$collaboration->id}}<span class="pull-right">Last Updated on {{$collaboration->updated_at}} by {{$collaboration->name}} </span></h3>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['url' => '/edit/scout']) !!}    
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="active">Active</label>
                                     {!! Form::select('active',[1=>"Current",0=>"Old"],$collaboration->active,['class'=>'form-control','id'=>'active']) !!}
                                  </div>                                   
                                  <div class="form-group">
                                    <label for="japanese-name">Japanese Name</label>
                                     {!! Form::text('japanese_name',$collaboration->name_j,['class'=>'form-control','id'=>'japanese-name']) !!}
                                  </div> 
                                  <div class="form-group">
                                    <label for="english-name">English Name</label>
                                     {!! Form::text('english_name',$collaboration->name_e,['class'=>'form-control','id'=>'english-name']) !!}
                                  </div>   
                                  <div class="form-group">
                                    <label for="english-name">Description</label>
                                      {!! Form::textarea('text', $collaboration->text,['class'=>'form-control', 'id'=>'text', 'rows' => 3, 'cols' => 100, 'placeholder'=>'Description']) !!}
                                  </div>                                     
                                  <div class="form-group">
                                    <label for="start">Start</label>
                                     {!! Form::text('start',$collaboration->start,['class'=>'form-control','id'=>'start']) !!}
                                  </div> 
                                  <div class="form-group">
                                    <label for="end">End</label>
                                     {!! Form::text('end',$collaboration->end,['class'=>'form-control','id'=>'end']) !!}
                                  </div>                                                                    
                              </div>

                              <div class="col-md-6"></div>
                            </div>

                                                    
                            {!! Form::hidden('collaboration_id', $collaboration->id) !!}                                                      
                            {!! Form::submit('Edit') !!}
                            {!! Form::close() !!}
                        </div>
                      </div>

                    @endif   
                @endif   

     <script src="/js/enstars.js"></script>    
</div>
@endsection
