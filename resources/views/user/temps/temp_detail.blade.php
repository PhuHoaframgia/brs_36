<div>
    {{ Html::image($review->user->getAvatarPath(), 'a picture', ['class' => 'imgreview']) }}
    <div class="div_review">
        <div>
            <a 
                href="{{ action('User\TimelineController@getTimelineUser', $review->user->id) }}" 
                class="ava_cmt">
                {{ $review->user->name }}
            </a> 
            {{ $review->content }}
        </div>
        <div >
            <a class="a like_a_cm">{{ trans('book.like') }}</a>
            <a class="b like_a_cm" book-a="{{ $review->id }}" >{{ trans('book.comment') }}</a>
            @if ( Auth::user()->id == $review->user->id )
                <a class="glyphicon glyphicon-remove"></a>
                <a class="glyphicon glyphicon-pencil"></a>
            @endif
            <p class="p_date">{{ $review->created_at }}</p>
        </div>
        <div class="cclear"></div>
        <div class="show{{ $review->id }} show_cmt">
            @foreach ($review->comments as $comment)
                {{ Html::image($comment->user->getAvatarPath(), 'a picture', ['class' => 'img_cmt']) }}
                <div>
                    <a href="{{ action('User\TimelineController@getTimelineUser', $comment->user->id) }}" class="show_name">
                        {{ $comment->user->name }} 
                    </a> 
                    {{ $comment->content }}
                </div>
                <div class="ava_cmt1" id="comment{{ $comment->user->id }}">
                    <a class="like_cmt">{{ trans('book.like') }}</a>
                    @if ( Auth::user()->id == $review->user->id )
                        <a class="glyphicon glyphicon-remove" idComment="{{ $comment->id }}" ></a>
                        <a class="glyphicon glyphicon-pencil"></a>
                    @endif
                    <p class="p_date_cmt">{{ $comment->created_at }} </p>
                </div>
                <div class="cclear"></div>
            @endforeach
            <div id="temp_comment{{ $review->id }}">
                {{ Html::image(Auth::user()->getAvatarPath(), 'a picture', ['class' => 'img_cmt']) }}
                <input 
                    type="text" 
                    name="txtcomment" 
                    id="txtrv{{ $review->id }}" 
                    id_review="{{ $review->id }}" 
                    class="input_cmt" 
                    placeholder="{{ trans('book.write_comment_here') }}..."
                >
            </div>
        </div>
    </div>
</div>
<div class="clear_mer"></div>