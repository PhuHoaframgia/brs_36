@extends('user.master')
@section('content')
<div class="freework">
    <div class="container1" >
        <h2 class="fleft">{{ trans('book_request.map') }}</h2>
        <h2 class="rq_h2">{{ trans('book_request.write_request') }}</h2>
        <div class="cclear"></div>
        <div class="row">
            <article class="col-sm-12 sm2">
                <figure class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1916.988351599994!2d108.21309848640844!3d16.06669867898974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142184a8d51d751%3A0xdbbd06648f589398!2sV%C4%A9nh+Trung+Plaza!5e0!3m2!1svi!2s!4v1480916588081"></iframe>
                </figure>
                <div class="cclear"></div>
                <section class="formBox" >
                    <div class="container">
                        <div class="row">
                            <article class="col-sm-4 sm4" >
                                <h2>{{ trans('book_request.find_us') }}</h2>
                                <div class="info">
                                    <p>{{ trans('book_request.myaddress') }}</p>
                                    <p><span>{{ trans('book_request.telephone') }}:</span>+1 959 603 6035</p>
                                    <p><span>FAX:</span>+1 504 889 9898</p>
                                    <p>E-mail: mail@demolink.org</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>
            </article>
            <div class="list_request" >
                <article class="contactBox21">
                    {!! Form::open(['action' => 'User\RequestController@store']) !!}
                        {!! Form::textarea('content', $value = "", ['class' => 're_area', 'placeholder' => trans('book_request.write_here') ]) !!}
                        <div class="btns">
                            {!! Form::submit('Submit', ['class' => 'btn-default btn1']) !!}
                            <p>
                                @if ($errors->has('content'))
                                   {{ $errors->first('content') }}
                                @endif
                            </p>
                        </div>
                    {!! Form::close() !!}
                </article>
                <div class="cclear"></div>
                <h2  class="rq1_h2">{{ trans('book_request.list_your_request') }}</h2>
                <div class="scrol" >
                    <table>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @forelse ($requests as $keys => $request)
                            <tr>
                                <td>{{ $keys+1 }}</td>
                                <td>{{ $request->content }}</td>
                                <td>
                                   {{ ($request->status) ? trans('book_request.not_approved') : trans('book_request.approved') }}
                                </td>
                                <td>
                                    {!! Form::open(['action' => ['User\RequestController@destroy', $request->id] ,'method' => 'delete']) !!}
                                        {!! Form::submit('Submit', ['class' => 'but btn-default btn1',  'onclick' => 'return confirm("' . trans('category.category_comfirm_delete') . '")']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">{{ trans('book_request.no_request') }}</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content1')
<div class="pgrequest timeacti">
    @include('user.blocks.time_follow')
</div>
@endsection
