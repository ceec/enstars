@extends('layouts.layout')

@section('title')
    @parent
    Memory | enstars.info
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @foreach($pictures as $picture)
                    <button class="picture" id="{{$picture}}">
                        <img height="50" src="/images/boys/{{$picture}}.png">
                    </button>
                @endforeach
            </div>
            <div class="col-md-6">

                @foreach($boys as $boy)
                    <button class="name" id="{{str_replace(' ','-',$boy)}}">
                        {{$boy}}</button>

                @endforeach
            </div>
        </div>
    </div>

    <script>
        var answers = <?php echo json_encode($answers); ?>;
        var chosenPicture;
        var chosenName;

        var pictures = document.getElementsByClassName('picture');

        for (const picture of pictures) {
            picture.addEventListener('click', function () {
                chosenPicture = this.id;
                checkEqual();
            });
        }

        var names = document.getElementsByClassName('name');

        for (const name of names) {
            name.addEventListener('click', function () {
                chosenName = this.id;
                checkEqual();
            });
        }

        function checkEqual() {
            var check = chosenPicture + chosenName;
            //check if they match
            if (answers.includes(check)) {
                document.getElementById(chosenName).remove();
                document.getElementById(chosenPicture).remove();
            }
        }
    </script>
@endsection
