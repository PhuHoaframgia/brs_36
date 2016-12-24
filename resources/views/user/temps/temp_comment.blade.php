{{ Html::image('user/img/$comment->user->image', 'a picture', ['class' => 'img_cmt']) }}
<div>
    <a href="{{ action('User\TimelineController@getTimelineUser', $comment->user->id) }}" class="show_name">{{ $comment->user->name }} </a> {{ $comment->content }}
</div>
<div class="ava_cmt1">
    <a class="like_cmt">{{ trans('book.like') }}</a>
    <p class="p_date_cmt">{{ $comment->created_at }} </p>
</div>
<div class="cclear"></div>