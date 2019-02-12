@extends('layouts.layout')

@section('title')
@parent
Management | enstars.info
@stop

@section('content')

<div class="container">
    <h1>Management</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="col-md-12">
          <span class="badge badge-primary"><h4>マネージメント内容 | Management Contents</h4></span>
        </div>
        <div class="col-md-12">
          <div class="col-md-2"></div>
          <div class="col-md-10">
            <span class="badge badge-primay">活動する生徒 | Active Student</span><span class="label label-warning">変更する | Change</span><br>
            [Card Name]<br>
            Student Name<br>
            Card Level | Affection
          </div>
          <hr>
        </div>   
        <div class="col-md-12">
          <span class="badge">活動内容 | Activity</span><br>
          Activity Name x How long<br>
          アイテムがゼットされていません | No Item Set
          <span class="label label-info">マネージメントアイテム | Management Item</span>
        </div>        
      </div>
      <div class="col-md-6">
        <div class="well">
            <span class="label label-warning">30分 | 30 Minutes</span> 振り付け確認 | Checking Choreography <span class="label label-default">10 AP</span> <span class="label label-primary">実施回数: Times</span> 3
        </div>
        <div class="well">
            <span class="label label-warning">30分 | 30 Minutes</span> 準備運動 | Warm Up <span class="label label-default">10 AP</span> <span class="label label-primary">実施回数: Times</span> 3
        </div>        
      </div>
    </div>
</div> <!-- end container -->
@endsection
