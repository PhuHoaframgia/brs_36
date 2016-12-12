<html lang="en">
    <head>
        <title>{{ trans('master.home') }}</title>
        <meta charset="utf-8">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <meta name="description" content="Your description">
        <meta name="keywords" content="Your keywords">
        <meta name="author" content="Your name">
        <meta name="format-detection" content="telephone=no">
        <!--CSS-->
        {{ Html::style('user/css/bootstrap.css') }}
        {{ Html::style('user/css/mystyle.css') }}
        {{ Html::style('user/css/style.css') }}
        {{ Html::style('user/css/tm_docs.css') }}
        {{ Html::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js') }}
        {{ Html::script('/user/js/myscript.js') }}
    </head>
<!--header-->

<body>
    <div class="container">
        @include('user.blocks.menu')
    </div>
    <div class="global">
        <div class="container">
            @yield('content')
            <!-- contain activity follower -->
            <div class="containt_acti_follower" >
                <div class="divsearch">
                    <form id="fsearch" action="search.php" method="GET" accept-charset="utf-8">
                        <input type="text" name="" placeholder="{{ trans('master.search') }}...">
                        <a href="#">{{ Html::image('user/img/magnify.png') }}</a>
                    </form>
                </div>
                @yield('content1')
            </div>
            <!-- end contain activity follower -->
        </div>
    </div>
   <!-- footer -->
    <div class="container">
        @include('user.blocks.footer')
    </div>
</body>
</html>
