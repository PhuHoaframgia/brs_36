@extends('user.master')
@section('content')
<div class="freework">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('user.profile') }}</div>
                <div class="panel-body">
                    {!! Form::model(
                        $user, 
                        [
                            'action' => ['User\UsersController@update', $user->id], 
                            'class' => 'form-horizontal', 
                            'method' => 'PUT', 
                            'enctype' => 'multipart/form-data',
                        ]
                    ) !!}

                        <div class="form-group">
                            {!! Form::label('image', trans('user.curent_avatar'), ['class' => 'col-md-6 control-label']) !!}
                            <img src="{{ $user->getAvatarPath() }}"  alt="User Avatar">
                        </div>

                        <div class="form-group">
                             {{ Form::label('image', trans('user.avatar'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::file('image') }}

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                             {{ Form::label('name', trans('user.name'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('name', null, ['class' => 'form-control']) }}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                             {{ Form::label('email', trans('user.email'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::email('email', null, ['class' => 'form-control', 'name' => 'email']) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                             {{ Form::label('password', trans('auth.password'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                 {{ Form::password('password', ['class' => 'form-control', 'name' => 'password']) }}
                                 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('password-confirm', trans('auth.confirm_password'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::password('password', ['class' => 'form-control', 'name' => 'password_confirmation']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('gender', trans('user.gender'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::label('gender', trans('user.male')) !!}
                                {!! Form::radio('gender', '0', true) !!}
                                {!! Form::label('gender', trans('user.female')) !!}
                                {!! Form::radio('gender', '1') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('birthday', trans('auth.birthday'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::date('birthday', \Carbon\Carbon::now(), ['class' => 'form-control']); !!}

                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('phone', trans('user.phone'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('user.phone'),'rows' => 3]) !!}

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('address', trans('user.address'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('address', null, 
                                    ['class' => 'form-control', 'placeholder' => trans('user.address') ,'rows' => 3]
                                ) !!}

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                     <i class="fa fa-btn fa-user"></i> {{ trans('user.save') }}
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content1')
    <div class="timeacti">
        @include('user.blocks.time_follow')
    </div>
@endsection
