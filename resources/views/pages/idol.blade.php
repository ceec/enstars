@extends('layouts.layout')

@section('title')
@parent
{{$boy->english_name}} | enstars.info
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>{{$boy->first_name}} {{$boy->last_name}}</h1>
                <div id="cards" class="row">
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
    <h2>Information</h2>
    <div class="row">
        <div class="col-md-6">
        @if ($boy->unit_id > 0)
        <h3>Unit: <a href="/unit/{{$boy->unit->url}}">{{$boy->unit->name}}</a></h3>
        @endif
        @if ($boy->class_id > 0)
        <h3>Class: <a href="/class/{{$boy->classroom->class}}">{{$boy->classroom->class}}</a></h3>
        @endif
        <!--<h3>Club: <a href="">{{$boy->unit_id}}</a></h3>-->

        </div>
        <div class="col-md-6">

        </div>
    </div>
    <h2>Stories</h2>
    <h2>Card Frequency</h2>
    
    <style>
        #chartdiv {
            width: 50%;
            height: 400px;
        }

        </style>
            <div id="chartdiv"></div>
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/kelly.js"></script>
    <script>
        /* Set themes */
        //am4core.useTheme(am4themes_animated);
        // am4core.useTheme(am4themes_kelly);

        // /* Create chart instance */
        // var chart = am4core.create("chartdiv", am4charts.RadarChart);
        // chart.dataSource.url = "/data/frequency/"+1;

        // /* Create axes */
        // var xAxis = chart.xAxes.push(new am4charts.ValueAxis());
        // xAxis.renderer.maxLabelPosition = 0.99;

        // var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
        // yAxis.renderer.labels.template.verticalCenter = "bottom";
        // yAxis.renderer.labels.template.horizontalCenter = "right";
        // yAxis.renderer.maxLabelPosition = 0.99;


        // var series2 = chart.series.push(new am4charts.RadarSeries());
        // series2.bullets.push(new am4charts.CircleBullet());
        // series2.strokeOpacity = 0;
        // series2.dataFields.valueX = "x";
        // series2.dataFields.valueY = "y";
        // series2.name = "2017";
        // series2.tooltipText = "[[title]]";
        // series2.sequencedInterpolation = true;
        // series2.sequencedInterpolationDelay = 10;
        // series2.data = [
        // {"x":0},
        // {"x": 2, "y": 3,"title":" Blue Sky Dream Travel" },
        // {"x": 5, "y": 5,"title":"Salon de The" },
        // {"x": 7, "y": 3,"title":"Melty Sweet Chocolate Fest" },
        // {"x": 24, "y": 3 ,"title":"Scout: Biblio"},
        // {"x": 33, "y": 3 },
        // {"x": 37, "y": 4 },
        // {"x": 43, "y": 3 },
        // {"x": 44, "y": 5 },
        // {"x": 48, "y": 3 },
        // {"x":51,"y":3},
        // {"x": 52}
        // ];

        // /* Create and configure series */
        // var series1 = chart.series.push(new am4charts.RadarSeries());
        // series1.bullets.push(new am4charts.CircleBullet());
        // series1.strokeOpacity = 0;
        // series1.dataFields.valueX = "x";
        // series1.dataFields.valueY = "y";
        // series1.name = "2018";
        // series1.sequencedInterpolation = true;
        // series1.sequencedInterpolationDelay = 10;
        // series1.data = [
        // {"x":0},
        // { "x": 9, "y": 3 },
        // { "x": 13, "y": 4 },
        // { "x": 26, "y": 5 },
        // {"x": 52}
        // ];

        // /* Add legend */
        // chart.legend = new am4charts.Legend();
    </script>
    <p></p>
     <script src="/js/enstars.js"></script>   
</div>
@endsection
