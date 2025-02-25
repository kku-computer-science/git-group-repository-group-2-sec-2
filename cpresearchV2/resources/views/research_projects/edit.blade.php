@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<style>
    .my-select {
        background-color: #fff;
        color: #212529;
        border: #000 0.2 solid;
        border-radius: 5px;
        padding: 4px 10px;
        width: 100%;
        font-size: 14px;
    }
</style>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>{{ trans('message.Whoops') }}</strong> {{ trans('message.There were some problems with your input') }}.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card col-md-12" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{trans('message.edit_research_project')}}</h4>
            <p class="card-description">{{trans('message.edit_research_project_details')}}</p>
            <form action="{{ route('researchProjects.update',$researchProject->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{ trans('message.Project Name') }}</b></p>
                    <div class="col-sm-8">
                        <textarea name="project_name" value="{{ $researchProject->project_name }}" class="form-control" style="height:90px">{{ $researchProject->project_name }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{ trans('message.Start Date') }}</b></p>
                    <div class="col-sm-4">
                        <input type="date" name="project_start" id="Project_start" value="{{ $researchProject->project_start }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{ trans('message.End Date') }}</b></p>
                    <div class="col-sm-4">
                        <input type="date" name="project_end" id="Project_end" value="{{ $researchProject->project_end }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <p for="exampleInputfund_details" class="col-sm-3"><b>{{ trans('message.Select Fund') }}</b></p>
                    <div class="col-sm-9">
                        <select id='fund' style='width: 200px;' class="custom-select my-select" name="fund">
                            <option value='' disabled selected>{{ trans('message.Select Fund') }}</option>@foreach($funds as $f)<option value="{{ $f->id }}" {{ $f->fund_name == $researchProject->fund->fund_name ? 'selected' : '' }}>{{ $f->fund_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <p class="col-sm-3 "><b>{{ trans('message.Project Year') }}</b></p>
                    <div class="col-sm-8">
                        <input type="year" name="project_year" class="form-control" placeholder="ปี" value="{{$researchProject->project_year}}">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{ trans('message.Budget') }}</b></p>
                    <div class="col-sm-4">
                        <input type="number" name="budget" value="{{ $researchProject->budget }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <p class="col-sm-3 "><b>{{ trans('message.Responsible Department') }}</b></p>
                    <div class="col-sm-3">
                        <select id='dep' style='width: 200px;' class="custom-select my-select" name="responsible_department">
                            <option value=''>{{ trans('message.Select Department') }}</option>@foreach($deps as $dep)<option value="{{ $dep->department_name_th }}" {{ $dep->department_name_th == $researchProject->responsible_department ? 'selected' : '' }}>{{ $dep->department_name_th }}</option>@endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{ trans('message.Project Details') }}</b></p>
                    <div class="col-sm-8">
                        <textarea name="note" class="form-control" style="height:90px">{{ $researchProject->note }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{ trans('message.Status') }}</b></p>
                    <div class="col-sm-8">
                        <select id='status' class="custom-select my-select" style='width: 200px;' name="status">
                            <option value="1" {{ 1 == $researchProject->status ? 'selected' : '' }}>{{ trans('message.Submitted') }}</option>
                            <option value="2" {{ 2 == $researchProject->status ? 'selected' : '' }}>{{ trans('message.In Progress') }}</option>
                            <option value="3" {{ 3 == $researchProject->status ? 'selected' : '' }}>{{ trans('message.Closed') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <table class="table">
                        <tr>
                            <th>{{ trans('message.Project Leader') }}</th>
                        <tr>
                            <td>
                                <select id='head0' style='width: 200px;' name="head">
                                    @php
                                    // ตรวจสอบ role ของผู้ใช้ที่ล็อกอิน
                                    $userRole = DB::table('model_has_roles')
                                    ->where('model_id', Auth::user()->id)
                                    ->value('role_id');
                                    @endphp

                                    @if($userRole == 1) {{-- ถ้าเป็น admin ให้เลือกได้ทุกคน --}}
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $researchProject->head == $user->id ? 'selected' : '' }}>
                                        {{ $user->fname_th }} {{ $user->lname_th }}
                                    </option>
                                    @endforeach
                                    @else {{-- ถ้าไม่ใช่ admin ให้เลือกได้เฉพาะตัวเอง --}}
                                    <option value="{{ Auth::user()->id }}" selected>
                                        {{ Auth::user()->fname_th }} {{ Auth::user()->lname_th }}
                                    </option>
                                    @endif
                                </select>

                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <table class="table " id="dynamicAddRemove">
                        <tr>
                            <th width="522.98px">{{ trans('message.Internal Co-Leader') }}</th>
                            <th><button type="button" name="add" id="add-btn2" class="btn btn-success btn-sm add"><i class="mdi mdi-plus"></i></button></th>
                        </tr>
                    </table>
                </div>
                <div class="form-group row">
                    <label for="exampleInputpaper_author" class="col-sm-3 col-form-label">{{ trans('message.External Co-Leader') }}</label>
                    <div class="col-sm-9">
                        <div class="table-responsive">
                            <table class="table table-hover small-text" id="tb">
                                <tr class="tr-header">
                                    <th>{{ trans('message.Title') }}</th>
                                    <th>{{ trans('message.First Name') }}</th>
                                    <th>{{ trans('message.Last Name') }}</th>
                                    <!-- <th>Email Id</th> -->
                                    <!-- <button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i></button> -->
                                    <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore2" title="{{ trans('message.Add More Person') }}"><i class="mdi mdi-plus"></i></span></a></th>
                                <tr>
                                    <td><input type="text" name="title_name[]" class="form-control" placeholder="{{ trans('message.Title') }}"></td>
                                    <td><input type="text" name="fname[]" class="form-control" placeholder="{{ trans('message.First Name') }}"></td>
                                    <td><input type="text" name="lname[]" class="form-control" placeholder="{{ trans('message.Last Name') }}"></td>
                                    <!-- <td><input type="text" name="emailid[]" class="form-control"></td> -->
                                    <td><a href='javascript:void(0);' class='remove'><span><i class="mdi mdi-minus"></span></a></td>
                                </tr>
                            </table>
                            <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> -->
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-5">{{trans('message.submit_button')}}</button>
                <a class="btn btn-light mt-5" href="{{ route('researchProjects.index') }}">{{trans('message.cancel_button')}}</a>
            </form>
        </div>
    </div>
