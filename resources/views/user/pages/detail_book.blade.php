@extends('user.master')
@section('content')
<div class="detail freework" >
    <div class="detailbook">
        <div class="khung1" >
            {{ Html::image('user/img/$book->image') }}
            <div class="inforbook" >
                <h2>{{ $book->tittle }}</h2>
                <button id ="bt" idbv="{{ $book->id }}">{{ trans('book.unlike') }}</button>
                {{ Html::image('user/img/like1.png') }}
                <div class="cclear"></div>
                <table>
                    <tr>
                        <td>{{ trans('book.author') }}:</td>
                        <td>{{ $book->author->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('book.category') }}:</td>
                        <td>{{ $book->category->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('book.public_day') }}:</td>
                        <td>{{ $book->public_date }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('book.number_of_likes') }}: </td>
                        <td>45</td>
                    </tr>
                    <tr>
                        <td>{{ trans('book.rate') }}: </td>
                        <td>
                            @foreach (range(1, $book->rate_avg) as $rate )
                                {{ Html::image('user/img/star.png', 'a picture', ['class' => 'star']) }}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="check" >{{ trans('book.mark_book_as_reading') }} </td>
                        <td><input type="radio" name="check" >{{ trans('book.mark_book_as_readed') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <h2> {{ trans('book.content') }}</h2>
        <div class="khung2">
            {{ $book->content }}
        </div>
        <h2 class="wri_review">{{ trans('book.write_review') }}</h2>
        <fieldset class="fs_review">
            @foreach ($book->reviews as $review)
                <div>
                    {{ Html::image('user/img/$review->user->image', 'a picture', ['class' => 'imgreview']) }}
                    <div>
                        <a class="ava_cmt">{{ $review->user->name }}</a> {{ $review->content }}
                    </div>
                    <div >
                        <a class="a like_a_cm">{{ trans('book.like') }}</a>
                        <a class="b like_a_cm" data-a="{{ $review->id }}" >{{ trans('book.comment') }}</a>
                        <p class="p_date">{{ $review->created_at }}</p>
                    </div>
                    <div class="cclear"></div>
                    <div class="show{{ $review->id }} show_cmt">
                        @foreach ($review->comments as $cmt)
                            {{ Html::image('user/img/page3_pic4.jpg', 'a picture', ['class' => 'img_cmt']) }}
                            <div>
                                <a href="" class="show_name">{{ $cmt->user->name }} </a> {{ $cmt->content }}
                            </div>
                            <div class="ava_cmt1">
                                <a class="like_cmt">{{ trans('book.like') }}</a>
                                <p class="p_date_cmt">{{ $cmt->created_at }} </p>
                            </div>
                            <div class="cclear"></div>
                        @endforeach
                        {{ Html::image('user/img/page3_pic1.jpg', 'a picture', ['class' => 'img_cmt']) }}
                        <input type="text" name="txtContent" id ="txtContent" class="input_cmt" placeholder="{{ trans('book.write_comment_here') }}...">
                    </div>
                </div>
                <div class="clear_mer"></div>
            @endforeach
            <div>
                {{ Html::image('user/img/page3_pic3.jpg', 'a picture', ['class' => 'imgreview']) }}
                <input type="text" name="txtContent" id="txtContent" class="input_review" placeholder="{{ trans('book.write_request_here') }}...">
            </div>
        </fieldset>
    </div>
</div>
@endsection
@section('content1')
<div class="detail timeacti">
    @include('user.blocks.time_follow')
</div>
@endsection
