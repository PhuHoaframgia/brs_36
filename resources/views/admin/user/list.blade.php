@extends('layouts.admin_master')
@section('title', trans('user.user_list_title'))
@section('header')
    <h1 class="page-header">{{ trans('user.list_user') }}</h1>
@endsection

@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-12">
    <table class="table table-responsive table-hover" id="">
        <thead>
            <tr>
                <th class="text-center">{{ trans('user.user_id') }}</th>
                <th class="text-center">{{ trans('user.name') }}</th>
                <th class="text-center">{{ trans('user.gender') }}</th>
                <th class="text-center">{{ trans('user.address') }}</th>
                <th class="text-center">{{ trans('user.phone') }}</th>
                <th class="text-center">{{ trans('user.role') }}</th>
                <th class="text-center">{{ trans('user.avatar') }}</th>
                <th class="text-center" style="width: 90px;">{{ trans('user.user_action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="odd gradeX text-center">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->gender ? trans('user.male') : trans('user.female') }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->role ? trans('user.admin') : trans('user.user') }} </td>
                    <td><span></span><img src="{{  $user->getAvatarPath() }}" width="80px" height="50px"></span></td>
                    <td>
                        {!! Form::open(['action' => ['Admin\UserController@destroy', $user->id], 'method' => 'DELETE']) !!}
                        <div class="btn-group">
                            <a href="{!! action('Admin\UserController@show', $user->id) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{!! action('Admin\UserController@edit', $user->id) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("' . trans('user.user_comfirm_delete') . '")']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-lg-12 col-lg-offset-9">
        {!! $users->render(); !!}
    </div>
</div>
@endsection
