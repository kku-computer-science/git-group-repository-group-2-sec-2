@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>{{trans('message.Whoops!')}}</strong>
                    {{trans('message.There were some problems with your input.')}}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @php
                $locale = app()->getLocale();
                $roleMap = [];
                if ($locale == 'th') {
                    $roleMap = [
                        'admin' => 'ผู้ดูแลระบบ',
                        'teacher' => 'อาจารย์',
                        'student' => 'นักศึกษา',
                        'staff' => 'เจ้าหน้าที่',
                        'head project' => 'หัวหน้าโครงการ',
                        'project leader' => 'หัวหน้าโครงการ',
                        'System Administrator' => 'ผู้ดูแลระบบระบบ',
                        'Public Relations Officer' => 'เจ้าหน้าที่ประชาสัมพันธ์',
                        'Educator' => 'นักการศึกษา',
                        'Undergrad Student' => 'นักศึกษาปริญญาตรี',
                        'Master Student' => 'นักศึกษาปริญญาโท',
                        'Doctoral Student' => 'นักศึกษาปริญญาเอก',
                    ];
                } elseif ($locale == 'zh') {
                    $roleMap = [
                        'admin' => '管理员',
                        'teacher' => '教师',
                        'student' => '学生',
                        'staff' => '职员',
                        'head project' => '项目负责人',
                        'project leader' => '项目负责人',
                        'System Administrator' => '系统管理员',
                        'Public Relations Officer' => '公关人员',
                        'Educator' => '教育者',
                        'Undergrad Student' => '本科生',
                        'Master Student' => '研究生',
                        'Doctoral Student' => '博士生',
                    ];
                } else {
                    $roleMap = [
                        'admin' => 'Admin',
                        'teacher' => 'Teacher',
                        'student' => 'Student',
                        'staff' => 'Staff',
                        'head project' => 'Head Project',
                        'project leader' => 'Project Leader',
                        'System Administrator' => 'System Administrator',
                        'Public Relations Officer' => 'Public Relations Officer',
                        'Educator' => 'Educator',
                        'Undergrad Student' => 'Undergrad Student',
                        'Master Student' => 'Master Student',
                        'Doctoral Student' => 'Doctoral Student',
                    ];
                }
                $roleNameTranslated = $roleMap[$role->name] ?? $role->name;
            @endphp
            <div class="card col-8" style="padding: 16px;">
                <div class="card-body">
                    <h4 class="card-title">{{trans('message.edit_role')}}</h4>
                    {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PATCH']) !!}
                    <div class="form-group row">
                        <p class="col-sm-3">{{trans('message.role_name')}}</p>
                        <div class="col-sm-8">
                            {!! Form::hidden('name', $role->name) !!}
                            <p>{{ $roleNameTranslated }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="col-sm-3">{{trans('message.permission')}}</p>
                        <div class="col-sm-9">
                            @foreach($permission as $value)
                                <p>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                    {{ $value->name }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5">{{trans('message.Submit')}}</button>
                    <a class="btn btn-light mt-5" href="{{ route('roles.index') }}">{{trans('message.back')}}</a>
                    {!! Form::close() !!}


                </div>

            </div>
        </div>
    </div>
@endsection