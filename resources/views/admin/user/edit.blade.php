@extends('layouts.admin_master')
@section('title', trans('user.user_edit_title'))
@section('header')
    <h1 class="page-header">{!! trans('user.edit_user') !!}</h1>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    {!! Form::model(
        $user, 
        [
            'action' => ['Admin\UserController@update', $user->id], 
            'class' => 'form-horizontal', 
            'method' => 'PUT', 
            'enctype' => 'multipart/form-data',
        ]
    ) !!}

        @include('admin.user.field')

    {!! Form::close() !!}
</div>
@endsection
