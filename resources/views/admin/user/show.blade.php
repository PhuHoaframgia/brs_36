@extends('layouts.admin_master')
@section('title', trans('user.user_show_detail_title'))
@section('header')
    <h1 class="page-header">{{ trans('user.user_detail') }}</h1>
@endsection
@section('content')
<div class="col-lg-8">
    <table class="table table-bordered table-striped">
        <td>
            <div class="form-group">
            {!! Form::label('id', trans('user.user_id')) !!}
            <p>{!! $user['id'] !!}</p>
            </div>

            <div class="form-group">
                {!! Form::label('name', trans('user.name')) !!}
                <p>{!! $user['name'] !!}</p>
            </div>

            <div class="form-group">
                {!! Form::label('email', trans('user.email')) !!}
                <p>{!! $user['email'] !!}</p>
            </div>

            <div class="form-group">
                {!! Form::label('phone', trans('user.phone')) !!}
                <p>{!! $user['phone'] !!}</p>
            </div>

            <div class="form-group">
                {!! Form::label('address', trans('user.address')) !!}
                <p>{!! $user['address'] !!}</p>
            </div>

            <div class="form-group">
                {!! Form::label('image', trans('user.avatar')) !!}
                <img src="{{ $user->image }}" class="img-responsive" alt="User Avatar">
            </div>

            <div class="form-group">
                {!! Form::label('created_at', trans('user.user_create_at')) !!}
                <p>{!! $user['created_at'] !!}</p>
            </div>

            <div class="form-group">
                {!! Form::label('updated_at', trans('user.user_update_at')) !!}
                <p>{!! $user['updated_at'] !!}</p>
            </div>
            <a href="{!! action('Admin\UserController@index') !!}" class="btn btn-default">{{ trans('user.user_back') }}</a>
        </td>
    </table>
</div>
@endsection
