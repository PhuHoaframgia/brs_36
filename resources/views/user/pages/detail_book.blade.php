@extends('user.master')
@section('content')
<div class="detail freework" >
    <div class="detailbook">
        <div class="khung1" >
            {{ Html::image($data['book']->getImagePath()) }}
            <div class="inforbook" >
                <h2>{{ $data['book']->tittle }}</h2>
                <input type="hidden" idtoken="{{ csrf_token() }}" class="gettoken" />
                <div class="hide" data-route="{!! url('/home') !!}" data-user-id="{{ Auth::user()->id }}"></div>
                @if ($data['haveLike'] == false)
                    <input type="button" id ="bt" idbv="{{ $data['book']->id }}" value="Mark favorite"  >
                @else
                    <input type="button" id ="bt" idbv="{{ $data['book']->id }}" value="Remove favorite mark"  >
                @endif
                <table>
                    <tr>
                        <td>{{ trans('book.author') }}:</td>
                        <td>{{ $data['book']->author->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('book.category') }}:</td>
                        <td>{{ $data['book']->category->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('book.public_day') }}:</td>
                        <td>{{ $data['book']->public_date }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('book.number_of_likes') }}: </td>
                        <td>{{ $data['book']->num_pages }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('book.rate') }}: </td>
                        <td>
                            <div class="div_rate">
                                @if ( $data['rateBook'] == false )
                                    @foreach (range(1, 5) as $key )
                                        <a class="glyphicon glyphicon-star" id="star{{ $key }}" idbv="{{ $data['book']->id }}" starNumber="{{ $key }}"></a>
                                    @endforeach
                                @else
                                    @foreach (range(1, 5) as $key )
                                        <a 
                                            class="glyphicon glyphicon-star{{ ($key <=  $data['rateBook']) ? ' green' : ''}}" 
                                            id="star{{ $key }}" 
                                            idbv="{{ $data['book']->id }}" 
                                            starNumber="{{ $key }}"
                                        >
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        @if($data['markbook'] == false)
                            <td>
                                <input type="radio" name="mask" value="1" idbv="{{ $data['book']->id }}" >{{ trans('book.mark_book_as_reading') }} 
                            </td>
                            <td>
                                <input type="radio" name="mask" value="2" idbv="{{ $data['book']->id }}" >{{ trans('book.mark_book_as_readed') }}
                            </td>
                        @else
                            @if ($data['markbook'] == 1)
                                <td>
                                    <input type="radio" name="mask" checked="checked" value="1" idbv="{{ $data['book']->id }}" >{{ trans('book.mark_book_as_reading') }}
                                </td>
                                <td>
                                    <input type="radio" name="mask" value="2" idbv="{{ $data['book']->id }}" >{{ trans('book.mark_book_as_readed') }}
                                </td>
                            @else 
                                <td>
                                    <input type="radio" name="mask"  value="1" idbv="{{ $data['book']->id }}" >{{ trans('book.mark_book_as_reading') }}
                                </td>
                                <td>
                                    <input type="radio" checked="checked" name="mask" value="2" idbv="{{ $data['book']->id }}" >{{ trans('book.mark_book_as_readed') }}
                                </td>
                            @endif
                        @endif
                    </tr>
                </table>
            </div>
        </div>
        <h2> {{ trans('book.content') }}</h2>
        <div class="khung2">
            {{ $data['book']->content }}
        </div>
        <h2 class="wri_review">{{ trans('book.write_review') }}</h2>
        <fieldset class="fs_review">
            @foreach ($data['book']->reviews as $review)
                <div id="cont_review{{ $review->id }}">
                    {{ Html::image($review->user->getAvatarPath(), 'a picture', ['class' => 'imgreview']) }}

                    <div class="edit_rv{{ $review->id }} edit_rv">
                        <input 
                            type="text" 
                            name="editReview" 
                            value="{{ $review->content }}" 
                            class="editrv content-review{{ $review->id }}" 
                            id="{{ $review->id }}"
                        >
                        <a class="esc" idReview="{{ $review->id }}">Cancle</a>
                    </div>

                    <div class="div_review" id="review{{ $review->id }}">
                        <div>
                            <a href="{{ action('User\TimelineController@getTimelineUser', $review->user->id) }}" class="ava_cmt">
                                {{ $review->user->name }}
                            </a>
                            <span class="ctReview{{ $review->id }}">
                                {{ $review->content }}
                            </span> 
                        </div>
                        <div >
                            <a class="a like_a_cm">{{ trans('book.like') }}</a>
                            <a class="b like_a_cm" book-a="{{ $review->id }}" >{{ trans('book.comment') }}</a>
                            <p class="p_date">{{ $review->created_at }}</p>
                            @if ( Auth::user()->id == $review->user->id )
                                <a class="review glyphicon glyphicon-remove" idReview="{{ $review->id }}"></a>
                                <a class="review glyphicon glyphicon-pencil"></a>
                            @endif
                        </div>
                        <div class="cclear"></div>
                        <div class="show{{ $review->id }} show_cmt">
                            @foreach ($review->comments as $comment)
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
                                        @if ( Auth::user()->id == $review->user->id )
                                            <a class="comment glyphicon glyphicon-remove" idComment="{{ $comment->id }}"></a>
                                            <a class="comment glyphicon glyphicon-pencil"></a>
                                        @endif
                                    </div>
                                    <div class="cclear"></div>
                                </div>
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
                <div class="clear_mer" id="cont_review review{{ $review->id }}"></div>
            @endforeach
            <div id="reviewhere">
                {{ Html::image(Auth::user()->getAvatarPath(), 'a picture', ['class' => 'imgreview']) }}
                <input 
                    type="text" 
                    name="txtreview" 
                    class="input_review" 
                    idbv="{{ $data['book']->id }}"
                    placeholder="{{ trans('book.write_review_here') }}..."
                >
            </div>
        </fieldset>
    </div>
</div>
@endsection
@section('content1')
<div class="detail timeacti">
    @include('user.blocks.time_follow', ['activities' => $followActivities])
</div>
@endsection
