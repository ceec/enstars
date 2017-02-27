@extends('layouts.layout')

@section('title')
@parent
Event Calculator | enstars.info
@stop

@section('content')
<script>
var eventEnd = "<?php print $event->end;?>";
</script>
<style>
#chartdiv {
	width	: 100%;
	height	: 300px;
}										
</style>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
<div class="container">
	<div class="alert alert-warning	">
		<h3>This calculator is in beta!</h3>
		<p>Things may change as I add in new features and I may accidentally break things! If you have any feedback or suggestions 
		I would appreicate it if you sent them to me through our contact form at the bottom of the page!</p>
		<p>The data is currently stored in local storage so it will save if you use the same browser to access it, but not accross browsers or devices.</p>
	</div>
  <div class="row">

      <div class="col-lg-2">
      <a href="/event/{{$event->url}}"><img class="img-responsive" src="/images/events/{{$event->id}}.png"></a>
      </div>    
    	<div class="col-lg-10">
      <h2>Current Event: {{$event->name_e}}</h2> 
      </div>


  </div>
  	<div class="row">
  	<div class="col-lg-8">
      <h3>Time Remaining: <span id="time-remaining"></span></h3>
      </div>
      <div class="col-lg-4">
      
      </div>
    </div>

  <div class="row">
    <div class="col-lg-6">
      Current points: <input type="number" id="current-points">
      <div class="row">
        <div class="col-lg-4">
          Red<br>
          <input class="form-control" type="number" placeholder="" id="red1">
          <input class="form-control" type="number" id="red2">
          <input class="form-control" type="number" id="red3">

          <div id="red-result">
          </div>
        </div>
        <div class="col-lg-4">
          Blue<br>
          <input class="form-control" type="number" placeholder="" id="blue1">
          <input class="form-control" type="number" id="blue2">
          <input class="form-control" type="number" id="blue3">
          <div id="blue-result">
          </div>
        </div>
        <div class="col-lg-4">
          Yellow<br>
          <input class="form-control" type="number" id="yellow1">
          <input class="form-control" type="number" id="yellow2">
          <input class="form-control" type="number" id="yellow3">
          <div id="yellow-result">
          </div>
        </div>
      </div>
      <br>
      <input class="btn btn-success" type="submit" value="Calculate" id="calculate">
    </div>
    <div class="col-lg-6">
    	<div class="row">
      	<div class="col-lg-2">
        	<span class="btn btn-danger"><img class="img-responsive" src="/images/cards/2_27b.png">Normal<br>500000&nbsp;</span>
        </div>
        <div class="col-lg-2">
        	<span class="btn btn-info"><img class="img-responsive" src="/images/cards/17_26b.png">Normal<br>500000&nbsp;</span>
        </div>
        <div class="col-lg-2">
        	<span class="btn btn-warning"><img class="img-responsive" src="/images/cards/20_26b.png">Halfway<br>750000&#8203;</span>
        </div>
        <div class="col-lg-2">
        	<span class="btn btn-warning"><img class="img-responsive" src="/images/cards/3_22b.png">Urgent<br>1000000</span>
       	</div>
       	</div>
      <h3>Max Natural LP remaining: <span id="lp-remaining"></span></h3>
<h3>1 LP: <span id="base-natural-points"></span> Points: <span id="base-total-points"></span></h3>
<h3>2 LP: <span id="base-natural-points2"></span> Points: <span id="base-total-points2"></span></h3>    
<h3>3 LP: <span id="base-natural-points3"></span> Points: <span id="base-total-points3"></span></h3>          
    </div>
    </div> <!-- end row -->
    <div class="row">
    <div class="col-lg-6">
      <div id="chartdiv"></div>
    </div>
    </div>
  </div>
