@extends('layouts.layout')

@section('title')
    @parent
    Card Release Graph | enstars.info
@stop

@section('content')
    <style>
        #chartdiv {
            width: 100%;
            height: 1000px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
                <script src="https://www.amcharts.com/lib/3/serial.js"></script>
                <script src="https://www.amcharts.com/lib/3/gantt.js"></script>
                <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
                <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
                      media="all"/>
                <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
                <script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
                <div id="chartdiv"></div>
            </div>

        </div>
    </div>
    <script>
        AmCharts.useUTC = true;
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "gantt",
            "theme": "light",
            "creditsPosition": "bottom-right",
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
                "balloonText": "<b>[[task]]</b>:<br />[[open]] - [[value]]",
                "labelText": "[[stars]]",
                "labelPosition": "left"
            },
            "rotate": true,
            "categoryField": "category",
            "segmentsField": "segments",
            "colorField": "color",
            "startDateField": "start",
            "endDateField": "end",
            "dataLoader": {
                "url": "/data/cards-released",
                "format": "json"
            },
            "valueScrollbar": {
                "autoGridCount": true
            },
            "chartCursor": {
                "cursorColor": "#55bb76",
                "valueBalloonsEnabled": false,
                "cursorAlpha": 0,
                "valueLineAlpha": 0.5,
                "valueLineBalloonEnabled": true,
                "valueLineEnabled": true,
                "zoomable": false,
                "valueZoomable": true
            }
        });
    </script>
@endsection
