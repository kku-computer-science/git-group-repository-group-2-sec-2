@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>{{trans('message.Whoops')}}!</strong> {{trans('message.There were some problems with your input')}}<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{trans('message.edit_research_group')}}</h4>
            <p class="card-description">{{trans('message.edit_research_group_details')}}</p>
            <form action="{{ route('researchGroups.update',$researchGroup->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{trans('message.Research_Group_Name_TH')}}</b></p>
                    <div class="col-sm-8">
                        <input name="group_name_th" value="{{ $researchGroup->group_name_th }}" class="form-control"
                            placeholder="ชื่อกลุ่มวิจัย (ภาษาไทย)">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3 "><b>{{trans('message.Research_Group_Name_EN')}}</b></p>
                    <div class="col-sm-8">
                        <input name="group_name_en" value="{{ $researchGroup->group_name_en }}" class="form-control"
                            placeholder="ชื่อกลุ่มวิจัย (English)">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.research_group_description_th')}}</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_desc_th" value="{{ $researchGroup->group_desc_th }}" class="form-control"
                            style="height:90px">{{ $researchGroup->group_desc_th }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.research_group_description_en')}}</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_desc_en" value="{{ $researchGroup->group_desc_en }}" class="form-control"
                            style="height:90px">{{ $researchGroup->group_desc_en }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.research_group_detail_th')}}</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_detail_th" value="{{ $researchGroup->group_detail_th }}" class="form-control"
                            style="height:90px">{{ $researchGroup->group_detail_th }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.research_group_detail_en')}}</b></p>
                    <div class="col-sm-8">
                        <textarea name="group_detail_en" value="{{ $researchGroup->group_detail_en }}" class="form-control"
                            style="height:90px">{{ $researchGroup->group_detail_en }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Image')}}</b></p>
                    <div class="col-sm-8">
                        <input type="file" name="group_image" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b>{{trans('message.Research_Group_Leader')}}</b></p>
                    <div class="col-sm-8">
                        <select id='head0' name="head">
                            @php
                            // ดึง role ของผู้ใช้ที่ล็อกอิน
                            $currentUserRole = DB::table('model_has_roles')->where('model_id', Auth::user()->id)->value('role_id');

                            // ดึง ID ของหัวหน้ากลุ่มจาก researchGroup
                            $currentHeadId = $researchGroup->user()->wherePivot('role', 1)->value('users.id');
                            @endphp

                            @if($currentUserRole == 1) {{-- ถ้าเป็น Admin --}}
                            <option value="">{{trans('message.research_group_leader')}}</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ ($currentHeadId == $user->id) ? 'selected' : '' }}>
                                {{ $user->fname_th }} {{ $user->lname_th }}
                            </option>
                            @endforeach
                            @else {{-- ถ้าไม่ใช่ Admin แสดงเฉพาะตัวเอง และใช้ค่าเดิมจาก Database --}}
                            <option value="{{ Auth::user()->id }}" selected>
                                {{ Auth::user()->fname_th }} {{ Auth::user()->lname_th }}
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

                                <th>
                                    <button type="button" name="add" id="add-btn2" class="btn btn-success btn-sm add">
                                        <i
                                            class="mdi mdi-plus">
                                        </i>
                                    </button>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-5">{{trans('message.submit_button')}}</button>
                <a class="btn btn-light mt-5" href="{{ route('researchGroups.index') }}"> {{trans('message.Back')}}</a>
            </form>
        </div>
    </div>
</div>
@stop
@section('javascript')
<script>
    $(document).ready(function() {
        $("#head0").select2();

        var researchGroup = <?php echo json_encode($researchGroup['user']); ?>;
        var i = 0;

        function updateAvailableOptions() {
            let selectedUsers = new Set();

            // ดึงค่า ID ของหัวหน้ากลุ่มวิจัย
            let headUserId = $("#head0").val();
            if (headUserId) selectedUsers.add(headUserId);

            // ดึงค่าผู้ใช้ที่ถูกเลือกไปแล้วจากสมาชิกกลุ่มวิจัย
            $("select[name^='moreFields']").each(function() {
                let val = $(this).val();
                if (val) selectedUsers.add(val);
            });

            // ปิดการเลือกชื่อที่ถูกเลือกไปแล้ว และหัวหน้ากลุ่ม
            $("select[name^='moreFields']").each(function() {
                let currentValue = $(this).val();
                $(this).find("option").each(function() {
                    let optionValue = $(this).val();

                    if (optionValue && selectedUsers.has(optionValue) && optionValue !== currentValue) {
                        $(this).prop("disabled", true); // ปิดการเลือก
                    } else {
                        $(this).prop("disabled", false); // เปิดให้เลือก
                    }
                });
            });
        }

        for (i = 0; i < researchGroup.length; i++) {
            var obj = researchGroup[i];

            // ตรวจสอบเฉพาะสมาชิกที่เป็น role = 2 และไม่ใช่ admin
            if (obj.pivot.role === 2 && obj.role_id !== 1) {
                $("#dynamicAddRemove").append(`<tr>
                <td>
                    <select id="selUser${i}" name="moreFields[${i}][userid]" class="form-control selectUser" style="width: 200px;">
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            @php
                                $userRole = DB::table('model_has_roles')->where('model_id', $user->id)->value('role_id');
                            @endphp
                            @if($userRole != 1) <!-- ไม่แสดง Admin -->
                                <option value="{{ $user->id }}">{{ $user->fname_th }} {{ $user->lname_th }}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-tr">
                        <i class="mdi mdi-minus"></i>
                    </button>
                </td>
            </tr>`);

                $("#selUser" + i).val(obj.id).select2();
                updateAvailableOptions();
            }
        }

        $("#add-btn2").click(function() {
            ++i;
            $("#dynamicAddRemove").append(`<tr>
            <td>
                <select id="selUser${i}" name="moreFields[${i}][userid]" class="form-control selectUser" style="width: 200px;">
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        @php
                            $userRole = DB::table('model_has_roles')->where('model_id', $user->id)->value('role_id');
                        @endphp
                        @if($userRole != 1) <!-- ไม่แสดง Admin -->
                            <option value="{{ $user->id }}">{{ $user->fname_th }} {{ $user->lname_th }}</option>
                        @endif
                    @endforeach
                </select>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-tr">
                    <i class="mdi mdi-minus"></i>
                </button>
            </td>
        </tr>`);

            $("#selUser" + i).select2();
            updateAvailableOptions();
        });

        $(document).on("click", ".remove-tr", function() {
            $(this).parents("tr").remove();
            updateAvailableOptions();
        });

        // อัปเดตรายชื่อที่สามารถเลือกได้เมื่อมีการเปลี่ยนหัวหน้ากลุ่ม
        $("#head0").on("change", function() {
            updateAvailableOptions();
        });

        // อัปเดตรายชื่อที่สามารถเลือกได้เมื่อมีการเปลี่ยนสมาชิกกลุ่ม
        $(document).on("change", "select[name^='moreFields']", function() {
            updateAvailableOptions();
        });

        updateAvailableOptions();
    });
</script>
@stop