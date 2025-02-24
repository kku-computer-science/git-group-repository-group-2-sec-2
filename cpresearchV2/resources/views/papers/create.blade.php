@extends('dashboards.users.layouts.user-dash-layout')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@section('content')
<style type="text/css">
    .dropdown-toggle .filter-option {
        height: 40px;
        width: 400px !important;
        color: #212529;
        background-color: #fff;
        border-width: 0.2;
        border-style: solid;
        border-color: -internal-light-dark(rgb(118, 118, 118), rgb(133, 133, 133));
        border-radius: 5px;
        padding: 4px 10px;
    }

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
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">

            </div>
        </div>
    </div>

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
    <!-- <a class="btn btn-primary" href="{{ route('papers.index') }}"> Back </a> -->

    <div class="col-md-10 grid-margin stretch-card">
        <div class="card" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{ trans('message.Add Paper') }}</h4>
                <p class="card-description">{{ trans('message.Fill in the form below to add a new paper') }}</p>
                <form class="forms-sample" action="{{ route('papers.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputpaper_name" class="col-sm-3 col-form-label"><b>{{ trans('message.Source') }}</b></label>
                        <div class="col-sm-9">
                        <select class="selectpicker" multiple data-live-search="true" name="cat[]" data-none-selected-text="{{ trans('message.Please specify the source') }}">
                            @foreach( $source as $s)
                            <option value='{{ $s->id }}'>{{ $s->source_name }}</option>
                            @endforeach
                        </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputpaper_name" class="col-sm-3 col-form-label"><b>{{ trans('message.Paper Name') }}</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_name" class="form-control" placeholder="{{ trans('message.Paper Name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputabstract" class="col-sm-3 col-form-label"><b>{{ trans('message.Abstract') }}</b></label>
                        <div class="col-sm-9">
                            <textarea type="text" name="abstract" class="form-control form-control-lg" style="height:150px" placeholder="{{ trans('message.Abstract') }}"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputkeyword" class="col-sm-3 col-form-label"><b>{{ trans('message.Keyword') }}</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="keyword" class="form-control" placeholder="{{ trans('message.Keyword') }}">
                            <p class="text-danger">{{ trans('message.Keyword Instruction') }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputpaper_type" class="col-sm-3 col-form-label"><b>{{ trans('message.Paper Type') }}</b></label>
                        <div class="col-sm-9">
                            <select id='paper_type' class="custom-select my-select" style='width: 200px;' name="paper_type">
                                <option value="" disabled selected>{{ trans('message.Please specify the type') }}</option>
                                <option value="Journal">{{ trans('message.Journal') }}</option>
                                <option value="Conference Proceeding">{{ trans('message.Conference Proceeding') }}</option>
                                <option value="Book Series">{{ trans('message.Book Series') }}</option>
                                <option value="Book">{{ trans('message.Book') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_subtype" class="col-sm-3 col-form-label"><b>{{ trans('message.Paper Subtype') }}</b></label>
                        <div class="col-sm-9">
                            <select id='paper_subtype' class="custom-select my-select" style='width: 200px;' name="paper_subtype">
                                <option value="" disabled selected>{{ trans('message.Please specify the subtype') }}</option>
                                <option value="Article">{{ trans('message.Article') }}</option>
                                <option value="Conference Paper">{{ trans('message.Conference Paper') }}</option>
                                <option value="Editorial">{{ trans('message.Editorial') }}</option>
                                <option value="Book Chapter">{{ trans('message.Book Chapter') }}</option>
                                <option value="Erratum">{{ trans('message.Erratum') }}</option>
                                <option value="Review">{{ trans('message.Review') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpublicatione" class="col-sm-3 col-form-label"><b>{{ trans('message.Publication') }}</b></label>
                        <div class="col-sm-9">
                            <select id='publication' class="custom-select my-select" style='width: 200px;' name="publication">
                                <option value="" disabled selected>{{ trans('message.Please specify the publication') }}</option>
                                <option value="International Journal">{{ trans('message.International Journal') }}</option>
                                <option value="International Book">{{ trans('message.International Book') }}</option>
                                <option value="International Conference">{{ trans('message.International Conference') }}</option>
                                <option value="National Conference">{{ trans('message.National Conference') }}</option>
                                <option value="National Journal">{{ trans('message.National Journal') }}</option>
                                <option value="National Book">{{ trans('message.National Book') }}</option>
                                <option value="National Magazine">{{ trans('message.National Magazine') }}</option>
                                <option value="Book Chapter">{{ trans('message.Book Chapter') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_sourcetitle" class="col-sm-3 col-form-label"><b>{{ trans('message.Source Title') }}</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_sourcetitle" class="form-control" placeholder="{{ trans('message.Source Title') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputpaper_yearpub" class="col-sm-3 col-form-label"><b>{{ trans('message.Year Published') }}</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_yearpub" class="form-control" placeholder="{{ trans('message.Year Published') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_volume" class="col-sm-3 col-form-label"><b>{{ trans('message.Volume') }}</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_volume" class="form-control" placeholder="{{ trans('message.Volume') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_issue" class="col-sm-3 col-form-label"><b>{{ trans('message.Issue Number') }}</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_issue" class="form-control" placeholder="{{ trans('message.Issue Number') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_citation" class="col-sm-3 col-form-label"><b>{{ trans('message.Citation') }}</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_citation" class="form-control" placeholder="{{ trans('message.Citation') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_page" class="col-sm-3 col-form-label"><b>{{ trans('message.Page') }}</b></label>
                        <div class="col-sm-4">
                            <input type="text" name="paper_page" class="form-control" placeholder="{{ trans('message.Page') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_doi" class="col-sm-3 col-form-label"><b>{{ trans('message.Doi') }}</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_doi" class="form-control" placeholder="{{ trans('message.Doi') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_funder" class="col-sm-3 col-form-label"><b>{{ trans('message.Funder') }}</b></label>
                        <div class="col-sm-9">
                            <input type="int" name="paper_funder" class="form-control" placeholder="{{ trans('message.Funder') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_url" class="col-sm-3 col-form-label"><b>{{ trans('message.URL') }}</b></label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_url" class="form-control" placeholder="{{ trans('message.URL') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_doi" class="col-sm-3 "><b>{{ trans('message.Internal Authors') }}</b></label>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <td>
                                            @php
                                            // ดึง role ของผู้ใช้ที่ล็อกอินจากตาราง model_has_roles
                                            $userRole = DB::table('model_has_roles')
                                            ->where('model_id', Auth::user()->id)
                                            ->value('role_id');
                                            @endphp

                                            <select id='selUser0' style='width: 200px;' name="moreFields[0][userid]">
                                                @if($userRole == 1) {{-- ถ้าเป็น admin --}}
                                                <option value=''>{{ trans('message.Select User') }}</option>
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
                                        <td><select id='pos' class="custom-select my-select" style='width: 200px;' name="pos[]">
                                                <option value="1">{{ trans('message.First Author') }}</option>
                                                <option value="2">{{ trans('message.Co-Author') }}</option>
                                                <option value="3">{{ trans('message.Corresponding Author') }}</option>
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
                    <div class="form-group row">
                        <label for="exampleInputpaper_doi" class="col-sm-3 col-form-label"><b>{{ trans('message.External Authors') }}</b></label>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                        <td><input type="text" name="fname[]" placeholder="{{ trans('message.First Name') }}" class="form-control name_list" /></td>
                                        <td><input type="text" name="lname[]" placeholder="{{ trans('message.Last Name') }}" class="form-control name_list" /></td>
                                        <td><select id='pos2' class="custom-select my-select" style='width: 200px;' name="pos2[]">
                                                <option value="1">{{ trans('message.First Author') }}</option>
                                                <option value="2">{{ trans('message.Co-Author') }}</option>
                                                <option value="3">{{ trans('message.Corresponding Author') }}</option>
                                            </select>
                                        </td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                    </tr>
                                </table>
                                <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary me-2">{{ trans('message.Submit') }}</button>
                    <a class="btn btn-light" href="{{ route('papers.index')}}">{{ trans('message.Cancel') }}</a>
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
                '][userid]"  style="width: 200px;"><option value="">{{ trans('message.Select User') }}</option>@foreach($users as $user)@php $locale = app()->getLocale(); $fname = $user->{'fname_' . $locale} ?? $user->fname_en; $lname = $user->{'lname_' . $locale} ?? $user->lname_en; if ($locale != 'th' && $locale != 'en') { $fname = $user->fname_en; $lname = $user->lname_en; } @endphp<option value="{{ $user->id }}">{{ $fname }} {{ $lname }}</option>@endforeach</select></td><td><select id="pos" class="custom-select my-select" style="width: 200px;" name="pos[]"><option value="1">{{ trans('message.First Author') }}</option><option value="2">{{ trans('message.Co-Author') }}</option><option value="3">{{ trans('message.Corresponding Author') }}</option></select></td><td><button type="button" class="btn btn-danger btn-sm remove-tr">X</i></button></td></tr>'
            );
            $("#selUser" + i).select2()
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
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
                '" class="dynamic-added"><td><input type="text" name="fname[]" placeholder="{{ trans('message.First Name') }}" class="form-control name_list" /></td><td><input type="text" name="lname[]" placeholder="{{ trans('message.Last Name') }}" class="form-control name_list" /></td><td><select id="pos2" class="custom-select my-select" style="width: 200px;" name="pos2[]"><option value="1">{{ trans('message.First Author') }}</option><option value="2">{{ trans('message.Co-Author') }}</option><option value="3">{{ trans('message.Corresponding Author') }}</option></select></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');
        });


        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#submit').click(function() {
            $.ajax({
                url: postURL,
                method: "POST",
                data: $('#add_name').serialize(),
                type: 'json',
                success: function(data) {
                    if (data.error) {
                        printErrorMsg(data.error);
                    } else {
                        i = 1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display', 'block');
                        $(".print-error-msg").css('display', 'none');
                        $(".print-success-msg").find("ul").append(
                            '<li>Record Inserted Successfully.</li>');
                    }
                }
            });
        });


        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $(".print-success-msg").css('display', 'none');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function updateUserSelection() {
            let firstAuthorSelected = false;

            document.querySelectorAll(".pos-select").forEach((select, index) => {
                if (select.value === "1") { // ตรวจสอบ First Author
                    firstAuthorSelected = true;
                }

                let userSelect = document.querySelector(`#selUser${index}`);
                if (userSelect) {
                    if (firstAuthorSelected) {
                        userSelect.disabled = false; // เปิดให้เลือก user ในช่องที่เป็น First Author
                    } else if (userSelect.value !== "{{ Auth::user()->id }}") {
                        userSelect.disabled = true; // ปิดการเลือก user อื่นสำหรับ Co-Author และ Corresponding
                    }
                }
            });
        }

        // ตรวจจับการเปลี่ยนค่า First Author
        document.addEventListener("change", function(event) {
            if (event.target.classList.contains("pos-select")) {
                updateUserSelection();
            }
        });

        updateUserSelection();
    });
</script>
@endsection
<!-- <form action="{{ route('papers.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="paper_name" class="form-control" placeholder="paper_name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Year:</strong>
                    <textarea class="form-control" style="height:150px" name="paper_year" placeholder="paper_year"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>paper_type:</strong>
                    <textarea class="form-control" style="height:150px" name="paper_type" placeholder="paper_type"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>paper_level:</strong>
                    <textarea class="form-control" style="height:150px" name="paper_level" placeholder="paper_level"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>paper_details:</strong>
                    <textarea class="form-control" style="height:150px" name="paper_details" placeholder="paper_details"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div> -->
