@extends('layouts.app')

@section('content')
    <style type="text/css" media="screen">
        #editor {
            height: 400px;
        }
    </style>
    <div class="container">
        <h1>Edit Boy CSS</h1>

        <div id="editor">
            <?php
            echo file_get_contents('./css/boy.css', true);
            ?>
        </div>
        <br>
        <button id="css-save" class="btn btn-primary">Update</button>

    </div>
    <script src="/js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
        //load the css content

        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setMode("ace/mode/css");

        //need to ajax post it on save?
        //ajax fopen then frwite though!

        //http://stackoverflow.com/questions/6659559/ace-editor-in-php-web-app
        saveFile = function () {
            var contents = editor.getSession().getValue();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            //e.preventDefault();
            $.ajax({

                type: "POST",
                url: '/home/save/css',
                data: {contents: contents},
                dataType: 'json',
                success: function (data) {
                    //update the timestamp
                    //$('#lastupdated-'+slideID).html(data.date);
                    console.log(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        };

        //save on  update button too
        $('#css-save').on('click', function () {
            saveFile();
        });


        // Fake-Save, works from the editor and the command line.
        var commands = editor.commands;
        commands.addCommand({
            name: "save",
            bindKey: {
                win: "Ctrl-S",
                mac: "Command-S",
                sender: "editor|cli"
            },
            exec: function () {
                saveFile();
            }
        });

    </script>

@endsection
