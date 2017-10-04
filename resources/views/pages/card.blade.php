@extends('layouts.layout')

@section('title')
@parent
{{$card->name_e}} | enstars.info
@stop

@section('content')
<style>
 .card-title {
  font-weight: 400;
 } 
</style>
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
                <h4><span class="card-title">Released:</span> {{$start_date}}</h4> 
                @if ($from == 'pool')
                    <h4><span class="card-title">Introduced in:</span> Original Card</h4>
                @elseif ($from == 'scout')
                    <h4><span class="card-title">Introduced in Scout:</span> <a href="/scout/{{$source->url}}">{{$source->name_e}}</a></h4>
                @elseif ($from == 'event')
                    <h4><span class="card-title">Introduced in Event:</span> <a href="/event/{{$source->url}}">{{$source->name_e}}</a></h4>
                    <?php
                     // print '<pre>';
                     // print_r($source);
                     // print '</pre>'; 

                      //figure out what kind of card it is, this logic should be moved to the controller

                    ?>
                    @if ($source->rank_5 == $card->id)
                      Ranking 5 star
                    @elseif($source->rank_4 == $card->id)
                      Ranking 4 star
                    @elseif($source->rank_3 == $card->id)
                      Ranking 3 star
                    @elseif($source->points_5 == $card->id)
                      Points 5 star
                    @elseif($source->points_4 == $card->id)
                      Points 4 star                      
                    @else
                      Points 3 star
                    @endif


                @endif
                <hr>
                @if ($dorifes_skill->id == 0)
                    <h4><span class="card-title">Dream Festival Skill:</span> {{$dorifes_skill->english_description}} </h4>
                @else
                    <h4><span class="card-title">Dream Festival Skill:</span> <a href="/skill/{{$dorifes_skill->id}}">{{$dorifes_skill->english_description}}</a></h4>
                @endif
                <h4>{{$card->dorifes_e}}</h4>
                @if ($lesson_skill->id == 0)
                    <h4><span class="card-title">Lesson Skill:</span> {{$lesson_skill->english_description}} </h4>
                @else
                    <h4><span class="card-title">Lesson Skill:</span> <a href="/skill/{{$lesson_skill->id}}">{{$lesson_skill->english_description}}</a></h4>
                @endif
                <h4>{{$card->lesson_e}}</h4>
                <hr>
                Base stats<br>
                @if ($card->da !== 0) 
                  Da: {{$card->da}}<br>
                  Vo: {{$card->vo}}<br>
                  Pf: {{$card->pf}} 
                @endif

            </div>
         </div>   
         <div class="row">
          <div class="col-md-8">
          </div>
          <div class="col-md-4">
            <a href="/cardissue/{{$card->id}}">See something wrong with this card? Let us know!</a>
          </div>
         </div>
         <div class="row">
            <div class="col-md-12">
                @if (file_exists($scout_image))
                <img class="img-responsive" src="/images/cards/get/{{$card->boy_id}}_{{$card->card_id}}.png">
                @endif

                

                @if (strlen($road) > 5)
                    <h3>Idol Road</h3>
         
                        <strong>Total Gems Needed</strong><br>
                        <div class="col-md-4">
                        <table>
                          <tr>
                            <td>
                              <img src="/images/red_small.png" width="25px" alt="red small"> x{{$red_small}} 
                            </td>
                            <td>
                              <img src="/images/red_medium.png" width="25px" alt="red medium"> x{{$red_medium}}
                            </td>
                            <td>
                              <img src="/images/red_large.png" width="25px" alt="red large"> x{{$red_large}} 
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="/images/blue_small.png" width="25px" alt="blue small"> x{{$blue_small}} 
                            </td>
                            <td>
                              <img src="/images/blue_medium.png" width="25px" alt="blue small"> x{{$blue_medium}} 
                            </td>
                            <td>
                              <img src="/images/blue_large.png" width="25px" alt="blue small"> x{{$blue_large}} 
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="/images/yellow_small.png" width="25px" alt="yellow small"> x{{$yellow_small}} 
                            </td>
                            <td>
                              <img src="/images/yellow_medium.png" width="25px" alt="yellow small"> x{{$yellow_medium}} 
                            </td>
                            <td>
                              <img src="/images/yellow_large.png" width="25px" alt="yellow small"> x{{$yellow_large}} 
                            </td>
                          </tr>                          
                        </table>
                        </div>
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
                                                         .attr("width", 1200)
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
                  @if ($user_card !='')
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">
                          Card Statistics 

                          {!! Form::open(['url' => '/user/edit/dashboardCard','style'=>'display:inline!important']) !!}    
                          {!! Form::hidden('card_id', $card->id) !!}
                          {!! Form::hidden('usercard_id', $user_card->id) !!} 
                          {!! Form::submit('Set as Dashboard Card',['class'=>'btn btn-primary btn-xs']) !!}         
                          {!! Form::close() !!}  
                          <span class="pull-right">Added:   {{$user_card->created_at}}</span>
                    </h3>
                  </div>
                  <div class="panel-body">
                  <div class="row">
                  {!! Form::open(['url' => '/user/edit/card']) !!}             
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="copies">Copies</label>
                        </div>
                        <div class="col-md-4">
                          {!! Form::number('copies',$user_card->copies,['class'=>'form-control','id'=>'copies','min'=>'1','max'=>'5']) !!}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                           <label for="level">Level</label>
                        </div>
                        <div class="col-md-4">
                           {!! Form::number('level',$user_card->level,['class'=>'form-control','id'=>'level']) !!}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="percent">Percent</label>
                        </div>
                        <div class="col-md-4">
                          {!! Form::number('percent',$user_card->percent,['class'=>'form-control','id'=>'percent']) !!}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-2">
                         <label for="dance">Dance</label>
                        </div>
                        <div class="col-md-4">
                          {!! Form::number('da',$user_card->da,['class'=>'form-control','id'=>'dance']) !!}                        
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                           <label for="vocal">Vocal</label>
                        </div>
                        <div class="col-md-4">
                            {!! Form::number('vo',$user_card->vo,['class'=>'form-control','id'=>'vocal']) !!}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                           <label for="performance">Pf</label>
                        </div>
                        <div class="col-md-4">
                          {!! Form::number('pf',$user_card->pf,['class'=>'form-control','id'=>'performance']) !!}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-2">
                         <label for="display">Card Display</label>
                        </div>
                        <div class="col-md-4">
                           {!! Form::select('bloom', array('0' => 'Unbloomed', '1' => 'Bloomed'), $user_card->bloom,['class'=>'form-control','id'=>'bloom']) !!}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                           <label for="affection">Affection</label>
                        </div>
                        <div class="col-md-4">
                           {!! Form::number('affection',$user_card->affection,['class'=>'form-control','id'=>'vocal']) !!}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          {!! Form::hidden('card_id', $card->id) !!}
                          {!! Form::hidden('usercard_id', $user_card->id) !!} 
                          {!! Form::submit('Update Statistics',['class'=>'btn btn-primary']) !!}         
                        </div>
                      </div>
                    </div>
                  </div>
                            {!! Form::close() !!}                  
                  </div>
                </div>
                  @endif
                @endif





                @if (!Auth::guest())
                    @if (Auth::user()->isAdmin())
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Admin - Edit Card <span class="pull-right">Last Updated on {{$card->updated_at}} by {{$updated_by->name}} </span></h3>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['url' => '/edit/card']) !!}    
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group form-inline">
                                    <label for="japanese-name">Japanese Name</label>
                                     {!! Form::text('japanese_name',$card->name_j,['class'=>'form-control','id'=>'japanese-name']) !!}
                                  </div> 
                                  <div class="form-group form-inline">
                                    <label for="english-name">English Name</label>
                                     {!! Form::text('english_name',$card->name_e,['class'=>'form-control','id'=>'english-name']) !!}
                                  </div>
                                  <div class="form-group form-inline">
                                    <label for="sentence-j">Japanese Sentence (when scouted or on promo materials)</label>
                                     {!! Form::text('sentence_j',$card->sentence_j,['class'=>'form-control','id'=>'sentence-j']) !!}
                                  </div>  
                                  <div class="form-group form-inline">
                                    <label for="sentence-e">English Sentence (when scouted or on promo materials)</label>
                                     {!! Form::text('sentence_e',$card->sentence_e,['class'=>'form-control','id'=>'sentence-e']) !!}
                                  </div>                                                                                                        
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-inline">
                                    <label for="stars">Stars</label>
                                     {!! Form::text('stars',$card->stars,['class'=>'form-control','id'=>'stars']) !!}
                                  </div>  
                                <div class="form-group form-inline">
                                    <label for="stars">Color</label>
                                     {!! Form::text('color',$card->color,['class'=>'form-control','id'=>'color']) !!}
                                  </div>
                                <div class="form-group form-inline">
                                    <label for="da">Da</label>
                                     {!! Form::text('da',$card->da,['class'=>'form-control','id'=>'da']) !!}
                                  </div>
                                <div class="form-group form-inline">
                                    <label for="vo">Vo</label>
                                     {!! Form::text('vo',$card->vo,['class'=>'form-control','id'=>'vo']) !!}
                                  </div>
                                <div class="form-group form-inline">
                                    <label for="pf">Pf</label>
                                     {!! Form::text('pf',$card->pf,['class'=>'form-control','id'=>'pf']) !!}
                                  </div>                                 
                              </div>
                            </div>
                              <hr>
                              <h3>Leveled Skills</h3>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group form-inline">
                                    <label for="dorifes_j">Japanese Dorifes Skill </label>
                                     {!! Form::text('dorifes_j',$card->dorifes_j,['class'=>'form-control','id'=>'dorifes_j']) !!}
                                  </div>  
                                  <div class="form-group form-inline">
                                    <label for="dorifes_e">English Dorifes Skill</label>
                                     {!! Form::text('dorifes_e',$card->dorifes_e,['class'=>'form-control','id'=>'dorifes_e']) !!}
                                  </div>      
                                  <div class="form-group form-inline">
                                    <label for="lesson_j">Japanese Lesson Skill </label>
                                     {!! Form::text('lesson_j',$card->lesson_j,['class'=>'form-control','id'=>'lesson_j']) !!}
                                  </div>  
                                  <div class="form-group form-inline">
                                    <label for="lesson_e">English Lesson Skill</label>
                                     {!! Form::text('lesson_e',$card->lesson_e,['class'=>'form-control','id'=>'lesson_e']) !!}
                                  </div>                                    
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group form-inline">
                                    <label for="dorifes-id">Dream Festival Skill</label>
                                    {!! Form::select('dorifes_id', $dorifes_skills,$card->dorifes_id,['class'=>'form-control', 'id'=>'dorifes-id','placeholder' => 'Dream Festival Skill']) !!} 
                                  </div>                                                                                                                                      
                                  <div class="form-group form-inline">
                                    <label for="lesson-skill">Lesson Skill</label>
                                    {!! Form::select('lesson_id', $lesson_skills,$card->lesson_id ,['class'=>'form-control', 'id'=>'lesson-skill','placeholder' => 'Lesson Skill']) !!} 
                                  </div>                                   
                                </div>
                              </div>
                              <hr>
                              <h3>Uneveled Skills</h3>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group form-inline">
                                    <label for="u_dorifes_j">Japanese Dorifes Skill </label>
                                     {!! Form::text('u_dorifes_j',$card->u_dorifes_j,['class'=>'form-control','id'=>'u_dorifes_j']) !!}
                                  </div>  
                                  <div class="form-group form-inline">
                                    <label for="u_dorifes_e">English Dorifes Skill</label>
                                     {!! Form::text('u_dorifes_e',$card->u_dorifes_e,['class'=>'form-control','id'=>'u_dorifes_e']) !!}
                                  </div>      
                                  <div class="form-group form-inline">
                                    <label for="u_lesson_j">Japanese Lesson Skill </label>
                                     {!! Form::text('u_lesson_j',$card->u_lesson_j,['class'=>'form-control','id'=>'u_lesson_j']) !!}
                                  </div>  
                                  <div class="form-group form-inline">
                                    <label for="u_lesson_e">English Lesson Skill</label>
                                     {!! Form::text('u_lesson_e',$card->u_lesson_e,['class'=>'form-control','id'=>'u_lesson_e']) !!}
                                  </div>                                    
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group form-inline">
                                    <label for="u_dorifes-id">Dream Festival Skill</label>
                                    {!! Form::select('u_dorifes_id', $dorifes_skills,$card->u_dorifes_id,['class'=>'form-control', 'id'=>'u_dorifes-id','placeholder' => 'Dream Festival Skill']) !!} 
                                  </div>                                                                                                                                      
                                  <div class="form-group form-inline">
                                    <label for="u_lesson-skill">Lesson Skill</label>
                                    {!! Form::select('u_lesson_id', $lesson_skills,$card->u_lesson_id ,['class'=>'form-control', 'id'=>'u_lesson-skill','placeholder' => 'Lesson Skill']) !!} 
                                  </div>                                   
                                </div>
                              </div>                              
                            </div>
                
 
                                                                                          
                 
                                  {!! Form::hidden('card_id', $card->id) !!}                                                      
                            {!! Form::submit('Edit') !!}
                            {!! Form::close() !!}
                        </div>
                      </div>

                    @endif   
                @endif             
            </div>
         </div>   
</div>
@endsection
