@extends('layouts.layout')

@section('title')
@parent
Timeline | enstars.info
@stop

@section('content')
<div class="container">
    <h1>Timeline</h1>
    <div class="row">
        <div class="col-md-12">
        <style>
        #chartdiv {
  width: 100%;
  height: 500px;
}
        </style>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/gantt.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
<div id="chartdiv"></div>
<script>
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "gantt",
  "theme": "light",
  "marginRight": 70,
  "period": "DD",
  "dataDateFormat": "YYYY-MM-DD",
  "columnWidth": 0.5,
  "valueAxis": {
    "type": "date"
  },
  "brightnessStep": 0,
  "graph": {
    "fillAlphas": 1,
    "lineAlpha": 1,
    "lineColor": "#fff",
    "fillAlphas": 0.85,
    "balloonText": "<b>[[task]]</b>:<br />[[open]] -- [[value]]"
  },
  "rotate": true,
  "categoryField": "category",
  "segmentsField": "segments",
  "colorField": "color",
  "startDateField": "start",
  "endDateField": "end",
    "dataLoader": {
    "url": "/data/timeline",
    "format": "json"
  },  
  // "dataProvider": [ {
  //   "category": "Scouts",
  //   "segments": [ {
  //     "start": "2016-01-01",
  //     "end": "2016-01-14",
  //     "color": "#b9783f",
  //     "task": "Gathering requirements"
  //   }, {
  //     "start": "2016-01-16",
  //     "end": "2016-01-27",
  //     "task": "Producing specifications"
  //   }, {
  //     "start": "2016-02-05",
  //     "end": "2016-04-18",
  //     "task": "Development"
  //   }, {
  //     "start": "2016-04-18",
  //     "end": "2016-04-30",
  //     "task": "Testing and QA"
  //   } ]
  // }, {
  //   "category": "Main Story",
  //   "segments": [ {
  //     "start": "2016-01-02",
  //     "end": "2016-01-08",
  //     "color": "#cd82ad",
  //     "task": "Gathering requirements"
  //   }, {
  //     "start": "2016-01-08",
  //     "end": "2016-01-16",
  //     "task": "Producing specifications"
  //   }, {
  //     "start": "2016-01-19",
  //     "end": "2016-03-01",
  //     "task": "Development"
  //   }, {
  //     "start": "2016-03-12",
  //     "end": "2016-04-05",
  //     "task": "Testing and QA"
  //   } ]
  // }, {
  //   "category": "Events",
  //   "segments": [ {
  //     "start": "2016-01-01",
  //     "end": "2016-01-19",
  //     "color": "#2f4074",
  //     "task": "Gathering requirements"
  //   }, {
  //     "start": "2016-01-19",
  //     "end": "2016-02-03",
  //     "task": "Producing specifications"
  //   }, {
  //     "start": "2016-03-20",
  //     "end": "2016-04-25",
  //     "task": "Development"
  //   }, {
  //     "start": "2016-04-27",
  //     "end": "2016-05-15",
  //     "task": "Testing and QA"
  //   } ]
  // }],
  "valueScrollbar": {
    "autoGridCount": true
  },
  "export": {
    "enabled": true
  }
} );
</script>
        </div>
    </div>    
</div>
@endsection
