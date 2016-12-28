@extends('user.master')
@section('content')
<div class="detail freework" >
    <div class="detailbook">
        <div class="khung1" >
            {{ Html::image($data['book']->getImagePath()) }}
            <div class="inforbook" >
                <h2>{{ $data['book']->tittle }}</h2>
                <input type="hidden" idtoken="{{ csrf_token() }}" class="gettoken" />
                <div class="hide" data-route="{!! url('/home') !!}"></div>
                @if (!$data['haveLike'])
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
                                        <a class="glyphicon glyphicon-star{{ ($key <=  $data['rateBook']) ? ' green' : ''}}" id="star{{ $key }}" idbv="{{ $data['book']->id }}" starNumber="{{ $key }}"></a>
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
                                    <input type="radio" name="mask" checked="checked" value="1" idbv="{{ $data['book']->id }}" >{{ trans('book.mark_book_as_reading') }} </td>
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
                <div>
                    {{ Html::image($review->user->getAvatarPath(), 'a picture', ['class' => 'imgreview']) }}
                    <div class="div_review">
                        <div>
                            <a href="{{ action('User\TimelineController@getTimelineUser', $review->user->id) }}" class="ava_cmt">
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
