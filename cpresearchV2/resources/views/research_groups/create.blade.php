@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
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
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{trans('message.Create_Research_Group')}}</h4>
            <p class="card-description">{{trans('message.Edit_Research_Group_Details')}}</p>
            <form action="{{ route('researchGroups.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{trans('message.Research_Group_Name_TH')}}</b></p>
                    <div class="col-sm-8">
                        <input name="group_name_th" value="{{ old('group_name_th') }}" class="form-control"
                            placeholder="{{trans('message.Research_Group_Name_TH')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{trans('message.Research_Group_Name_EN')}}</b></p>
                    <div class="col-sm-8">
                        <input name="group_name_en" value="{{ old('group_name_en') }}" class="form-control"
                            placeholder="{{trans('message.Research_Group_Name_EN')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Research_Group_Name_TH')}}</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_desc_th" value="{{ old('group_desc_th') }}" class="form-control"
                            style="height:90px"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Research_Group_Name_EN')}}</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_desc_en" value="{{ old('group_desc_en') }}" class="form-control"
                            style="height:90px"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Research_Group_Description_TH')}}</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_detail_en" value="{{ old('group_detail_th') }}" class="form-control"
                            style="height:90px"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Research_Group_Description_EN')}}</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_detail_th" value="{{ old('group_detail_en') }}" class="form-control"
                            style="height:90px"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Image')}}</b></p>
                    <div class="col-sm-8">
                        <input type="file" name="group_image" class="form-control" value="{{ old('group_image') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Research_Group_Leader')}}</b></p>
                    <div class="col-sm-8">
                        <select id='head0' name="head">
                            @php
                            // ดึง role ของผู้ใช้ที่ล็อกอินจากตาราง model_has_roles
                            $userRole = DB::table('model_has_roles')
                            ->where('model_id', Auth::user()->id)
                            ->value('role_id');
                            @endphp

            @if($userRole == 1) {{-- ถ้า role_id เป็น 1 แสดงว่าเป็น admin --}}
            <option value="">{{trans('message.Select_User')}}</option>
            @foreach($users as $user)
                @php
                    // เลือกแสดงชื่อให้ตรงกับภาษา
                    $fname = $locale === 'th' ? $user->fname_th : ($locale === 'zh' ? $user->fname_en : $user->fname_en);
                    $lname = $locale === 'th' ? $user->lname_th : ($locale === 'zh' ? $user->lname_en : $user->lname_en);
                @endphp
                <option value="{{ $user->id }}" {{ Auth::user()->id == $user->id ? 'selected' : '' }}>
                    {{ $fname }} {{ $lname }}
                </option>
            @endforeach
            @else {{-- ถ้าไม่ใช่ admin ให้แสดงเฉพาะชื่อตัวเอง --}}
            @php
                $fname = $locale === 'th' ? Auth::user()->fname_th : ($locale === 'zh' ? Auth::user()->fname_en : Auth::user()->fname_en);
                $lname = $locale === 'th' ? Auth::user()->lname_th : ($locale === 'zh' ? Auth::user()->lname_en : Auth::user()->lname_en);
            @endphp
            <option value="{{ Auth::user()->id }}" selected>
                {{ $fname }} {{ $lname }}
            </option>
            @endif
        </select>
    </div>
</div>
<div class="form-group row">
    <p class="col-sm-3 pt-4"><b>{{trans('message.Research_Group_Members')}}</b></p>
    <div class="col-sm-8">
        <table class="table" id="dynamicAddRemove">
            <tr>
                <th><button type="button" name="add" id="add-btn2" class="btn btn-success btn-sm add"><i
                            class="mdi mdi-plus"></i></button></th>
            </tr>
        </table>
    </div>
</div>
                <button type="submit" class="btn btn-primary upload mt-5">{{trans('message.Submit')}}</button>
                <a class="btn btn-light mt-5" href="{{ route('researchGroups.index')}}">{{trans('message.Back')}}</a>
            </form>
        </div>
    </div>
</div>

@stop
@section('javascript')
<!-- <script type="text/javascript">
$("body").on("click",".upload",function(e){
    $(this).parents("form").ajaxForm(options);
  });


  var options = {
    complete: function(response)
    {
        if($.isEmptyObject(response.responseJSON.error)){
            // $("input[name='title']").val('');
            // alert('Image Upload Successfully.');
        }else{
            printErrorMsg(response.responseJSON.error);
        }
    }
  };


  function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
  }
</script> -->
<script>
    $(document).ready(function() {
        $("#head0").select2();

        function updateAvailableOptions() {
            let headUserId = $("#head0").val(); // ดึงค่า ID ของหัวหน้ากลุ่มวิจัย
            let selectedUsers = new Set();

            // เก็บค่าผู้ใช้ที่ถูกเลือกไปแล้ว
            $("select[name^='moreFields']").each(function() {
                let val = $(this).val();
                if (val) selectedUsers.add(val);
            });

            // ปิดการเลือกชื่อที่ถูกเลือกไปแล้ว และหัวหน้ากลุ่ม
            $("select[name^='moreFields']").each(function() {
                let currentValue = $(this).val();
                $(this).find("option").each(function() {
                    let optionValue = $(this).val();

                    if (optionValue && (selectedUsers.has(optionValue) && optionValue !== currentValue || optionValue === headUserId)) {
                        $(this).prop("disabled", true); // ปิดการเลือก
                    } else {
                        $(this).prop("disabled", false); // เปิดให้เลือก
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
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fname_th }} {{ $user->lname_th }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-tr">
                                <i class="mdi mdi-minus"></i>
                            </button>
                        </td>
                    </tr>`;

            $("#dynamicAddRemove").append(newRow);
            $("#selUser" + i).select2();
            updateAvailableOptions();
        });

        $(document).on("click", ".remove-tr", function() {
            $(this).parents("tr").remove();
            updateAvailableOptions();
        });

        $("#head0").on("change", function() {
            updateAvailableOptions();
        });

        updateAvailableOptions();
    });
</script>
