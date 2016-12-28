<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Book Review System">
    <meta name="author" content="Tran Thanh An">
    <title>@yield('title')</title>

    {!! Html::style('bower/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! Html::style('bower/metisMenu/dist/metisMenu.min.css') !!}
    {!! Html::style('bower/dist/css/sb-admin-2.css') !!}
    {!! Html::style('bower/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('bower/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') !!}
    {!! Html::style('bower/datatables-responsive/css/dataTables.responsive.css') !!}
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">{{ trans('general.page_head') }}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>{{ Auth::user()->name }}<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{!! action('Admin\UserController@edit', $user->id) !!}"><i class="fa fa-user fa-fw"></i>{{ trans('user.edit_profile') }}</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{!! action('Auth\LoginController@logout') !!}"><i class="fa fa-sign-out fa-fw"></i> {{ trans('user.logout') }}</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i>{{ trans('general.dashboard') }}</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>{{ trans('category.category') }}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! action('Admin\CategoryController@index') !!}">{{ trans('category.list_category') }}</a>
                                </li>
                                <li>
                                    <a href="{!! action('Admin\CategoryController@create') !!}">{{ trans('category.category_create_title') }}</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i>{{ trans('book.book') }}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! action('Admin\BookController@index') !!}">{{ trans('book.list_book') }}</a>
                                </li>
                                <li>
                                    <a href="{!! action('Admin\BookController@create') !!}">{{ trans('book.add_book') }}</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i>{{ trans('user.user') }}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! action('Admin\UserController@index') !!}">{{ trans('user.list_user') }}</a>
                                </li>
                                <li>
                                    <a href="{!! action('Admin\UserController@create') !!}">{{ trans('user.add_user') }}</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i>{{ trans('author.author') }}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! action('Admin\AuthorController@index') !!}">{{ trans('author.list_author') }}</a>
                                </li>
                                <li>
                                    <a href="{!! action('Admin\AuthorController@create') !!}">{{ trans('author.add_author') }}</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file fa-fw"></i>{{ trans('review.review') }}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! action('Admin\ReviewController@index') !!}">{{ trans('review.list_review') }}</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-share fa-fw"></i>{{ trans('book_request.book_request') }}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! action('Admin\BookRequestController@index') !!}">{{ trans('book_request.list_request') }}</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('header')
                    </div>
                    <div class="col-lg-8" id="alert">
                        @include('admin.block.fails')
                        @include('admin.block.success')
                    </div>
                    <div class="col-lg-8" id="alert">
                        @include('includes.error')
                    </div>
                    @yield('content')
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    {!! Html::script('bower/jquery/dist/jquery.min.js') !!}
    {!! Html::script('bower/bootstrap/dist/js/bootstrap.min.js') !!}

    {!! Html::script('bower/metisMenu/dist/metisMenu.min.js') !!}

    {!! Html::script('bower/dist/js/sb-admin-2.js') !!}
    {!! Html::script('bower/DataTables/media/js/jquery.dataTables.min.js') !!}

    {!! Html::script('bower/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') !!}

    {!! Html::script('js/request.js') !!}

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    $('div.alert').delay(2000).slideUp();
    </script>
</body>
</html>
