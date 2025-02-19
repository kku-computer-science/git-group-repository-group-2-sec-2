@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">สร้างกลุ่มวิจัย</h4>
            <p class="card-description">กรอกข้อมูลแก้ไขรายละเอียดกลุ่มวิจัย</p>
            <form action="{{ route('researchGroups.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <p class="col-sm-3 "><b>ชื่อกลุ่มวิจัย (ภาษาไทย)</b></p>
                    <div class="col-sm-8">
                        <input name="group_name_th" value="{{ old('group_name_th') }}" class="form-control"
                            placeholder="ชื่อกลุ่มวิจัย (ภาษาไทย)">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3 "><b>ชื่อกลุ่มวิจัย (English)</b></p>
                    <div class="col-sm-8">
                        <input name="group_name_en" value="{{ old('group_name_en') }}" class="form-control"
                            placeholder="ชื่อกลุ่มวิจัย (English)">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>คำอธิบายกลุ่มวิจัย (ภาษาไทย)</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_desc_th" value="{{ old('group_desc_th') }}" class="form-control"
                            style="height:90px"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>คำอธิบายกลุ่มวิจัย (English)</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_desc_en" value="{{ old('group_desc_en') }}" class="form-control"
                            style="height:90px"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>รายละเอียดกลุ่มวิจัย (ภาษาไทย)</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_detail_en" value="{{ old('group_detail_th') }}" class="form-control"
                            style="height:90px"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>รายละเอียดกลุ่มวิจัย (English)</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_detail_th" value="{{ old('group_detail_en') }}" class="form-control"
                            style="height:90px"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>image</b></p>
                    <div class="col-sm-8">
                        <input type="file" name="group_image" class="form-control" value="{{ old('group_image') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>หัวหน้ากลุ่มวิจัย</b></p>
                    <div class="col-sm-8">
                        <select id='head0' name="head">
                            @php
                            // ดึง role ของผู้ใช้ที่ล็อกอินจากตาราง model_has_roles
                            $userRole = DB::table('model_has_roles')
                            ->where('model_id', Auth::user()->id)
                            ->value('role_id');
                            @endphp

                            @if($userRole == 1) {{-- ถ้า role_id เป็น 1 แสดงว่าเป็น admin --}}
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ Auth::user()->id == $user->id ? 'selected' : '' }}>
                                {{ $user->fname_th }} {{ $user->lname_th }}
                            </option>
                            @endforeach
                            @else {{-- ถ้าไม่ใช่ admin ให้แสดงเฉพาะชื่อตัวเอง --}}
                            <option value="{{ Auth::user()->id }}" selected>
                                {{ Auth::user()->fname_th }} {{ Auth::user()->lname_th }}
                            </option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3 pt-4"><b>สมาชิกกลุ่มวิจัย</b></p>
                    <div class="col-sm-8">
                        <table class="table" id="dynamicAddRemove">
                            <tr>
                                <th><button type="button" name="add" id="add-btn2" class="btn btn-success btn-sm add"><i
                                            class="mdi mdi-plus"></i></button></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary upload mt-5">Submit</button>
                <a class="btn btn-light mt-5" href="{{ route('researchGroups.index')}}"> Back</a>
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
@stop
