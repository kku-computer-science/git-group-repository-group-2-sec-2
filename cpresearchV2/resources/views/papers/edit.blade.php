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
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{trans('message.edit_paper')}}</h4>
                <p class="card-description">{{trans('message.edit_paper_details')}}</p>
                <form class="forms-sample" action="{{ route('papers.update',$paper->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <p class="col-sm-3"><b>{{ trans('message.Source') }}</b></p>
                        <div class="col-sm-8">
                            {!! Form::select('sources[]', $sources, $paperSource, array('class' => 'selectpicker','multiple data-live-search'=>"true")) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_name" class="col-sm-3 col-form-label">{{ trans('message.Paper Name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_name" value="{{ $paper->paper_name }}" class="form-control" placeholder="{{ trans('message.Paper Name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputabstract" class="col-sm-3 col-form-label">{{ trans('message.Abstract') }}</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="abstract" placeholder="abstract" class="form-control form-control-lg" style="height:150px">{{ $paper->abstract }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputkeyword" class="col-sm-3 col-form-label">{{ trans('message.Keyword') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="keyword" value="{{ $paper->keyword }}" class="form-control" placeholder="{{ trans('message.Keyword') }}">
                            <p class="text-danger">{{ trans('message.Keyword Instruction') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_type" class="col-sm-3 col-form-label">{{ trans('message.Paper Type') }} (Type)</label>
                        <div class="col-sm-9">
                            <select id='paper_type' class="custom-select my-select" style='width: 200px;' name="paper_type">
                                <option value="Journal" {{ "Journal" == $paper->paper_type ? 'selected' : '' }}>{{ trans('message.Journal') }}</option>
                                <option value="Conference Proceeding" {{ "Conference Proceeding" == $paper->paper_type ? 'selected' : '' }}>{{ trans('message.Conference Proceeding') }}</option>
                                <option value="Book Series" {{ "Book Series" == $paper->paper_type ? 'selected' : '' }}>{{ trans('message.Book Series') }}</option>
                                <option value="Book" {{ "Book" == $paper->paper_type ? 'selected' : '' }}>{{ trans('message.Book') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_subtype" class="col-sm-3 col-form-label">{{ trans('message.Paper Subtype') }}</label>
                        <div class="col-sm-9">
                            <select id='paper_subtype' class="custom-select my-select" style='width: 200px;' name="paper_subtype">
                                <option value="Article" {{ "Article" == $paper->paper_subtype ? 'selected' : '' }}>{{ trans('message.Article') }}</option>
                                <option value="Conference Paper" {{ "Conference Paper" == $paper->paper_subtype ? 'selected' : '' }}>{{ trans('message.Conference Paper') }}</option>
                                <option value="Editorial" {{ "Editorial" == $paper->paper_subtype ? 'selected' : '' }}>{{ trans('message.Editorial') }}</option>
                                <option value="Book Chapter" {{ "Book Chapter" == $paper->paper_subtype ? 'selected' : '' }}>{{ trans('message.Book Chapter') }}</option>
                                <option value="Erratum" {{ "Erratum" == $paper->paper_subtype ? 'selected' : '' }}>{{ trans('message.Erratum') }}</option>
                                <option value="Review" {{ "Review" == $paper->paper_subtype ? 'selected' : '' }}>{{ trans('message.Review') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpublication" class="col-sm-3 col-form-label">{{ trans('message.Publication') }}</label>
                        <div class="col-sm-9">
                            <select id='publication' class="custom-select my-select" style='width: 200px;' name="publication">
                                <option value="International Journal" {{ "International Journal" == $paper->publication ? 'selected' : '' }}>{{ trans('message.International Journal') }}</option>
                                <option value="International Book" {{ "International Book" == $paper->publication ? 'selected' : '' }}>{{ trans('message.International Book') }}</option>
                                <option value="International Conference" {{ "International Conference" == $paper->publication ? 'selected' : '' }}>{{ trans('message.International Conference') }}</option>
                                <option value="National Conference" {{ "National Conference" == $paper->publication ? 'selected' : '' }}>{{ trans('message.National Conference') }}</option>
                                <option value="National Journal" {{ "National Journal" == $paper->publication ? 'selected' : '' }}>{{ trans('message.National Journal') }}</option>
                                <option value="National Book" {{ "National Book" == $paper->publication ? 'selected' : '' }}> {{ trans('message.National Book') }}</option>
                                <option value="National Magazine" {{ "National Magazine" == $paper->publication ? 'selected' : '' }}>{{ trans('message.National Magazine') }}</option>
                                <option value="Book Chapter" {{ "Book Chapter" == $paper->publication ? 'selected' : '' }}>{{ trans('message.Book Chapter') }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="exampleInputpaper_url" class="col-sm-3 col-form-label">Url</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_url" value="{{ $paper->paper_url }}" class="form-control" placeholder="paper_url">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="exampleInputpaper_sourcetitle" class="col-sm-3 col-form-label">{{ trans('message.Source Title') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_sourcetitle" value="{{ $paper->paper_sourcetitle }}" class="form-control" placeholder="{{ trans('message.Source Title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_yearpub" class="col-sm-3 col-form-label">{{ trans('message.Year Published') }}</label>
                        <div class="col-sm-9">
                            <input type="number" name="paper_yearpub" value="{{ $paper->paper_yearpub }}" class="form-control" placeholder="{{ trans('message.Year Published') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_volume" class="col-sm-3 col-form-label">{{ trans('message.Volume') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_volume" value="{{ $paper->paper_volume }}" class="form-control" placeholder="{{ trans('message.Volume') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_issue" class="col-sm-3 col-form-label">{{ trans('message.Issue Number') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_issue" value="{{ $paper->paper_issue }}" class="form-control" placeholder="{{ trans('message.Issue Number') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_citation" class="col-sm-3 col-form-label">{{ trans('message.Citation') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_citation" value="{{ $paper->paper_citation }}" class="form-control" placeholder="{{ trans('message.Citation') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_page" class="col-sm-3 col-form-label">{{ trans('message.Page') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_page" value="{{ $paper->paper_page }}" class="form-control" placeholder="{{ trans('message.Page') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_doi" class="col-sm-3 col-form-label">{{ trans('message.Doi') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_doi" value="{{ $paper->paper_doi }}" class="form-control" placeholder="{{ trans('message.Doi') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_funder" class="col-sm-3 col-form-label">{{ trans('message.Funder') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_funder" value="{{ $paper->paper_funder }}" class="form-control" placeholder="{{ trans('message.Funder') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputpaper_url" class="col-sm-3 col-form-label">{{ trans('message.URL') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="paper_url" value="{{ $paper->paper_url }}" class="form-control" placeholder="{{ trans('message.URL') }}">
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
                                    @if(isset($paperExternalAuthors) && count($paperExternalAuthors) > 0)
                                    @foreach($paperExternalAuthors as $index => $author)
                                    <tr id="row{{ $index }}">
                                        <td><input type="text" name="fname[]" value="{{ $author->fname }}" placeholder="{{ trans('message.First Name') }}" class="form-control name_list" /></td>
                                        <td><input type="text" name="lname[]" value="{{ $author->lname }}" placeholder="{{ trans('message.Last Name') }}" class="form-control name_list" /></td>
                                        <td>
                                            <select class="custom-select my-select" style='width: 200px;' name="pos2[]">
                                                <option value="1" {{ $author->position == 1 ? 'selected' : '' }}>{{ trans('message.First Author') }}</option>
                                                <option value="2" {{ $author->position == 2 ? 'selected' : '' }}>{{ trans('message.Co-Author') }}</option>
                                                <option value="3" {{ $author->position == 3 ? 'selected' : '' }}>{{ trans('message.Corresponding Author') }}</option>
                                            </select>
                                        </td>
                                        <td>
                                            @if($index > 0)
                                            <button type="button" name="remove" id="{{ $index }}" class="btn btn-danger btn-sm btn_remove">X</button>
                                            @else
                                            <button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td><input type="text" name="fname[]" placeholder="{{ trans('message.First Name') }}" class="form-control name_list" /></td>
                                        <td><input type="text" name="lname[]" placeholder="{{ trans('message.Last Name') }}" class="form-control name_list" /></td>
                                        <td>
                                            <select id='pos2' class="custom-select my-select" style='width: 200px;' name="pos2[]">
                                                <option value="1">{{ trans('message.First Author') }}</option>
                                                <option value="2">{{ trans('message.Co-Author') }}</option>
                                                <option value="3">{{ trans('message.Corresponding Author') }}</option>
                                            </select>
                                        </td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">{{trans('message.submit_button')}}</button>
                    <a class="btn btn-light" href="{{ route('papers.index') }}">{{trans('message.cancel_button')}}</a>
                </form>
            </div>
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $("#head0").select2();
        $("#fund").select2();
        //$("#selUser0").select2();
        var papers = <?php echo $paper['teacher']; ?>;
        var i = 0;
        console.log(papers);
        for (i = 0; i < papers.length; i++) {
            var obj = papers[i];
            //console.log(obj.pivot.author_type)

            $("#dynamicAddRemove").append('<tr><td><select id="selUser' + i + '" name="moreFields[' + i +
                '][userid]"  style="width: 200px;">@foreach($users as $user)<option value="{{ $user->id }}" >{{ $user->fname_th }} {{ $user->lname_th }}</option>@endforeach</select></td><td><select id="pos' + i + '" class="custom-select my-select" style="width: 200px;" name="pos[]"><option value="1">{{ trans("message.First Author") }}</option><option value="2" >{{ trans("message.Co-Author") }}</option><option value="3" >{{ trans("message.Corresponding Author") }}</option></select></td><td><button type="button" class="btn btn-danger btn-sm remove-tr"><i class="mdi mdi-minus"></i></button></td></tr>'
            );
            document.getElementById("selUser" + i).value = obj.id;
            document.getElementById("pos" + i).value = obj.pivot.author_type;
            $("#selUser" + i).select2();
        }

        $("#add-btn2").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><select id="selUser' + i + '" name="moreFields[' + i +
                '][userid]"  style="width: 200px;"><option value="">{{ trans("message.Select User") }}</option>@foreach($users as $user)<option value="{{ $user->id }}">{{ $user->fname_th }} {{ $user->lname_th }}</option>@endforeach</select></td><td><select id="pos" class="custom-select my-select" style="width: 200px;" name="pos[]"><option value="1">{{ trans("message.First Author") }}</option><option value="2">{{ trans("message.Co-Author") }}</option><option value="3">{{ trans("message.Corresponding Author") }}</option></select></td><td><button type="button" class="btn btn-danger btn-sm remove-tr"><i class="mdi mdi-minus"></i></button></td></tr>'
            );
            $("#selUser" + i).select2();
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

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

<script type="text/javascript">
    $(document).ready(function() {
        var i = 1;

        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added">' +
                '<td><input type="text" name="fname[]" placeholder="{{ trans("message.First Name") }}" class="form-control name_list" /></td>' +
                '<td><input type="text" name="lname[]" placeholder="{{ trans("message.Last Name") }}" class="form-control name_list" /></td>' +
                '<td><select class="custom-select my-select" style="width: 200px;" name="pos2[]">' +
                '<option value="1">{{ trans("message.First Author") }}</option>' +
                '<option value="2">{{ trans("message.Co-Author") }}</option>' +
                '<option value="3">{{ trans("message.Corresponding Author") }}</option>' +
                '</select></td>' +
                '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-sm btn_remove">X</button></td>' +
                '</tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id).remove();
        });
    });
</script>
@endsection
<!-- <form action="{{ route('papers.update',$paper->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $paper->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $paper->detail }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form> -->