</div>
@stop
@section('javascript')
<script>
    $(document).ready(function() {
        $("#head0").select2();

        function updateAvailableOptions() {
            let headUserId = $("#head0").val();
            let selectedUsers = new Set();

            // ดึงค่าผู้ที่ถูกเลือกไปแล้ว
            $("select[name^='moreFields']").each(function() {
                let val = $(this).val();
                if (val) selectedUsers.add(val);
            });

            // ปิดการเลือกชื่อตามที่ถูกเลือกไปแล้ว
            $("select[name^='moreFields']").each(function() {
                let currentValue = $(this).val();
                $(this).find("option").each(function() {
                    let optionValue = $(this).val();

                    if (optionValue && (selectedUsers.has(optionValue) && optionValue !== currentValue || optionValue === headUserId)) {
                        $(this).prop("disabled", true);
                    } else {
                        $(this).prop("disabled", false);
                    }
                });
            });
        }

        $(document).on("change", "select[name^='moreFields']", function() {
            updateAvailableOptions();
        });

        var i = 0;
        $("#add-btn2").click(function() {
            ++i;
            var newRow = `<tr>
                        <td>
                            <select id="selUser${i}" name="moreFields[${i}][userid]" class="form-control selectUser" style="width: 200px;">
                                <option value="">{{ trans('message.Select User') }}</option>
                                @foreach($users as $user)
                                    @php
                                        $locale = app()->getLocale();
                                        $fname = $user->fname_en;
                                        $lname = $user->lname_en;
                                        if ($locale == 'th') {
                                            $fname = $user->fname_th;
                                            $lname = $user->lname_th;
                                        }
                                    @endphp
                                    <option value="{{ $user->id }}">{{ $fname }} {{ $lname }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-tr"><i class="mdi mdi-minus"></i></button></td>
                    </tr>`;

            $("#dynamicAddRemove").append(newRow);
            $("#selUser" + i).select2();
            updateAvailableOptions();
        });

        $(document).on("click", ".remove-tr", function() {
            $(this).parents("tr").remove();
            updateAvailableOptions();
        });

        updateAvailableOptions();
    });
</script>
<script>
    $(document).ready(function() {
        var outsider = <?php echo json_encode($researchProject->outsider); ?>;

        var postURL = "<?php echo url('addmore'); ?>";
        var i = 0;

        for (i = 0; i < outsider.length; i++) {
            var obj = outsider[i];
            $("#dynamic_field").append('<tr id="row' + i +
                '" class="dynamic-added"><td><p>{{ trans('
                message.Title ') }} :</p><input type="text" name="title_name[]" value="' + obj.title_name + '" placeholder="{{ trans('
                message.Title ') }}" style="width: 200px;" class="form-control name_list" /><br><p>{{ trans('
                message.First Name ') }} :</p><input type="text" name="fname[]" value="' + obj.fname + '" placeholder="{{ trans('
                message.First Name ') }}" style="width: 300px;" class="form-control name_list" /><br><p>{{ trans('
                message.Last Name ') }} :</p><input type="text" name="lname[]" value="' + obj.lname + '" placeholder="{{ trans('
                message.Last Name ') }}" style="width: 300px;" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn-sm btn_remove"><i class="mdi mdi-minus"></i></button></td></tr>');
        }

        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i +
                '" class="dynamic-added"><td><p>{{ trans('
                message.Title ') }} :</p><input type="text" name="title_name[]" placeholder="{{ trans('
                message.Title ') }}" style="width: 200px;" class="form-control name_list" /><br><p>{{ trans('
                message.First Name ') }} :</p><input type="text" name="fname[]" placeholder="{{ trans('
                message.First Name ') }}" style="width: 300px;" class="form-control name_list" /><br><p>{{ trans('
                message.Last Name ') }} :</p><input type="text" name="lname[]" placeholder="{{ trans('
                message.Last Name ') }}" style="width: 300px;" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn-sm btn_remove"><i class="mdi mdi-minus"></i></button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let projectStart = document.getElementById("Project_start");
        let projectEnd = document.getElementById("Project_end");

        function validateDates() {
            if (projectStart.value && projectEnd.value) {
                if (projectEnd.value < projectStart.value) {
                    alert("{{ trans('message.Invalid Date Range') }}");
                    projectEnd.value = ""; // รีเซ็ตค่าของวันที่สิ้นสุด
                }
            }
        }

        // เมื่อเลือกวันที่เริ่มต้น
        projectStart.addEventListener("change", function() {
            projectEnd.min = projectStart.value; // บังคับให้เลือกวันที่สิ้นสุดไม่น้อยกว่าวันที่เริ่มต้น
            validateDates();
        });

        // เมื่อเลือกวันที่สิ้นสุด
        projectEnd.addEventListener("change", function() {
            validateDates();
        });
    });
</script>
@stop