</div>
 <script>
 var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "dataDateFormat": "YYYY-MM-DD HH:NN",
    "dataLoader": {
    "url": "/data/event-border",
    "format": "json"
  },
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left"
    }],
    "graphs": [{
        "id":"1 5 Star - 1200",
        "title": "1200",
        "bullet": "round",
        "balloonText": "[[value]]",
        "valueField": "points2"
    },{
        "id":"40",
        "title": "11000",
        "bullet": "round",
        "balloonText": "[[value]]",
        "valueField": "points7"
    },{
        "id":"41",
        "title": "35000",  
        "bullet": "round",
        "balloonText": "[[value]]",
        "valueField": "points12"
    }],
    "chartCursor": {
        //"categoryBalloonDateFormat": "YYYY",
        "categoryBalloonEnabled": false,
        "cursorAlpha": 1,
        //"valueLineEnabled":true,
        //"valueLineBalloonEnabled":true,
        "valueLineAlpha":0.5,
        //"fullWidth":true
    },
    "categoryField": "position",
    "categoryAxis": {
    	"startOnAxis": "true",
      // "labelFunction": function(label) {


      //   if (label == 'start') {
      //     label = 'Day 1';
      //   } else if (label == 1) {
      //     label = 'Day 2';
      //   } else if (label == 3) {
      //     label = 'Day 3';
      //   } else if (label == 5) {
      //     label = 'Day 4';
      //   } else if (label == 7) {
      //     label = 'Day 5';
      //   } else if (label == 9) {
      //     label = 'Day 6';
      //   } else if (label == 11) {
      //     label = 'Day 7';
      //   } else if (label == 13) {
      //     label = 'Day 8';
      //   } else if (label == 15) {
      //     label = 'Day 9';
      //   } else if (label == 17) {
      //     label = 'Day 10';
      //   } else if (label == 20) {
      //     label = 'End';
      //   } else {
      //     label = '';
      //   }

      //   return label;
      // },
    },
    "legend": {
      "position": "left",
      "marginTop": 20,
      "valueText": ''
    },
      "listeners": [{
    "event": "drawn",
    "method": addLegendLabel
  }]
});


function addLegendLabel(e) {
  var title = document.createElement("div");
  title.innerHTML = "Borders";
  title.className = "legend-title";
  e.chart.legendDiv.appendChild(title)
}

//envent time vars

//load from local storage
$('#current-points').val(localStorage.getItem("currentPoints"));
$('#red1').val(localStorage.getItem("red1"));
$('#red2').val(localStorage.getItem("red2"));
$('#red3').val(localStorage.getItem("red3"));
$('#blue1').val(localStorage.getItem("blue1"));
$('#blue2').val(localStorage.getItem("blue2"));
$('#blue3').val(localStorage.getItem("blue3"));
$('#yellow1').val(localStorage.getItem("yellow1"));
$('#yellow2').val(localStorage.getItem("yellow2"));
$('#yellow3').val(localStorage.getItem("yellow3"));



//get the value of the red team
var getRedValue = function () {
	//points
	var currentPoints = parseFloat(document.getElementById('current-points').value);
	localStorage.setItem('currentPoints',currentPoints); 

	///red

  var red1 = parseFloat(document.getElementById('red1').value);
  var red2 = parseFloat(document.getElementById('red2').value);
  var red3 = parseFloat(document.getElementById('red3').value);
  
  localStorage.setItem("red1",red1);
  localStorage.setItem("red2",red2);
  localStorage.setItem("red3",red3);
  
  ////blue  
  var blue1 = parseFloat(document.getElementById('blue1').value);
  var blue2 = parseFloat(document.getElementById('blue2').value);
  var blue3 = parseFloat(document.getElementById('blue3').value);
  
  localStorage.setItem("blue1",blue1);
  localStorage.setItem("blue2",blue2);
  localStorage.setItem("blue3",blue3);
  
  /////yellow
    
  var yellow1 = parseFloat(document.getElementById('yellow1').value);
  var yellow2 = parseFloat(document.getElementById('yellow2').value);
  var yellow3 = parseFloat(document.getElementById('yellow3').value);
  
  localStorage.setItem("yellow1",yellow1);
  localStorage.setItem("yellow2",yellow2);
  localStorage.setItem("yellow3",yellow3);

	//red  
  var redlp3 = (red1 + red2 + red3) * 2;
  var redlp2 = (red1 + red2) * 1.5;
  var redlp1 = red1;
  
  
  //save it in local storage
  localStorage.setItem("red_lp1",redlp1);
  localStorage.setItem("red_lp2",redlp2);
  localStorage.setItem("red_lp3",redlp3);
  

  var createLpNode = function(color) {
  	var lpContainer = document.createElement('div');

  	var lpThree;
  	var lpTwo;
  	var lpOne;
  
  	//can you create dynamic variables in JS, not sure doesnt look like
  	//maybe use some properities or something

  	if (color === 'red') {
  		lpThree = redlp3;
  		lpTwo = redlp2;
  		lpOne = redlp1;
  	} else if (color ==='blue') {
  		lpThree = bluelp3;
  		lpTwo = bluelp2;
  		lpOne = bluelp1;
  	} else if (color === 'yellow') {
  		lpThree = yellowlp3;
  		lpTwo = yellowlp2;
  		lpOne = yellowlp1;  		
  	}

  var three = document.createElement('p');
  three.innerText = '3lp: '+numberWithCommas(lpThree);
  lpContainer.appendChild(three);
  
  var two = document.createElement('p');
  two.innerText = '2lp: '+numberWithCommas(lpTwo);
  lpContainer.appendChild(two);
  
  var one = document.createElement('p');
  one.innerText = '1lp: '+numberWithCommas(lpOne);
  lpContainer.appendChild(one);

  //redResult.appendChild(lpContainer);	
  $('#'+color+'-result').html(lpContainer);
  };


  //add the calculated totals to the screen
  //add the result to the red-result div
  createLpNode('red');

  //blue
    var bluelp3 = (blue1 + blue2 + blue3) * 2;
  var bluelp2 = (blue1 + blue2) * 1.5;
  var bluelp1= blue1;
  
  
  //save it in local storage
  localStorage.setItem("blue_lp1",bluelp1);
  localStorage.setItem("blue_lp2",bluelp2);
  localStorage.setItem("blue_lp3",bluelp3);
  

  //add the calculated totals to the screen
  //add the result to the blue-result div
  createLpNode('blue');


  //yellow
    var yellowlp3 = (yellow1 + yellow2 + yellow3) * 2;
  var yellowlp2 = (yellow1 + yellow2) * 1.5;
  var yellowlp1 = yellow1;
  
  
  //save it in local storage
  localStorage.setItem("yellow_lp1",yellowlp1);
  localStorage.setItem("yellow_lp2",yellowlp2);
  localStorage.setItem("yellow_lp3",yellowlp3);
  

  //add the calculated totals to the screen
  //add the result to the yellow-result div
  createLpNode('yellow');
};

