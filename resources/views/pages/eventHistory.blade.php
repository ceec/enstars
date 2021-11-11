@extends('layouts.layout')

@section('title')
    @parent
    Card Release Graph | enstars.info
@stop

@section('content')
    <style>
        #chartdiv {
            width: 100%;
            height: 400px;
        }
    </style>
    <div class="container">
        <h1>Event Border History - Max 5 Stars</h1>
        <div class="row">
            <div class="col-md-12">
                <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
                <script src="https://www.amcharts.com/lib/3/serial.js"></script>
                <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
                <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
                      media="all"/>
                <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
                <script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
                <script src="https://www.amcharts.com/lib/3/plugins/responsive/responsive.min.js"></script>

                {!! Form::open(['method' => 'GET','class'=>'pull-right']) !!}
                {!! Form::select('boy',$boys,$request->boy) !!}
                {!! Form::submit('Filter') !!}
                {!! Form::close() !!}
                <br><br>
                <button class="pull-right"><a href="/graph/event-border-history">Reset</a></button>
                <br>
                <div id="chartdiv"></div>
                <div id="legend-div"></div>
            </div>

        </div>
    </div>
    <script>
        var events = <?php print json_encode($events); ?>;

        console.log(events);

        var graphs = [];

        //make a graph from each event
        for (var i = 0; i < events.length; i++) {
            graphs.push({
                "id": events[i].id,
                "title": events[i].name_e,
                "bullet": "none",
                "valueField": events[i].id + '_2000'
            });
        }

        //console.log(graphs);

        AmCharts.useUTC = true;
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "light",
            "marginRight": 50,
            "usePrefixes": true,
            "dataDateFormat": "YYYY-MM-DD JJ:NN:SS",
            "dataLoader": {
                "url": "/data/event-border-history",
                "format": "json"
            },
            "valueAxes": [{
                "axisAlpha": 0,
                "position": "left",
                // "maximum": "14000000",
                "title": "Points"
            }],
            "graphs": graphs,
            "chartCursor": {
                //"categoryBalloonDateFormat": "YYYY",
                "categoryBalloonEnabled": false,
                "cursorAlpha": 1,
                //"valueLineEnabled":true,
                //"valueLineBalloonEnabled":true,
                "valueLineAlpha": 0.5,
                //"fullWidth":true
            },
            "categoryField": "timestamp",
            "categoryAxis": {
                "parseDates": true,
                "minPeriod": "ss",
                "labelFunction": function (label) {


                    if (label == "Jan 01") {
                        label = 'Day 1';
                    } else if (label == "Jan 02") {
                        label = 'Day 2';
                    } else if (label == "Jan 03") {
                        label = 'Day 3';
                    } else if (label == "Jan 04") {
                        label = 'Day 4';
                    } else if (label == "Jan 05") {
                        label = 'Day 5';
                    } else if (label == "Jan 06") {
                        label = 'Day 6';
                    } else if (label == "Jan 07") {
                        label = 'Day 7';
                    } else if (label == "Jan 08") {
                        label = 'Day 8';
                    } else if (label == "Jan 09") {
                        label = 'Day 9';
                    } else if (label == "Jan 10") {
                        label = 'End';
                    } else {
                        label = '';
                    }

                    return label;
                },
            },
            "legend": {
                "position": "right",
                "labelWidth": 300,
                "valueText": '',
                "divId": "legend-div"
            },
            "export": {
                "enabled": true
            }
        });
    </script>
@endsection
