@extends('dashboards.users.layouts.user-dash-layout')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@section('content')
<style type="text/css">
    .dropdown-toggle {
        height: 40px;
        width: 400px !important;
    }

    body label:not(.input-group-text) {
        margin-top: 10px;
    }

    body .my-select {
        background-color: #fff;
        color: #212529;
        border: #000 0.2 solid;
        border-radius: 10px;
        padding: 6px 20px;
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

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{ trans('message.Add Academic Work') }}</h4>
                <p class="card-description">{{ trans('message.Fill in the form below to add a new academic work') }}</p>
                <form class="forms-sample" action="{{ route('patents.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputac_name" class="col-sm-3">{{ trans('message.Academic Work Name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="ac_name" class="form-control" placeholder="{{ trans('message.Name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputac_type" class="col-sm-3 ">{{ trans('message.Type') }}</label>
                        <div class="col-sm-4">
                            <select id="category" class="custom-select my-select" name="ac_type">
                                <option value="" disabled selected>{{ trans('message.Please specify the type') }}</option>
                                <optgroup label="{{ trans('message.Patent') }}">
                                    <option value="สิทธิบัตร">{{ trans('message.Patent') }}</option>
                                    <option value="สิทธิบัตร (การประดิษฐ์)">{{ trans('message.Patent (Invention)') }}</option>
                                    <option value="สิทธิบัตร (การออกแบบผลิตภัณฑ์)">{{ trans('message.Patent (Design)') }}</option>
                                </optgroup>
                                <optgroup label="{{ trans('message.Petty Patent') }}">
                                    <option value="อนุสิทธิบัตร">{{ trans('message.Petty Patent') }}</option>
                                </optgroup>
                                <optgroup label="{{ trans('message.Copyright') }}">
                                    <option value="ลิขสิทธิ์">{{ trans('message.Copyright') }}</option>
                                    <option value="ลิขสิทธิ์ (วรรณกรรม)">{{ trans('message.Copyright (Literature)') }}</option>
                                    <option value="ลิขสิทธิ์ (ตนตรีกรรม)">{{ trans('message.Copyright (Music)') }}</option>
                                    <option value="ลิขสิทธิ์ (ภาพยนตร์)">{{ trans('message.Copyright (Film)') }}</option>
                                    <option value="ลิขสิทธิ์ (ศิลปกรรม)">{{ trans('message.Copyright (Art)') }}</option>
                                    <option value="ลิขสิทธิ์ (งานแพร่เสี่ยงแพร่ภาพ)">{{ trans('message.Copyright (Broadcast)') }}</option>
                                    <option value="ลิขสิทธิ์ (โสตทัศนวัสดุ)">{{ trans('message.Copyright (Audiovisual)') }}</option>
                                    <option value="ลิขสิทธิ์ (งานอื่นใดในแผนกวรรณคดี/วิทยาศาสตร์/ศิลปะ)">{{ trans('message.Copyright (Other)') }}</option>
                                    <option value="ลิขสิทธิ์ (สิ่งบันทึกเสียง)">{{ trans('message.Copyright (Sound Recording)') }}</option>
                                </optgroup>
                                <optgroup label="{{ trans('message.Other') }}">
                                    <option value="ความลับทางการค้า">{{ trans('message.Trade Secret') }}</option>
                                    <option value="เครื่องหมายการค้า">{{ trans('message.Trademark') }}</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputac_year" class="col-sm-3 ">{{ trans('message.Copyright Date') }}</label>
                        <div class="col-sm-4">
                            <input type="date" name="ac_year" class="form-control" placeholder="{{ trans('message.Copyright Date') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputac_refnumber" class="col-sm-3 ">{{ trans('message.Registration Number') }}</label>
                        <div class="col-sm-4">
                            <input type="text" name="ac_refnumber" class="form-control" placeholder="{{ trans('message.Registration Number') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputac_doi" class="col-sm-3 ">{{ trans('message.Internal Authors') }}</label>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-hover small-text" id="dynamicAddRemove">
                                    <tr>
                                        <td>
                                            <select id='selUser0' style='width: 200px;' name="moreFields[0][userid]">
                                                @php
                                                // ดึง role ของผู้ใช้ที่ล็อกอินจากตาราง model_has_roles
                                                $userRole = DB::table('model_has_roles')
                                                ->where('model_id', Auth::user()->id)
                                                ->value('role_id');
                                                @endphp

                                                @if($userRole == 1) {{-- ถ้า role_id เป็น 1 แสดงว่าเป็น admin --}}
                                                <option value="">{{ trans('message.Select User') }}</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">
                                                    @php
                                                        $locale = app()->getLocale();
                                                        $fname = $user->{'fname_' . $locale} ?? $user->fname_en;
                                                        $lname = $user->{'lname_' . $locale} ?? $user->lname_en;
                                                        if ($locale != 'th' && $locale != 'en') {
                                                            $fname = $user->fname_en;
                                                            $lname = $user->lname_en;
                                                        }
                                                    @endphp
                                                    {{ $fname }} {{ $lname }}
                                                </option>
                                                @endforeach
                                                @else {{-- ถ้าไม่ใช่ admin ให้แสดงเฉพาะชื่อตัวเอง --}}
                                                <option value="{{ Auth::user()->id }}" selected>
                                                    @php
                                                        $locale = app()->getLocale();
                                                        $fname = Auth::user()->{'fname_' . $locale} ?? Auth::user()->fname_en;
                                                        $lname = Auth::user()->{'lname_' . $locale} ?? Auth::user()->lname_en;
                                                        if ($locale != 'th' && $locale != 'en') {
                                                            $fname = Auth::user()->fname_en;
                                                            $lname = Auth::user()->lname_en;
                                                        }
                                                    @endphp
                                                    {{ $fname }} {{ $lname }}
                                                </option>
                                                @endif
                                            </select>
                                        </td>
                                        <td><button type="button" name="add" id="add-btn2" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </table>
                                <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="exampleInputpaper_doi" class="col-sm-3 ">{{ trans('message.External Authors') }}</label>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-hover small-text" id="tb">
                                    <tr class="tr-header">
                                        <th>{{ trans('message.First Name') }}</th>
                                        <th>{{ trans('message.Last Name') }}</th>
                                        <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore2" title="{{ trans('message.Add More Person') }}"><i class="mdi mdi-plus"></i></span></a></th>
                                    <tr>
                                        <td><input type="text" name="fname[]" class="form-control" placeholder="{{ trans('message.First Name') }}"></td>
                                        <td><input type="text" name="lname[]" class="form-control" placeholder="{{ trans('message.Last Name') }}"></td>
                                        <td><a href='javascript:void(0);' class='remove'><span><i class="mdi mdi-minus"></span></a></td>
                                    </tr>
                                </table>
                                <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary me-2">{{ trans('message.Submit') }}</button>
                    <a class="btn btn-light" href="{{ route('patents.index')}}">{{ trans('message.Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#selUser0").select2()
        $("#head0").select2()

        var i = 0;

        $("#add-btn2").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><select id="selUser' + i + '" name="moreFields[' + i +
                '][userid]"  style="width: 200px;"><option value="">{{ trans('message.Select User') }}</option>@foreach($users as $user)@php $locale = app()->getLocale(); $fname = $user->{'fname_' . $locale} ?? $user->fname_en; $lname = $user->{'lname_' . $locale} ?? $user->lname_en; if ($locale != 'th' && $locale != 'en') { $fname = $user->fname_en; $lname = $user->lname_en; } @endphp<option value="{{ $user->id }}">{{ $fname }} {{ $lname }}</option>@endforeach</select></td><td><button type="button" class="btn btn-danger btn-sm remove-tr">X</i></button></td></tr>'
            );
            $("#selUser" + i).select2()
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#addMore2').on('click', function() {
            var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
            data.find("input").val('');
        });
        $(document).on('click', '.remove', function() {
            var trIndex = $(this).closest("tr").index();
            if (trIndex > 1) {
                $(this).closest("tr").remove();
            } else {
                alert("{{ trans('message.Sorry! Can\'t remove first row!') }}");
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var postURL = "<?php echo url('addmore'); ?>";
        var i = 1;

        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i +
                '" class="dynamic-added"><td><input type="text" name="fname[]" placeholder="{{ trans('message.Enter your Name') }}" class="form-control name_list" /></td><td><input type="text" name="lname[]" placeholder="{{ trans('message.Enter your Name') }}" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });
</script>
@endsection
