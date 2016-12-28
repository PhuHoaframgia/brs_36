<div class="form-group">
    {!! Form::label('name', trans('user.user_name'), ['class' => 'col-lg-3 control-label']) !!}
    <div class="col-lg-7">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('user.user_name'), 'rows' => 3]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('gender', trans('user.gender'), ['class' => 'col-lg-3 control-label']) !!}
    <div class="col-lg-7">
        {!! Form::label('gender', trans('user.male')) !!}
        {!! Form::radio('gender', '0', true) !!}
        {!! Form::label('gender', trans('user.female')) !!}
        {!! Form::radio('gender', '1') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('birthday', trans('user.birthday'), ['class' => 'col-lg-3 control-label']) !!}
    <div class="col-lg-4">
        {!! Form::date('birthday', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', trans('user.email'), ['class' => 'col-lg-3 control-label']) !!}
    <div class="col-lg-7">
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('user.email')]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password', trans('user.password'), ['class' => 'col-lg-3 control-label']) !!}
    <div class="col-lg-7">
        {!! Form::password('password',['class' => 'form-control', 'placeholder' => trans('user.password'), 'type' => 'password']) !!}
    </div>
</div>

<div class="form-group">
    {{ Form::label('password-confirm', trans('auth.confirm_password'), ['class' => 'col-md-4 control-label']) }}
    <div class="col-md-6">
        {{ Form::password('password', ['class' => 'form-control', 'name' => 'password_confirmation']) }}
    </div>
</div>

<div class="form-group">
    {!! Form::label('address', trans('user.address'), ['class' => 'col-lg-3 control-label']) !!}
    <div class="col-lg-7">
        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => trans('user.address') ,'rows' => 3]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('phone', trans('user.phone'), ['class' => 'col-lg-3 control-label']) !!}
    <div class="col-lg-4">
        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('user.phone'),'rows' => 3]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('image', trans('user.avatar'), ['class' => 'col-lg-3 control-label']) !!}
    <div class="col-lg-4">
        {!! Form::file('image') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-lg-8 col-lg-offset-2">
        {!! Form::submit(trans('user.save'), ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
    </div>
</div>
