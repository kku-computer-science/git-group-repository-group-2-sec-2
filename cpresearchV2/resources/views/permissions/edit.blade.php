@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
            <strong>{{trans('message.Whoops!')}}</strong> {{trans('message.There were some problems with your input.')}}<br><br>
            <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">{{trans('message.edit_permission')}}
                <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('permissions.index') }}">{{trans('message.permission')}}</a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method'=>'PATCH']) !!}
                    <div class="form-group">
                        <strong>{{trans('message.permission_name')}}:</strong>
                        {!! Form::text('name', null, array('placeholder' => trans('message.name'),'class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('message.submit')}}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection