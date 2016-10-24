<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @section('title')
        @show
    </title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Loved+by+the+King" rel="stylesheet"> 

    <!-- Styles -->
    <link href="/css/bootstrapyeti.min.css" rel="stylesheet">
    <link href="/css/enstars.css" rel="stylesheet">
    <link href="/css/boy.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

    <script src="/js/jquery-2.2.4.min.js"></script>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                     {{ config('app.name', 'Laravel') }}  
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Current Event</a></li>
            <li><a href="#">Stories</a></li>
            <li><a href="#">Calculator</a></li>
          </ul>
        </li>
                    <li><a href="http://enstars.info/birthdays">Birthday Calendar</a></li>
                   <!-- <li><a href="{{ url('/reviews') }}">Reviews</a></li>
                    <li><a href="{{ url('/news') }}">News</a></li>
                    <li><a href="{{ url('/about') }}">About</a></li>-->
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
      <br>

      </div>
      <div class="col-md-3">
            <br>
          <ul class="list-inline text-center">
            <li>
              <a href="{{ url('rss') }}" data-toggle="tooltip"
                 title="RSS feed">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-rss fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/enstars_info" data-toggle="tooltip"
                 title="My Twitter Page">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
      </div>
      <div class="col-md-4">
        <br>
        <a class="navbar-right" href="/contact">Contact Us</a>
      </div>
    </div>
  </div>
</footer>
    <!-- JavaScripts -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84361146-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
