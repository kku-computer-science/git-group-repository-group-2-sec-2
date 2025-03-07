@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>{{ trans('validation.required', ['attribute' => 'field']) }}</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ trans($error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card" style="padding: 16px;">
                    <div class="card-body">
                        <h4 class="card-title mb-5">{{trans('message.Add_User')}}</h4>
                        <p class="card-description">{{trans('message.Add_User_Details')}}</p>
                        {!! Form::open(array('route' => 'users.store', 'method' => 'POST')) !!}
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p><b>{{trans('message.First_Name_TH')}}</b></p>
                                {!! Form::text('fname_th', null, array(
        'placeholder' => '',
        'class' =>
            'form-control'
    )) !!}
                            </div>
                            <div class="col-sm-6">
                                <p><b>{{trans('message.Last_Name_TH')}}</b></p>
                                {!! Form::text('lname_th', null, array(
        'placeholder' => '',
        'class' =>
            'form-control'
    )) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p><b>{{trans('message.First_Name_EN')}}</b></p>
                                {!! Form::text('fname_en', null, array(
        'placeholder' => '',
        'class' =>
            'form-control'
    )) !!}
                            </div>
                            <div class="col-sm-6">
                                <p><b>{{trans('message.Last_Name_EN')}}</b></p>
                                {!! Form::text('lname_en', null, array(
        'placeholder' => '',
        'class' =>
            'form-control'
    )) !!}
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-sm-8">
                                <p><b>{{trans('message.Email')}}</b></p>
                                {!! Form::text('email', null, array('placeholder' => '', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p><b>{{trans('message.Password')}}:</b></p>
                                {!! Form::password('password', array('placeholder' => '', 'class' => 'form-control'))!!}
                            </div>
                            <div class="col-sm-6">
                                <p><b>{{trans('message.Confirm_Password')}}:</p></b>
                                {!! Form::password('password_confirmation', array(
        'placeholder' => '',
        'class'
        => 'form-control'
    )) !!}@php
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
@endphp
                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <p><b>{{ trans('message.Role') }}:</b></p>
                            <div class="col-sm-8">
                                <select class="selectpicker" name="roles[]" multiple title="Select Role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"> {{ isset($roleMap[$role->name]) ? $roleMap[$role->name] : $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 for="category">{{ trans('message.Department') }} <span class="text-danger">*</span>
                                    </h6>
                                    <select class="form-control" name="cat" id="cat" style="width: 100%;" required
                                        oninvalid="this.setCustomValidity(getValidationMessage())"
                                        oninput="this.setCustomValidity('')">
                                        <option value="">{{ trans('message.Select_Subcategory') }}</option>
                                        @foreach ($departments as $cat)
                                                                            @php
                                                                                $locale = app()->getLocale();
                                                                                $department_name = ($locale === 'th') ? $cat->department_name_th :
                                                                                    $cat->department_name_en;
                                                                            @endphp
                                                                            <option value="{{ $cat->id }}">{{ $department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <h6 for="subcat">{{ trans('message.Program') }} <span class="text-danger">*</span></h6>
                                    <select class="form-control select2" name="sub_cat" id="subcat" required
                                        oninvalid="this.setCustomValidity(getValidationMessage())"
                                        oninput="this.setCustomValidity('')">
                                        <option value="">{{ trans('message.Select_Subcategory') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p><b>{{trans('message.Scholar_ID_(Optional)')}}</b></p>
                                {!! Form::text('scholar_id', null, array('placeholder' => '', 'class' => 'form-control'))
                                !!}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans('message.Submit')}}</button>
                        <a class="btn btn-secondary" href="{{ route('users.index') }}">{{trans('message.Cancle')}}</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

    <script>
        $('#cat').on('change', function (e) {
            var cat_id = e.target.value;
            var locale = "{{ app()->getLocale() }}"; // ดึงค่าภาษาปัจจุบัน

            $.get('/ajax-get-subcat?cat_id=' + cat_id, function (data) {
                $('#subcat').empty();
                $.each(data, function (index, areaObj) {
                    var program_name = (locale === 'th') ? areaObj.program_name_th : areaObj
                        .program_name_en;
                    $('#subcat').append('<option value="' + areaObj.id + '">' + areaObj.degree
                        .title_en + ' in ' + program_name + '</option>');
                });
            });
        });


        function getValidationMessage() {
            let locale = "{{ app()->getLocale() }}"; // ดึงภาษาปัจจุบัน
            let messages = {
                en: "Please select an item in the list.",
                th: "กรุณาเลือกข้อมูลจากรายการ",
                zh: "请选择列表中的项目"
            };
            return messages[locale] || messages['en']; // ถ้าไม่เจอภาษาที่รองรับ ให้ใช้ภาษาอังกฤษ
        }
    </script>

@endsection