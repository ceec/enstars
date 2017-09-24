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
            <div class="row">
                            <div class="col-md-4">
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
            </div>
        </div>
    </div>

                @if (!Auth::guest())
                    @if (Auth::user()->isAdmin())
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Admin - Edit Scout <span class="pull-right">Last Updated on {{$scout->updated_at}} by {{$scout->name}} </span></h3>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['url' => '/edit/scout']) !!}    
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="japanese-name">Japanese Name</label>
                                     {!! Form::text('japanese_name',$scout->name_j,['class'=>'form-control','id'=>'japanese-name']) !!}
                                  </div> 
                                  <div class="form-group">
                                    <label for="english-name">English Name</label>
                                     {!! Form::text('english_name',$scout->name_e,['class'=>'form-control','id'=>'english-name']) !!}
                                  </div>   
                                  <div class="form-group">
                                    <label for="start">Start</label>
                                     {!! Form::text('start',$scout->start,['class'=>'form-control','id'=>'start']) !!}
                                  </div> 
                                  <div class="form-group">
                                    <label for="end">End</label>
                                     {!! Form::text('end',$scout->end,['class'=>'form-control','id'=>'end']) !!}
                                  </div>                                                                    
                              </div>

                              <div class="col-md-6"></div>
                            </div>
                                                    
                            {!! Form::hidden('scout_id', $scout->id) !!}                                                      
                            {!! Form::submit('Edit') !!}
                            {!! Form::close() !!}
                        </div>
                      </div>

                    @endif   
                @endif   

     <script src="/js/enstars.js"></script>    
</div>
@endsection