//calculate the total amounts
var calculate = function() {
  var submit = document.getElementById('calculate');
  submit.addEventListener('click', function() {
  	//calculate everything
  	getRedValue();


    //blue

  }, false);
};


//get current time left in event, update it every second.
var timeLeft = function() {
  var now = Date.now();
  ///this is in MST. Need to get it in JST
  var end = new Date("2017-02-25 22:00:00");
  //how many miliseconds long between the end of the event and now
  var diff = end.getTime() - now;  
  //calculate time left
  var days = Math.floor(diff /(1000 * 60 * 60 * 24));
  //get the remanining time
  var fullDays = (days * 1000 * 60 * 60 * 24);
  var remaining = diff - fullDays;
  
  var hours = Math.floor(remaining /(1000 * 60 * 60));
  var fullHours = (hours * 1000 * 60 * 60);
  remaining = diff - (fullDays + fullHours);
  
  var minutes = Math.floor(remaining/(1000 * 60));
  var fullMinutes = (minutes * 1000 * 60);
  remaining = diff - (fullDays + fullHours + fullMinutes);
  
  var seconds = Math.floor(remaining/(1000));
  
  var timeSpan = document.getElementById('time-remaining');
  timeSpan.textContent = days+' days '+hours+' hours '+minutes+' minutes '+seconds+' seconds';
  
  lpLeft(diff);
}



var lpLeft = function(diff) {

  //this is if you can 1 lp things
  var halfHours =  Math.floor((diff /(1000 * 60 * 60)) * 2);
    //this is if you can 2 lp things
  //var halfHours =  Math.floor((diff /(1000 * 60 * 60)));
      //this is if you can 3 lp things
  //var halfHours =  Math.floor((diff /(1000 * 60 * 60)));
  
  
  var lpSpan = document.getElementById('lp-remaining');
  lpSpan.textContent = halfHours;
  
  var naturalPoints1 = halfHours * 6000;
  var naturalBase1 = document.getElementById('base-natural-points');
  naturalBase1.textContent = numberWithCommas(naturalPoints1);
  
    var naturalPoints2 = (halfHours/2) * 6000;
  var naturalBase2 = document.getElementById('base-natural-points2');
  naturalBase2.textContent = numberWithCommas(naturalPoints2);
  
    var naturalPoints3 = (halfHours/3) * 6000;
  var naturalBase3 = document.getElementById('base-natural-points3');
  naturalBase3.textContent = numberWithCommas(naturalPoints3);  


var lp1points = parseInt(naturalPoints1,10) + parseInt(localStorage.getItem("currentPoints"),10);
$('#base-total-points').html(numberWithCommas(lp1points));

var lp2points = parseInt(naturalPoints2,10) + parseInt(localStorage.getItem("currentPoints"),10);
$('#base-total-points2').html(numberWithCommas(lp2points));

var lp3points = parseInt(naturalPoints3,10) + parseInt(localStorage.getItem("currentPoints"),10);
$('#base-total-points3').html(numberWithCommas(lp3points));


};

//go through the event days, show which ones have passed, show which ones have halfway challenger
var eventDays = function() {
  
};

calculate();
//showTime();



















//show remaining time, calculate points/LP
var showTime = setInterval(timeLeft,1000);



function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


 </script>

@endsection
