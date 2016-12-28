@extends('user.master')
@section('content')
<div class="freework" >
    <h3 class="h3_list">{{ trans('book.category') }}: {{ $categoryMaster[$categoryId]->name }} </h3>
    @forelse ($books as $book)
        <div class="khung">
            <a href="{!! action('User\BookController@getDetail', $book->id) !!}">
                {{ Html::image($book->getImagePath()) }}
            </a>
            <div><a href="{!! action('User\BookController@getDetail', $book->id) !!}">{{ $book->tittle }}</a></div>
            <p class="p_khung">{{ trans('book.author') }}: {{ $book->author->name }}</p>
            <p>{{ trans('book.number_of_likes') }}: {{ $book->num_pages }}</p>
            <p>{{ trans('book.rate') }}: {{ $book->rate_avg }} {{ Html::image('user/img/star.png') }}</p>
        </div>
    @empty
        {{ trans('book_request.dont_have') }}
    @endforelse
    <div class="cclear">
        {!! $books->render() !!}
    </div>
</div>
@endsection
@section('content1')
<div class="list timeacti">
    @include('user.blocks.time_follow', ['activities' => $followActivities])
</div>
@endsection



