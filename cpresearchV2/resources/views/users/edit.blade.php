@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Oops!</strong> Something went wrong, please check below errors.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card col-8" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{trans('message.edit_user')}}</h4>
                <p class="card-description">{{trans('message.edit_user_details')}}</p>
                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method'=>'PATCH']) !!}
                <div class="form-group row">
                    <div class="col-sm-6">
                        <p><b>{{trans('message.First_Name_TH')}}</b></p>
                        <input type="text" name="fname_th" value="{{ $user->fname_th }}" class="form-control" placeholder="{{ $user->fname_th }}">
                    </div>
                    <div class="col-sm-6">
                        <p><b>{{trans('message.Last_Name_TH')}}</b></p>
                        <input type="text" name="lname_th" value="{{ $user->lname_th }}" class="form-control" placeholder="{{ $user->lname_th }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <p><b>{{trans('message.First_Name_EN')}}</b></p>
                        <input type="text" name="fname_en" value="{{ $user->fname_en }}" class="form-control" placeholder="{{ $user->fname_en }}">
                    </div>
                    <div class="col-sm-6">
                        <p><b>{{trans('message.Last_Name_EN')}}</b></p>
                        <input type="text" name="lname_en" value="{{ $user->lname_en }}" class="form-control" placeholder="{{ $user->lname_en }}">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Email')}}</b></p>
                    <div class="col-sm-8">
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Password')}}</b></p>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Confirm_Password')}}</b></p>
                    <div class="col-sm-8">
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Role')}}</b></p>
                    <div class="col-sm-8">
                        {!! Form::select('roles[]', $roles, $userRole, array('class' => 'selectpicker','multiple data-live-search'=>"true")) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.edit_user_status')}}</b></p>
                    <div class="col-sm-8">
                        <select id='status' class="form-control" style='width: 200px;' name="status">
                            <option value="1" {{ "1" == $user->status ? 'selected' : '' }}>{{trans('message.edit_user_studying')}}</option>
                            <option value="2" {{ "2" == $user->status ? 'selected' : '' }}>{{trans('message.edit_user_graduated')}}</option>
                        </select>
                    </div>
                </div>
                @php
    $locale = app()->getLocale();
@endphp

<div class="form-group row">
    <div class="col-md-6">
        <p for="category"><b>{{ trans('message.Department') }} <span class="text-danger">*</span></b></p>
        <select class="form-control" name="cat" id="cat" style="width: 100%;" required>
            <option value="">{{ trans('message.Select Category') }}</option>
            @foreach ($departments as $cat)
                @php
                    // เลือกชื่อแสดงผลตามภาษา
                    $department_name = ($locale == 'th') ? $cat->department_name_th : $cat->department_name_en;
                @endphp
                <option value="{{$cat->id}}" {{$user->program->department_id == $cat->id  ? 'selected' : ''}}>
                    {{ $department_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <p for="category"><b>{{ trans('message.Program') }} <span class="text-danger">*</span></b></p>
        <select class="form-control select2" name="sub_cat" id="subcat" required>
            <option value="">{{ trans('message.Select Category') }}</option>
            @foreach ($programs as $cat)
                @php
                    // เลือกชื่อแสดงผลตามภาษา
                    $program_name = ($locale == 'th') ? $cat->program_name_th : $cat->program_name_en;
                @endphp
                <option value="{{$cat->id}}" {{$user->program->id == $cat->id  ? 'selected' : ''}}>
                    {{ $program_name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

                <div class="form-group row">
                    <p class="col-sm-3"><b>Scholar ID</b></p>
                    <div class="col-sm-8">
                        <input type="text" name="scholar_id" value="{{ $user->scholar_id }}" class="form-control" placeholder="{{trans('message.edit_user_schorlarID_holder')}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-5">{{trans('message.submit_button')}}</button>
                <a class="btn btn-light mt-5" href="{{ route('users.index') }}">{{trans('message.cancel_button')}}</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script>
    $('#cat').on('change', function(e) {
        var cat_id = e.target.value;
        $.get('/ajax-get-subcat?cat_id=' + cat_id, function(data) {
            $('#subcat').empty();
            $.each(data, function(index, areaObj) {
                $('#subcat').append('<option value="' + areaObj.id + '" >' + areaObj.program_name_en + '</option>');
            });
        });
    });
</script>
<script>
    $('#cat').on('change', function(e) {
        var cat_id = e.target.value;
        $.get('/ajax-get-subcat?cat_id=' + cat_id, function(data) {
            $('#subcat').empty();
            $.each(data, function(index, areaObj) {
                var locale = "{{ app()->getLocale() }}"; // ดึงค่าภาษาปัจจุบัน
                var programName = (locale === 'th') ? areaObj.program_name_th : areaObj.program_name_en;
                $('#subcat').append('<option value="' + areaObj.id + '">' + programName + '</option>');
            });
        });
    });
</script>

@endsection