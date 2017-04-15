@extends('layouts.layout')

@section('title')
@parent
{{$card->name_e}} | enstars.info
@stop

@section('content')
<div class="container">
                        <?php
                            //set up the colors
                            if ($card->color == 'red') {
                                $color_class = 'panel-danger';
                            } else if ($card->color == 'blue') {
                                $color_class = 'panel-info';
                            } else if ($card->color == 'yellow') {
                                $color_class = 'panel-warning';
                            } else {
                                $color_class = 'panel-default';
                            }

                            if ($card->scout_id != 0) {
                                //its from a scout
                                $from = 'scout';
                            } else if ($card->event_id !=0) {
                                //its from an event
                                $from = 'event';
                            } else {
                                $from = 'pool';
                            }

                            if ($source) {
                                //format starting date
                                $start_date = date('F j, Y',strtotime($source->start));
                            } else {
                                $start_date = 'Original Card';
                            }


                            //image url
                            $scout_image = '/images/cards/get/'.$card->boy_id.'_'.$card->card_id.'.png';
                            //echo $scout_image;
                        ?>  
        	<h1>{{$card->name_e}} <small><a href="/idol/{{ strtolower($boy->first_name)}}">{{$boy->first_name}} {{$boy->last_name}}</a></small></h1>
         <div class="row">
            <div class="col-md-6">
                <div class="panel {{$color_class}}">
                  <div class="row">
                    <div class="col-md-6">
                        <img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}.png">
                    </div>
                    <div class="col-md-6">
                         <img class="img-responsive" src="/images/cards/{{$card->boy_id}}_{{$card->card_id}}b.png">
                    </div>
                  </div>
                  <p>{{$card->sentence_e}}</p>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Released: {{$start_date}}</h3> 
                @if ($from == 'pool')
                    <h3>Introduced in: Original Card</h3>
                @elseif ($from == 'scout')
                    <h3>Introduced in: Scout: <a href="/scout/{{$source->url}}">{{$source->name_e}}</a></h3>
                @elseif ($from == 'event')
                    <h3>Introduced in: Event: <a href="/event/{{$source->url}}">{{$source->name_e}}</a></h3>
                @endif
                
                @if ($dorifes_skill->id == 0)
                    <h3>Dream Festival Skill: {{$dorifes_skill->english_description}} </h3>
                @else
                    <h3>Dream Festival Skill: <a href="/skill/{{$dorifes_skill->id}}">{{$dorifes_skill->english_description}}</a></h3>
                @endif

                @if ($lesson_skill->id == 0)
                    <h3>Lesson Skill: {{$lesson_skill->english_description}} </h3>
                @else
                    <h3>Lesson Skill: <a href="/skill/{{$lesson_skill->id}}">{{$lesson_skill->english_description}}</a></h3>
                @endif

            </div>
         </div>   
         <div class="row">
            <div class="col-md-12">
                @if (file_exists($scout_image))
                <img class="img-responsive" src="/images/cards/get/{{$card->boy_id}}_{{$card->card_id}}.png">
                @endif

                

                @if (strlen($road) > 5)
                    <h3>Idol Road</h3>
                    <div id="road">
                    </div>

                    <script>
                    var road = <?php print $road; ?>;
                    var stars = <?php print $card->stars; ?>;
                    </script>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.5.0/d3.min.js"></script>
                    <script>
                      //intial settings
                      var y = 50;
                      var starty;
                      //starting square this moves based on the type of card
                      //1 2 3? stars would be at 100? and 4!
                      if (stars < 5) {
                        //start at 100
                        starty = 100;
                      } else {
                        starty = 150;
                      }                      

                      //Make an SVG Container
                      var svgContainer = d3.select("#road").append("svg")
                                                         .attr("width", 1000)
                                                         .attr("height", starty *2);


                       //Draw the Rectangle
                      var rectangle = svgContainer.append("rect")
                                                 .attr("fill", 'white')
                                                 .style("stroke", '#074886')
                                                 .style("stroke-width", 1)
                                                 .attr("x", 0)
                                                .attr("y", starty)
                                                .attr("width", 40)
                                                .attr("height", 40);

                        //add start container text
                        var text = svgContainer.append('text')
                                                .text('Start')
                                                .attr("x", 5)
                                                .attr("y", starty+25)
                                                .attr("font-size", 13)
                                                .attr('fill', '#074886')



