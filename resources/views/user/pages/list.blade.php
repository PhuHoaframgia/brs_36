@extends('user.master')
@section('content')
<div class="freework" >
    <div class="col-lg-8" id="alert">
        @include('admin.block.fails')
    </div>
    <div class="cclear"></div>
    <h3 class="h3_list">{{ trans('book.category') }}: Novel </h3>
        @foreach ($books as $book)
            <div class="khung">
                <a href="">{{ Html::image('user/img/page3_pic2.jpg') }}</a>
                <div><a href="{!! URL::action('User\BookController@getDetail', $book->id) !!}">{{ $book->tittle }}</a></div>
                <p class="p_khung">{{ trans('book.author') }}: {{ $book->author->name }}</p>
                <p>{{ trans('book.number_of_likes') }}: {{ $book->num_pages }}</p>
                <p>{{ trans('book.rate') }}: {{ $book->rate_avg }} {{ Html::image('user/img/star.png') }}</p>
            </div>
        @endforeach
    <div class="cclear">
        {!! $books->render() !!}
    </div>
</div>
@endsection
@section('content1')
<div class="list timeacti">
    @include('user.blocks.time_follow')
</div>
@endsection



