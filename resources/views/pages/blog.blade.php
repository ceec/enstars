@extends('layouts.layout')

@section('title')
    @parent
    {{$blog->title}} | enstars.info
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9 post">
                <!-- Blog Post -->
                <!-- Title -->
                <h1>{!! $blog->title !!}</h1>
                <!-- Author and time -->
                <?php
                $nicedate = date('F d, Y', strtotime($blog->created_at));
                ?>
                <p>
                    Posted on {{$nicedate}} by {{$blog->author->name}}
                </p>
                <hr>
                <!-- Post Content -->
                <?php print $blog->content; ?>
                <hr>
                <div id="disqus_thread"></div>
                <script>

                    /**
                     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                    /*
                    var disqus_config = function () {
                    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    */
                    (function () { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = '//enstars-info.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                        powered by Disqus.</a></noscript>

            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
            </div>

        </div>
    </div>
@endsection