//function node(color,position,points) {
  function node(nodeData) {
    var color =  nodeData.type;
    var placement = nodeData.placement;
    var points = nodeData.points;
  var x = placement * 70;
  
  //if the position 1, dont build this

  if ((nodeData.position > 1) || (nodeData.parent == 0)) {
    var connector = svgContainer.append("rect")
                             .attr("fill", '#a0df88')
                             .attr("x", x-29)
                            .attr("y", y+12)
                            .attr("width", 30)
                            .attr("height", 15);    
  } 

  //build the vertical thing if its parent isn't 0 and its position is 1
  if ((nodeData.position == 1)  && (nodeData.parent != 0)) {
    var vx;
    var vy;

    var hx;
    var hy;

      vx = x - 20;
      hx = x - 20;
      //var y;

    if (nodeData.direction == 'up') {
      vy = y + 30;
      hy = y + 15;
    } else {
     
      vy = y - 10;
      hy = y + 10;
    }


    //verical piece
    var verticalConnector = svgContainer.append("rect")
                               .attr("fill", '#a0df88')
                               .attr("x", vx)
                              .attr("y", vy)
                              .attr("width", 15)
                              .attr("height", 25);



    //horizontal piece
    var horizontalConnector = svgContainer.append("rect")
                               .attr("fill", '#a0df88')
                               .attr("x", hx)
                              .attr("y", hy)
                              .attr("width", 25)
                              .attr("height", 15);                           
  }


   //Draw the Rectangle
 var rectangle = svgContainer.append("rect")
                             .attr("fill", nodeData.color)
                             .style("stroke", '#074886')
                             .style("stroke-width", 1)
                             .attr("x", x)
                            .attr("y", y)
                            .attr("width", 40)
                            .attr("height", 40);



var text = svgContainer.append('text').text(points)
                .attr("x", x+2)
                .attr("y", y+35)
                .attr("font-size", 13)
                .attr('fill', 'white')

}


var totalDance = 0;
var totalVocal = 0;
var totalPerformance = 0;
var totalStories = 0;


for (var i = 0; i < road.length; i++) {
  //lets figure out the level its on, set the offset
  var level;
  var offset;
  if (road[i].parent == 0) {
    level = 'start';
    offset = 0;
  } else if (road[i].parent.indexOf('_') > -1) {
    //parent has an underscore, its the top/bottom
    level = 'second';
    offset = -0.1;
  } else {
    //its the inbetween level
    level = 'first';
    offset = .5;
  }



  //if its the first node in a set it needs the elbow connector
  //then it wont connect to the one infront

  var direction;
  //clean up the letters
  //get everything before u
  if (road[i].parent != 0) {
    var motherNode = road[i].node.substr(0, road[i].node.indexOf('u')); 
    //console.log('mother defined: '+motherNode);
    if (motherNode < 1) {
      motherNode = road[i].node.substr(0, road[i].node.indexOf('d')); 
      //verticalConnector('down',motherNode);  
      direction = 'down';
    } else {
      //verticalConnector('up',motherNode);
      direction = 'up';
    }
  } else {
    var motherNode = 0;
  }
  
  //get everything after _
  var position = road[i].node.substr(road[i].node.indexOf('_') + 1); 
  //need to remove letters if there are any
  if (position < 1) {
     position = road[i].node.substr(0, road[i].node.indexOf('u')); 
    if (position < 1) {
      position = road[i].node.substr(0, road[i].node.indexOf('d')); 
      //verticalConnector('down',position);
      direction = 'down';
    }   else {
      //verticalConnector('up',position);
      direction = 'up';
    }
  }


  //set the nodes colors
  var color;
  if (road[i].type == 'bloom') {
    color = '#f86fbc';
    road[i].points = '\u273F';
  } else if (road[i].type == 'story') {
    color = '#f39c5c';
    road[i].points = 'story';
    totalStories++;
  } else if (road[i].type == 'outfit') {
    color = '#f39c5c';
    road[i].points = 'Outfit';
  } else if (road[i].type == 'lesson') {
    color = '#5f52a0';
    road[i].points = 'Lesson';
  } else if (road[i].type == 'live') {
    color = '#5f52a0';
    road[i].points = 'Live';
  } else if (road[i].type == 'red') {
    totalDance += road[i].points;
    color = "#f3726b";
  } else if (road[i].type == 'blue') {
    totalVocal += road[i].points;
    color = "#1db0ed";
  } else if (road[i].type == 'yellow') {
    totalPerformance += road[i].points;
    color = "#fed54b";
  }

  //console.log('mother: '+motherNode+' position: '+position);
  var placement = parseInt(motherNode,10) + parseInt(position,10) - offset;

  //draw the node
  var nodeData = {
    "type": road[i].type,
    "placement": placement,
    "points": road[i].points,
    "position": position,
    "parent": road[i].parent,
    "direction": direction,
    "color": color
  }


  //send it an object?

  //node(road[i].type,placement,road[i].points);
  node(nodeData);

  //console.log(road[i].points+' pos: '+placement+ ' mother: '+motherNode+' position: '+position);

  //check if its the end of the road, move it down
  if (road[i].end == 1) {
    y = y+50;
  }

} //end looping through all the nodes


