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

    //editor.setValue("");
    //editor.gotoLine(1);

</script>

@endsection
