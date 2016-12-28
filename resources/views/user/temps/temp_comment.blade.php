{{ Html::image($comment->user->getAvatarPath(), 'a picture', ['class' => 'img_cmt']) }}
<div>
    <a href="{{ action('User\TimelineController@getTimelineUser', $comment->user->id) }}" class="show_name">
    	{{ $comment->user->name }} 
    </a> 
    {{ $comment->content }}
</div>
<div class="ava_cmt1" id="comment{{ $comment->user->id }}">
    <a class="like_cmt">{{ trans('book.like') }}</a>
    <a class="glyphicon glyphicon-remove" idComment="{{ $comment->id }}" ></a>
    <a class="glyphicon glyphicon-pencil"></a>
    <p class="p_date_cmt">{{ $comment->created_at }} </p>
</div>
<div class="cclear"></div>