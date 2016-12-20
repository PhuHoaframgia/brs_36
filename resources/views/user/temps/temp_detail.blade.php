 <div>
    {{ Html::image('user/img/$review->user->image', 'a picture', ['class' => 'imgreview']) }}
    <div>
        <a class="ava_cmt">{{ $review->user->name }}</a> {{ $review->content }}
    </div>
    <div >
        <a class="a like_a_cm">{{ trans('book.like') }}</a>
        <a class="b like_a_cm" book-a="{{ $review->id }}" >{{ trans('book.comment') }}</a>
        <p class="p_date">{{ $review->created_at }}</p>
    </div>
    <div class="cclear"></div>
    <div class="show{{ $review->id }} show_cmt">
        @foreach ($review->comments as $comment)
            {{ Html::image('user/img/page3_pic4.jpg', 'a picture', ['class' => 'img_cmt']) }}
            <div>
                <a href="{{ action('User\TimelineController@getTimelineUser', $review->user->id) }}" class="show_name">{{ $comment->user->name }} </a> {{ $comment->content }}
            </div>
            <div class="ava_cmt1">
                <a class="like_cmt">{{ trans('book.like') }}</a>
                <p class="p_date_cmt">{{ $comment->created_at }} </p>
            </div>
            <div class="cclear"></div>
        @endforeach
        {{ Html::image('user/img/page3_pic1.jpg', 'a picture', ['class' => 'img_cmt']) }}
        <input type="text" name="txtcomment"  id="txtrv{{$review->id}}" id_review="{{ $review->id }}" class="input_cmt" placeholder="{{ trans('book.write_comment_here') }}...">
    </div>
</div>
<div class="clear_mer"></div>