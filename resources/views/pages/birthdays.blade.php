@extends('layouts.layout')

@section('title')
@parent
Birthday Calendar | enstars.info
@stop

@section('content')
<style>
.birthday {
    background-color: #6699FF;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Birthday Calendar</h1>
            <div class="row">
                
                    @foreach($birthdays as $month => $mboys)
                        <div class="col-md-3">
                        <h3>{{$month}}</h3>
                        <?php $days = date('t',strtotime($month));
                                $month_number = date('m',strtotime($month));
                                $previous_month = $month_number - 1;
                                $next_month = $month_number + 1;
                        ?>
                        <table class="table">
                            <tr>
                                @for ($i = 1; $i <= $days; $i++)
                                <td>
                                    <?php $date_display = $i; ?>
                                    @foreach($mboys as $boy)
                                        @if (date('j',strtotime($boy->birthday)) == ($i))
                                            
                                            <?php $date_display = '<span class="birthday">'.$i.'</span>'; ?>

                                        
                                        @endif
                                    @endforeach

                                    {!! $date_display !!}
                                </td>
                                @if (($i % 7) == 0)
                                </tr><tr>
                                @endif
                                @endfor 
                            </tr>      
                        </table>
                            <ul>
                                @foreach($boys as $boy)
                                    @if (date('m',strtotime($boy->birthday)) == $month_number)
                                        <li>{{date('j',strtotime($boy->birthday))}} - {{$boy->first_name}} {{$boy->last_name}}</li>
                                    @endif
                                @endforeach
                            </ul>     
                        </div>
                        @if (date('n',strtotime($month)) % 4 == 0)
                            </div><div class="row">
                        @endif
                    @endforeach

                                 
                </div>                                                                             
            </div> <!-- end calendar row of 4 -->                       
        </div> <!-- end 12 div -->
    </div> <!-- end first row -->
</div> <!-- end container -->
@endsection
