@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif
        <div class="card col-8" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{ trans('message.roles') }}</h4>
                <p class="card-description">{{ trans('message.details_info') }}</p>
                <div class="row">
                    <p class="card-text col-sm-3"><b>{{ trans('message.name') }} </b></p>
                    @php
    $locale = app()->getLocale();
    $roleMap = [];
    if ($locale == 'th') {
        $roleMap = [
            'admin'       => 'ผู้ดูแลระบบ',
            'teacher'     => 'อาจารย์',
            'student'     => 'นักศึกษา',
            'staff'       => 'เจ้าหน้าที่',
            'headproject' => 'หัวหน้าโครงการ',
        ];
    } elseif ($locale == 'zh') {
        $roleMap = [
            'admin'       => '管理员',
            'teacher'     => '教师',
            'student'     => '学生',
            'staff'       => '职员',
            'headproject' => '项目负责人',
        ];
    }
@endphp

<p class="card-text col-sm-9">
    @if($locale == 'th' || $locale == 'zh')
        {{ isset($roleMap[strtolower($role->name)]) ? $roleMap[strtolower($role->name)] : $role->name }}
    @else
        {{ $role->name }}
    @endif
</p>
                </div>
                <div class="row mt-3">
                    <p class="card-text col-sm-3"><b>{{ trans('message.permissions') }}</b></p>
                    @if(!empty($rolePermissions))
                    <p class="card-text col-sm-9" style="line-height: 1.85rem;">@foreach($rolePermissions as $permission)<label
                            class="badge badge-success"> {{ $permission->name }} </label>  @endforeach</p>
                    @endif
                </div>
                @can('role-create')
                <a class="btn btn-primary mt-5" href="{{ route('roles.index') }}">{{ trans('message.back') }}</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection