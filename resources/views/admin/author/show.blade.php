@extends('layouts.admin_master')
@section('title', trans('author.author_show_detail_title'))
@section('header')
    <h1 class="page-header">{{ trans('author.author_detail') }}</h1>
@endsection
@section('content')
<div class="col-lg-8">
    <table class="table table-bordered table-striped">
        <td>
            <div class="form-group">
            {!! Form::label('id', trans('author.author_id')) !!}
            <p>{!! $author->id !!}</p>
        </div>

        <div class="form-group">
            {!! Form::label('name', trans('author.author_name')) !!}
            <p>{!! $author->name !!}</p>
        </div>

        <div class="form-group">
            {!! Form::label('created_at', trans('author.author_create_at')) !!}
            <p>{!! $author->created_at !!}</p>
        </div>

        <div class="form-group">
            {!! Form::label('updated_at', trans('author.author_update_at')) !!}
            <p>{!! $author->updated_at !!}</p>
        </div>
        <a href="{!! action('Admin\AuthorController@index') !!}" class="btn btn-default">{{ trans('author.author_back') }}</a>
        </td>
    </table>
</div>
@endsection
