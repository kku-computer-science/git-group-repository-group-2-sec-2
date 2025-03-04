@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
            <strong>{{ trans('message.Oops') }}</strong> {{ trans('message.Something went wrong, please check below errors') }}.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">{{ trans('message.Create Role') }}
                <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}">{{ trans('message.Roles') }}</a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                    <div class="form-group">
                        <strong>{{ trans('message.Role Name')}}</strong>
                        {!! Form::text('name', null, array('placeholder' => trans('message.Role Name'),'class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>{{ trans('message.Permission') }}</strong>
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">{{ trans('message.Submit') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection