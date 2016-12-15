@extends('layouts.admin_master')
@section('title', trans('author.author_create_title'))
@section('header')
    <h1 class="page-header">{{ trans('author.create_author') }}</h1>
@endsection
@section('content')
<div class="col-lg-7">
    {!! Form::open(
        [
            'action' => 'Admin\AuthorController@store', 
            'method' => 'POST', 
            'class' => 'form-horizontal',
        ]
    ) !!}

        @include('admin.author.fields')

    {!! Form::close() !!}
</div>
@endsection
