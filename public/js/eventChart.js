//set up the new border for event 50 and onward
var fiveStarBorder;

if (eventID > 49) {
  fiveStarBorder = '2000';
} else {
  fiveStarBorder = '1200';
}

//deal with switchover to using normalized jst time
if (eventID > 93) {
  createdAt = 'jst_created_at';
} else {
  createdAt = 'created_at';
}

var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "dataDateFormat": "YYYY-MM-DD HH:NN",
    "dataLoader": {
    "url": "/data/event-border/"+eventID,
    "format": "json",
  },
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left"
    }],
    "graphs": [{
        "id":"1 5 Star - 1200",
        "title": fiveStarBorder,
        "bullet": "round",
        "balloonText": "[[value]]",
        "valueField": "tier_2"
    },{
        "id":"40",
        "title": "11000",
        "bullet": "round",
        "balloonText": "[[value]]",
        "valueField": "tier_6"
    },{
        "id":"41",
        "title": "35000",  
        "bullet": "round",
        "balloonText": "[[value]]",
        "valueField": "tier_11"
    }],
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 1,
        "valueLineAlpha":0.5,
    },
    "categoryField": createdAt,
    "categoryAxis": {
      "parseDates": true,
      "minPeriod": "hh"
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