@extends('layouts.admin_master')
@section('title', trans('user.user_create_title'))
@section('header')
    <h1 class="page-header">{!! trans('user.add_user') !!}</h1>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    {!! Form::open(['action' => 'Admin\UserController@store', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        @include('admin.user.field')
        
    {!! Form::close() !!}
</div>
@endsection
