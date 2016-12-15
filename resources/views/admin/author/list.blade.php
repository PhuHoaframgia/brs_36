@extends('layouts.admin_master')
@section('title', trans('author.author_list_title'))
@section('header')
    <h1 class="page-header">{{ trans('author.list_author') }}</h1>
@endsection
@section('content')
<div class="col-lg-8">
    <table class="table table-responsive table-hover" id="">
        <thead>
            <tr>
                <th class="text-center">{{ trans('author.author_id') }}</th>
                <th class="text-center">{{ trans('author.author_name') }}</th>
                <th class="text-center">{{ trans('author.author_action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr class="odd gradeX text-center">
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->name }}</td>
                    <td>
                        {!! Form::open(['action' => ['Admin\AuthorController@destroy', $author->id], 'method' => 'DELETE']) !!}
                            <div class="btn-group">
                                <a href="{!! action('Admin\AuthorController@show', $author->id) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="{!! action('Admin\AuthorController@edit', $author->id) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("' . trans('author.author_comfirm_delete') . '")']) !!}
                            </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-lg-12 col-lg-offset-8">
        {!! $authors->render(); !!}
    </div>
</div>
@endsection
