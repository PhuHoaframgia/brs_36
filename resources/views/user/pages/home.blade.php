@extends('user.master')
@section('content')
<div class="freework">
    <div class="hide" data-route="{!! url('/home') !!}"></div>
    <article class="col-lg-3 col-md-3 col-sm-3 sm3">
        <div class="col-lg-12" id="alert">
            @include('admin.block.fails')
            @include('admin.block.success')
        </div>
        <div class="home_img" id="avatar">
            <img src="{{ $user->getAvatarPath() }}" alt="User Avatar">
        </div>
        <h3 class="home_img_h3">{{ trans('master.profile') }}</h3>
            @if (!$status)
                {!! Form::open(['class' => 'form-horizontal', 'action' => ['User\TimelineController@postFollow', $user->id]]) !!}
                    {!! Form::button(trans('master.follow'), ['class' => 'form-control', 'id' => $user->id]) !!}
                {!! Form::close() !!}
            @endif
        <h3 class="home_img_h3">{{ Html::image('user/img/prof.png','a picture', array('class' => 'imgleft')) }}{{ trans('master.profile') }}</h3>
        <div class="hide" data-route="{!! URL::action('User\TimelineController@getTimeline') !!}"></div>
        <div class="cclear"></div>
        <ul class="list2">
            <li><a >{{ trans('user.name') }}: {{ $user->name }}</a></li>
            <li><a >{{ trans('user.email')}}: {{ $user->email }}</a></li>
            <li><a >{{ trans('user.birthday') }}: {{ $user->birthday->format('Y-m-d') }}</a></li>
            <li>
                <a >
                    {{ $user->gender ? trans('user.male') : trans('user.female') }}
                </a>
            </li>
            <li><a >{{ trans('user.phone') }}: {{ $user->phone }}</a></li>
            <li><a >{{ trans('user.address') }}: {{ $user->address }}</a></li>
            @if ($user->id == Auth::user()->id)
                <a href="{!! action('User\UsersController@edit', $user->id) !!}"
                    class="btn btn-default btn-xs">{{ trans('user.edit_profile') }}</a>
            @endif
        </ul>
                <!-- FAVORITE BOOKS -->
        <h3 class="favor_h3">{{ Html::image('user/img/book.png','a picture', ['class' => 'imgleft']) }}{{ trans('master.favorite_book') }}</h3>
        <a href="#" class="amore">{{ trans('master.more') }}</a>
        <div class="cclear"></div>
        <div class="list_book">
            @foreach ($data['favorites'] as $favorite)
            <a href="#">
                <div class="bfollow">
                    {{ Html::image('user/img/' . $favorite['image']) }}
                    <p> {{ $favorite['tittle'] }} </p>
                </div>
            </a>
            @endforeach
        </div>
                <!-- END FAVORITE BOOKS -->
                <!-- LIST FOLLOW -->
        <h3 class="fo_h3">{{ Html::image('user/img/fl.png', 'a picture', ['class' => 'imgleft']) }}{{ trans('master.list_follow') }}</h3>
        <div class="list_follow" id="follow" >
            <div class="tbfollow" >
                {!! Form::open(['class' => 'form-horizontal']) !!}
                <table>
                    <tr>
                        <th class="th1"></th>
                        <th class="th_au"></th>
                        <th class="th_au"></th>
                    </tr>
                    @foreach ($data['followed'] as $follow)
                    <tr>
                        <td>{{ Html::image('user/img/' . $follow['image'], 'a picture', ['class' => 'imgfollow']) }}</td>
                        <td>
                            <a href="{{ action('User\TimelineController@getTimelineUser', $follow['id']) }}">{{ $follow['name'] }}</a>
                            <p> {{ $follow['countFollowed']}}
                                {{ trans('master.follower') }}
                            </p>
                            <p>
                                {{ trans('master.follow') }}
                                {{ $follow['countFollower']}} {{ trans('user.user') }}
                            </p>
                        </td>
                        <td>

                        </td>
                        <td>
                            @if ($follow['follower'] == Auth::user()->id)
                                {!! Form::button(trans('master.unfollow'), ['class' => 'clickOnChange', 'id' => $follow['id']]) !!}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
                {!! Form::close() !!}
            </div>
        </div>
    </article>
                <!-- END LIST FOLLOW -->
                <!-- TIME LINE -->
    <div class="timeline tl" id="timeline">
        @foreach($activities as $action)
            <div class="tline">
                <p> {{ $action['title'] }} </p>
                <div>
                    {{ Html::image('user/img/page3_pic6.jpg') }}
                    <div class="img1" >
                        <p>3</p>
                        {{ Html::image('user/img/rate.png') }}
                        <a href="" class="imga1">{{ Html::image('user/img/like2.png') }}{{ trans('book.unlike') }}</a>
                        <a href="">More</a>
                    </div>
                    <div class="binfo" >
                        <div class="cclear" ></div>
                            @if ($action['type'] == trans('message.follow') || $action['type'] == trans('message.comment'))
                                <table>
                                    <tr>
                                        <td colspan="2"><h2>Harry botter</h2></td>
                                    </tr>
                                </table>
                            @else
                                <table>
                                    <tr>
                                        <td colspan="2"><h2><a href ="#">{{ $action['content']->tittle }}</a></h2></td>
                                    </tr>
                                    <tr>
                                        <td>{{ Html::image('user/img/author.png', 'a picture', array('class' => 'iconinfo')) }}{{ trans('book.author') }}:</td>
                                        <td>{{ $action['content']->author->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ Html::image('user/img/cate.png', 'a picture', array('class' => 'iconinfo')) }}{{ trans('book.category') }}:</td>
                                        <td>{{ $action['content']->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ Html::image('user/img/clock.png', 'a picture', array('class' => 'iconinfo')) }}{{ trans('book.public_day') }}:</td>
                                        <td>{{ $action['content']->public_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ Html::image('user/img/number.png', 'a picture', array('class' => 'iconinfo')) }}{{ trans('book.number_of_likes') }}: </td>
                                        <td>{{ $action['content']->num_pages }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ Html::image('user/img/rate1.png', 'a picture', array('class' => 'iconinfo')) }}{{ trans('book.rate') }}: </td>
                                        <td>
                                            {{ Html::image('user/img/star.png', 'a picture', array('class' => 'starrate')) }}
                                            {{ Html::image('user/img/star.png', 'a picture', array('class' => 'starrate')) }}
                                            {{ Html::image('user/img/star.png', 'a picture', array('class' => 'starrate')) }}
                                            {{ Html::image('user/img/star.png', 'a picture', array('class' => 'starrate')) }}
                                            {{ Html::image('user/img/star.png', 'a picture', array('class' => 'starrate')) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="check" >{{ trans('book.mark_book_as_reading') }} </td>
                                        <td><input type="radio" name="check">{{ trans('book.mark_book_as_readed') }}</td>
                                    </tr>
                                </table>
                            @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('content1')
<div class="timeacti">
    @include('user.blocks.time_follow', ['activities' => $followActivities])
</div>
@endsection
