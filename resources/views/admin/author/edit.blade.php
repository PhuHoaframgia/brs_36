@extends('layouts.admin_master')
@section('title', trans('author.author_edit_title'))
@section('header')
    <h1 class="page-header">{{ trans('author.author_edit') }}</h1>
@endsection
@section('content')
<div class="col-lg-7">
    {!! Form::model($author, 
        [
            'action' => ['Admin\AuthorController@update', $author->id], 
            'method' => 'PUT',
        ]
    ) !!}

        @include('admin.author.fields')

    {!! Form::close() !!}
</div>
@endsection
