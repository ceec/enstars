<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @section('title')
        @show
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Loved+by+the+King" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Architects+Daughter" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/bootstrapyeti.min.css" rel="stylesheet">
    <link href="/css/enstars3.css" rel="stylesheet">
    <link href="/css/boy.css" rel="stylesheet">

    <!-- JS -->
    <script src="/js/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    {{--    <script>--}}
    {{--      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){--}}
    {{--      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),--}}
    {{--      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)--}}
    {{--      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');--}}

    {{--      ga('create', 'UA-84361146-1', 'auto');--}}
    {{--      ga('send', 'pageview');--}}

    {{--    </script>--}}
</head>
<body id="app-layout">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Events <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/event/{{ \App\Event::current() }}">Current Event</a></li>
                        <li><a href="/event/all">All Events</a></li>
                        <li><a href="/event/calculator">Calculator</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Scouts <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/scout/{{ \App\Scout::current() }} ">Current Scout</a></li>
                        <!--<li><a href="/scout/tsumugis-introduction">Current Story Scout</a></li>-->
                        <li><a href="/scout/all">All Scouts</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Other Card Sources <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/unitcollection/all">Unit Collections</a></li>
                        <li><a href="/collaboration/all">Collaborations</a></li>
                        <li><a href="/starmedalshop">Star Medal Shop</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Translations <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/translation/event">Event Stories</a></li>
                        <li><a href="/translation/scout">Scout Stories</a></li>
                        <li><a href="/translation/character">Character Stories</a></li>
                        <li><a href="/translation">All Stories</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Gameplay <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Basic</li>
                        <li><a href="/game/terms">Terms</a></li>
                        <li><a href="/game/missions">Missions</a></li>
                        <li class="dropdown-header">Music</li>
                        <li class="dropdown-header">Classic</li>
                        <li><a href="/unitskill/all">Unit Skills</a></li>
                        <li><a href="/game/releasenotes">Release Notes</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Data <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/graph/cards-released">Released Cards Graph</a></li>
                        <li><a href="/graph/five-star-history/basic">Five Star History</a></li>
                        <li><a href="/birthdays">Birthday Calendar</a></li>
                    </ul>
                </li>
                <!--<li><a href="/store">Store</a></li>-->
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if (Auth::user()->isAdmin())
                                <li><a href="{{ url('/home') }}">Admin</a></li>
                            @endif
                            <li><a href="{{ url('/user/dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('/user/'.Auth::user()->name.'/cards') }}">Cards</a></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<main>
    @yield('content')
</main>
<footer class="footer">
    <div style="display:flex;align-items:center;">
        <div class="col-md-4">
            Images and Characters From <a href="http://stars.happyelements.co.jp/">あんさんぶるスターズ！</a>
        </div>
        <div class="col-md-4 text-center">
            <a href="https://twitter.com/enstars_info" data-toggle="tooltip"
               title="My Twitter Page">
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
              </span>
            </a>
        <!-- <ul class="list-inline text-center">
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
            </ul> -->
        </div>
        <div class="col-md-4 text-right">
            <a href="/contact">Contact Us</a>
        </div>
    </div>
</footer>
</body>
</html>
