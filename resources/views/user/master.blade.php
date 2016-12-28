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
        {{ Html::style('/bower/bootstrap/dist/css/bootstrap.css') }}
        {{ Html::style('user/css/mystyle.css') }}
        {{ Html::style('user/css/style.css') }}
        {{ Html::style('user/css/tm_docs.css') }}
        {{ Html::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js') }}
        {{ Html::script('/user/js/myscript.js') }}
        {{ Html::script('/js/timelinescript.js') }}
        {{ Html::script('/js/jquery.json2html.js') }}
        {{ Html::script('/js/json2html.js') }}
        {{ Html::script('/user/js/delay.js') }}
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
                    {!! Form::open([
                        'name' => 'search',
                        'class' => 'form-horizontal',
                        'id' => 'fsearch',
                        'action' => 'User\SearchController@search',
                        'method' => 'GET',
                    ])
                    !!}
                        {!! Form::text('search', '', ['class' => 'form-control', 'placeholder' => trans('master.search')]) !!}
                    {!! Form::close() !!}
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
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
</html>