//console.log('total dance: '+totalDance+ 'total vocal: '+totalVocal+' total totalPerformance:'+totalPerformance);


                    </script>


                @endif

                @if (!Auth::guest())

                    @if (Auth::user()->isAdmin())




                    
                            {!! Form::open(['url' => '/edit/card']) !!}             
                                  <div class="form-group">
                                    <label for="japanese-name">Japanese Name</label>
                                     {!! Form::text('japanese_name',$card->name_j,['class'=>'form-control','id'=>'japanese-name']) !!}
                                  </div>                  
                                  <div class="form-group">
                                    <label for="english-name">English Name</label>
                                     {!! Form::text('english_name',$card->name_e,['class'=>'form-control','id'=>'english-name']) !!}
                                  </div>   
                                  <div class="form-group">
                                    <label for="s-name">Placeholder Name</label>
                                     {!! Form::text('name_s',$card->name_s,['class'=>'form-control','id'=>'s-name']) !!}
                                  </div>   
                                  <div class="form-group">
                                    <label for="sentence-j">Japanese Sentence (when scouted or on promo materials)</label>
                                     {!! Form::text('sentence_j',$card->sentence_j,['class'=>'form-control','id'=>'sentence-j']) !!}
                                  </div>  
                                  <div class="form-group">
                                    <label for="sentence-e">English Sentence (when scouted or on promo materials)</label>
                                     {!! Form::text('sentence_e',$card->sentence_e,['class'=>'form-control','id'=>'sentence-e']) !!}
                                  </div> 
                                  <div class="form-group">
                                    <label for="dorifes_j">Japanese Dorifes Skill </label>
                                     {!! Form::text('dorifes_j',$card->dorifes_j,['class'=>'form-control','id'=>'dorifes_j']) !!}
                                  </div>  
                                  <div class="form-group">
                                    <label for="dorifes_e">English Dorifes Skill</label>
                                     {!! Form::text('dorifes_e',$card->dorifes_e,['class'=>'form-control','id'=>'dorifes_e']) !!}
                                  </div>      
                                  <div class="form-group">
                                    <label for="lesson_j">Japanese Lesson Skill </label>
                                     {!! Form::text('lesson_j',$card->lesson_j,['class'=>'form-control','id'=>'lesson_j']) !!}
                                  </div>  
                                  <div class="form-group">
                                    <label for="lesson_e">English Lesson Skill</label>
                                     {!! Form::text('lesson_e',$card->lesson_e,['class'=>'form-control','id'=>'lesson_e']) !!}
                                  </div>                                                                                           
                                <div class="form-group">
                                    <label for="stars">Stars</label>
                                     {!! Form::text('stars',$card->stars,['class'=>'form-control','id'=>'stars']) !!}
                                  </div>  
                                <div class="form-group">
                                    <label for="stars">Color</label>
                                     {!! Form::text('color',$card->color,['class'=>'form-control','id'=>'color']) !!}
                                  </div>
                                  <div class="form-group">
                                    <label for="lesson-skill">Lesson Skill</label>
                                    {!! Form::select('lesson_id', $lesson_skills,$card->lesson_id ,['class'=>'form-control', 'id'=>'lesson-skill','placeholder' => 'Lesson Skill']) !!} 
                                  </div>
                                  <div class="form-group">
                                    <label for="dorifes-id">Dream Festival Skill</label>
                                    {!! Form::select('dorifes_id', $dorifes_skills,$card->dorifes_id,['class'=>'form-control', 'id'=>'dorifes-id','placeholder' => 'Dream Festival Skill']) !!} 
                                  </div>                   
                                  {!! Form::hidden('card_id', $card->id) !!}                                                      
                            {!! Form::submit('Edit') !!}
                            {!! Form::close() !!}
                    @endif   
                @endif             
            </div>
         </div>   
</div>
@endsection
