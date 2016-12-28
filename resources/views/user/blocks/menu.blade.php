<div class="row">
    <article class="col-lg-12 col-md-12 col-sm-12">
        <header class="clearfix">
            <h1 class="navbar-brand navbar-brand_"><a href="#">{{ Html::image('user/img/logo.png') }}</a></h1>
            <div class="menuBox clearfix">
                <nav class="navbar navbar-default navbar-static-top tm_navbar clearfix" role="navigation">
                    <ul class="nav sf-menu clearfix sf-js-enabled sf-arrows">
                        <li><a href="{!! URL::action('User\TimelineController@getTimeline') !!}">{{ trans('master.home') }}</a></li>
                        <li class="sub-menu">{{ trans('master.category') }}
                            <ul class="submenu sub-menu">
                                @forelse ($categoryMaster as $category)
                                    <li><a href="{!! URL::action('User\BookController@show', $category->id) !!}">{{ $category->name }}</a></li>
                                @empty
                                    <li><a>{{ trans('book.dont_have') }}</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li><a href="{!! URL::action('User\RequestController@index') !!}">{{ trans('master.request') }}</a></li>
                    </ul>
                </nav>
            </div>
            <ul class="head_list">
                <li><a href="{!! URL::action('Auth\LoginController@logout') !!}">{{ trans('master.logout') }} </a></li>
            </ul>
        </header>
    </article>
</div>
