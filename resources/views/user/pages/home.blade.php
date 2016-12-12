@extends('user.master')
@section('content')
<div class="freework">
    <article class="col-lg-3 col-md-3 col-sm-3 sm3">
        {{ Html::image('user/img/page1_pic6.jpg', 'a picture', ['class' => 'home_img']) }}
        <h3 class="home_img_h3">{{ Html::image('user/img/prof.png', 'a picture', ['class' => 'imgleft']) }}{{ trans('master.profile') }}</h3>
        <a href="#" class="edit_follow">{{ trans('master.update') }}</a>
        <div class="cclear"></div>
        <ul class="list2">
            <li><a href="#">{{ trans('user.name') }}: Huynh Minh Tri</a></li>
            <li><a href="#">{{ trans('user.birthday') }}: 19/11/1995</a></li>
            <li><a href="#">{{ trans('user.gender') }}: Male</a></li>
            <li><a href="#">{{ trans('user.phone') }}: 01212152770</a></li>
            <li><a href="#">{{ trans('user.address') }}: Thanh Khue, Da Nang</a></li>
        </ul>
                <!-- FAVORITE BOOKS -->
        <h3 class="favor_h3">{{ Html::image('user/img/book.png', 'a picture', ['class' => 'imgleft']) }}{{ trans('master.favorite_book') }}</h3>
        <a href="#" class="amore">{{ trans('master.more') }}</a>
        <div class="cclear"></div>
        <div class="list_book">
            <a href="#">
                <div class="bfollow">
                    {{ Html::image('user/img/page1_pic2.jpg') }}
                    <p> Nhung nguoi khon kho </p>
                </div>
            </a>
            <a href="#">
                <div class="bfollow">
                    {{ Html::image('user/img/page1_pic2.jpg') }}
                    <p> Nhung nguoi khon kho </p>
                </div>
            </a>
        </div>
                <!-- END FAVORITE BOOKS -->
                <!-- LIST FOLLOW -->
        <h3 class="fo_h3">{{ Html::image('user/img/fl.png', 'a picture', ['class' => 'imgleft']) }}{{ trans('master.list_follow') }}</h3>
        <div class="list_follow" >
            <div class="tbfollow" >
                <table>
                    <tr>
                        <th class="th1"></th>
                        <th class="th_au"></th>
                        <th class="th_au"></th>
                    </tr>
                    <tr>
                        <td>{{ Html::image('user/img/page1_pic6.jpg', 'a picture', ['class' => 'imgfollow']) }}</td>
                        <td><a href="">minh hoang </a><p> 23 {{ trans('master.follower') }}</p></td>
                        <td><button>{{ trans('master.unfollow') }}</button> </td>
                    </tr>
                    <tr>
                        <td>{{ Html::image('user/img/page1_pic6.jpg', 'a picture', ['class' => 'imgfollow']) }}</td>
                        <td><a href="">minh hoang </a><p> 23 {{ trans('master.follower') }}</p></td>
                        <td><button>{{ trans('master.unfollow') }}</button> </td>
                    </tr>
                </table>
            </div>
        </div>
    </article>
                <!-- END LIST FOLLOW -->
                <!-- TIME LINE -->
    <div class="timeline">
        <h2>{{ trans('master.time_line') }}</h2>
        <div class="timecontent" >
            <table>
                <tr>
                    <th class="th1"></th>
                    <th class="th2"></th>
                    <th class="th_au"></th>
                    <th class="th1"></th>
                </tr>
                <tr>
                    <td>{{ Html::image('user/img/like3.png', 'a picture', ['class' => 'hlike']) }}</td>
                    <td>You likes hong dao's </td>
                    <td>Đừng cố gắng kéo một sợi dây {{ Html::image('user/img/page3_pic1.jpg', 'a picture', ['class' => 'hbook']) }}</td>
                    <td>{{ Html::image('user/img/option.png', 'a picture', ['class' => 'hoption']) }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
@section('content1')
<div class="timeacti">
    @include('user.blocks.time_follow')
</div>
@endsection
