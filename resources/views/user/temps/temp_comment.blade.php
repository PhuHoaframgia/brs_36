<div id="cont_cm{{ $comment->id }}">
    {{ Html::image($comment->user->getAvatarPath(), 'a picture', ['class' => 'img_cmt']) }}
    <div class="contain_cm{{ $comment->id }}" >
        <a href="{{ action('User\TimelineController@getTimelineUser', $comment->user->id) }}" class="show_name" >
            {{ $comment->user->name }}
        </a> 
        <span class="content{{ $comment->id }}" >
            {{ $comment->content }}
        </span>
    </div>
    <div class="edit_cm{{ $comment->id }} edit">
        <input type="text" name="txtedit" class="input_edit" value="{{ $comment->content }}"> 
        <a class="Cancle" idComment="{{ $comment->id }}">Cancle</a>
    </div>
    <div class="ava_cmt1" id="comment{{ $comment->id }}">
        <a class="like_cmt">{{ trans('book.like') }}</a>
        <p class="p_date_cmt">{{ $comment->created_at }}</p>
        <a class="comment glyphicon glyphicon-remove" idComment="{{ $comment->id }}"></a>
        <a class="comment glyphicon glyphicon-pencil"></a>
    </div>
    <div class="cclear"></div>
</div>