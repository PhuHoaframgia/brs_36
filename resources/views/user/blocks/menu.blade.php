<div class="row">
    <article class="col-lg-12 col-md-12 col-sm-12">
        <header class="clearfix">
            <h1 class="navbar-brand navbar-brand_"><a href="#">{{ Html::image('user/img/logo.png') }}</a></h1>
            <div class="menuBox clearfix">
                <nav class="navbar navbar-default navbar-static-top tm_navbar clearfix" role="navigation">
                    <ul class="nav sf-menu clearfix sf-js-enabled sf-arrows">
                        <li class="active"><a>{{ trans('master.home') }}</a></li>
                        <li class="sub-menu">{{ trans('master.category') }}
                            <ul class="submenu sub-menu" >
                                @if (!$categoryMaster)
                                    <li><a>{{ trans('book.dont_have') }}</a></li>
                                @else
                                    @foreach ($categoryMaster as $category)
                                        <li><a href="">{{ $category->name }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li><a href="#">{{ trans('master.history') }}</a></li>
                        <li><a href="#">{{ trans('master.request') }}</a></li>
                    </ul>
                </nav>
            </div>
            <ul class="head_list">
                <li><a href="#">{{ trans('master.logout') }} </a></li>
            </ul>
        </header>
    </article>
</div>
