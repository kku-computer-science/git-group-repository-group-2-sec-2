@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="justify-content-center">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>{{ trans('message.error_title') }}</strong> {{ trans('message.error_message') }}<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ trans($error) }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-header">{{ trans('message.Create_Department') }}
                <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('departments.index') }}">{{ trans('message.Departments') }}</a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'departments.store', 'method' => 'POST']) !!}
                
                <div class="form-group">
                    <strong>{{ trans('message.Department_Name_TH') }} :</strong>
                    {!! Form::text('department_name_th', old('department_name_th'), [
                        'placeholder' => trans('message.Department_Name_TH'),
                        'class' => 'form-control ' . ($errors->has('department_name_th') ? 'is-invalid' : '')
                    ]) !!}
                    @if ($errors->has('department_name_th'))
                        <span class="text-danger">{{ trans($errors->first('department_name_th')) }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <strong>{{ trans('message.Department_Name_EN') }} :</strong>
                    {!! Form::text('department_name_en', old('department_name_en'), [
                        'placeholder' => trans('message.Department_Name_EN'),
                        'class' => 'form-control ' . ($errors->has('department_name_en') ? 'is-invalid' : '')
                    ]) !!}
                    @if ($errors->has('department_name_en'))
                        <span class="text-danger">{{ trans($errors->first('department_name_en')) }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <strong>{{ trans('message.Department_Name_ZH') }} :</strong>
                    {!! Form::text('department_name_zh', old('department_name_zh'), [
                        'placeholder' => trans('message.Department_Name_ZH'),
                        'class' => 'form-control ' . ($errors->has('department_name_zh') ? 'is-invalid' : '')
                    ]) !!}
                    @if ($errors->has('department_name_zh'))
                        <span class="text-danger">{{ trans($errors->first('department_name_zh')) }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">{{ trans('message.Submit') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
