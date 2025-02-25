<!-- @php
   if(Auth::user()->hasRole('admin')) {
      $layoutDirectory = 'dashboards.admins.layouts.admin-dash-layout';
   } else {
      $layoutDirectory = 'dashboards.users.layouts.user-dash-layout';
   }
@endphp -->

@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
    <strong>{{ trans('message.error_title') }}</strong> {{ trans('message.error_message') }}<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

        @endif
        <div class="card">
            <div class="card-header">{{trans('message.Create_Department')}}
                <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('departments.index') }}">{{trans('message.Departments')}}</a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'departments.store', 'method'=>'department')) !!}
                <div class="form-group">
    <strong>{{ trans('message.Department_Name_TH') }} :</strong>
    {!! Form::text('department_name_th', null, [
        'placeholder' => trans('message.Department_Name_TH'),
        'class' => 'form-control'
    ]) !!}
</div>
<div class="form-group">
    <strong>{{ trans('message.Department_Name_EN') }} :</strong>
    {!! Form::text('department_name_en', null, [
        'placeholder' => trans('message.Department_Name_EN'),
        'class' => 'form-control'
    ]) !!}
</div>

                    
                    <button type="submit" class="btn btn-primary">{{trans('message.Submit')}}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection