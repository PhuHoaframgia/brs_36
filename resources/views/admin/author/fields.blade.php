<div class="form-group">
    {!! Form::label('name', trans('author.author_name'), ['class' => 'col-lg-3 control-label']) !!}
    <div class="col-lg-7">
        {!! Form::text('name', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-7 col-lg-offset-3">
        {!! Form::submit(trans('author.author_save'), ['class' => 'btn btn-lg btn-info pull-right']) !!}
    </div>
</div>
