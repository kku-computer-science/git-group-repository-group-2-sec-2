@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
    <style>
        .my-select {
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
        <div class="row">
            <div class="col-lg-12 margin-tb">
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>{{trans('message.Whoops!')}}</strong>
                {{trans('message.There were some problems with your input.')}}<br><br>
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
                    <h4 class="card-title">{{trans('message.patents_edit_details')}}</h4>
                    <p class="card-description">{{trans('message.patents_enter_details')}}</p>
                    <form class="forms-sample" action="{{ route('patents.update', $patent->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="exampleInputac_name"
                                class="col-sm-3 col-form-label">{{trans('message.patents_name')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="ac_name" value="{{ $patent->ac_name }}" class="form-control"
                                    placeholder={{trans('message.patents_name')}}>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputac_type"
                                class="col-sm-3 col-form-label">{{trans('message.patents_type')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="ac_type" value="{{ $patent->ac_type }}" class="form-control"
                                    placeholder={{trans('message.patents_type')}}>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputac_year"
                                class="col-sm-3 col-form-label">{{trans('message.date_of_rights')}}</label>
                            <div class="col-sm-9">
                                <input type="date" name="ac_year" value="{{ $patent->ac_year }}" class="form-control"
                                    placeholder={{trans('message.Year (AD)')}}>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputac_refnumber"
                                class="col-sm-3 col-form-label">{{trans('message.registration_number')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="ac_refnumber" value="{{ $patent->ac_refnumber }}"
                                    class="form-control" placeholder={{trans('message.registration_number')}}>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                                <label for="exampleInputac_author" class="col-sm-3 col-form-label">ชื่อผู้รับผิดชอบ</label>
                                <div class="col-sm-9">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <tr>
                                                <td></td>

                                                <td><button type="button" name="add" id="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></td>
                                            </tr>
                                        </table>
                                        <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> 
                                    </div>
                                </div>
                            </div> -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{trans('message.internal_professors')}}</label>
                            <div class="col-sm-9">
                                <table class="table table-bordered " id="dynamicAddRemove">
                                    <tr>
                                        <th><button type="button" name="add" id="add-btn2"
                                                class="btn btn-success btn-sm add"><i class="mdi mdi-plus"></i></button>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInput" class="col-sm-3 ">{{trans('message.external_persons')}}</label>
                            <div class="col-sm-9">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dynamic_field">

                                        <tr>
                                            <td><button type="button" name="add" id="add" class="btn btn-success btn-sm"><i
                                                        class="fas fa-plus"></i></button>
                                            </td>
                                        </tr>

                                    </table>
                                    <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> -->
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary me-2 mt-5">{{trans('message.Submit')}}</button>
                        <a class="btn btn-light mt-5" href="{{ route('patents.index') }}">{{trans('message.Cancel')}}</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {


            var patent = <?php echo $patent->user; ?>;
            var i = 0;
            var locale = '{{ config('app.locale') }}';

            for (i = 0; i < patent.length; i++) {
                console.log(patent);
                var obj = patent[i];
                var nameOptions = '';

                // Conditional language display
                @foreach($users as $user)
                    if (locale === 'th') {
                        nameOptions += `<option value="{{ $user->id }}">{{ $user->fname_th }} {{ $user->lname_th }}</option>`;
                    } else {
                        nameOptions += `<option value="{{ $user->id }}">{{ $user->fname_en }} {{ $user->lname_en }}</option>`;
                    }
                @endforeach

                $("#dynamicAddRemove").append('<tr><td><select id="selUser' + i + '" name="moreFields[' + i +
                    '][userid]"  style="width: 200px;">' + nameOptions + '</select></td><td><button type="button" class="btn btn-danger btn-sm remove-tr"><i class="mdi mdi-minus"></i></button></td></tr>'
                );

                document.getElementById("selUser" + i).value = obj.id;
                $("#selUser" + i).select2();
            }

            $("#add-btn2").click(function () {
                ++i;
                var nameOptions = '<option value="">Select User</option>';

                // Conditional language display
                @foreach($users as $user)
                    if (locale === 'th') {
                        nameOptions += `<option value="{{ $user->id }}">{{ $user->fname_th }} {{ $user->lname_th }}</option>`;
                    } else {
                        nameOptions += `<option value="{{ $user->id }}">{{ $user->fname_en }} {{ $user->lname_en }}</option>`;
                    }
                @endforeach

                $("#dynamicAddRemove").append('<tr><td><select id="selUser' + i + '" name="moreFields[' + i +
                    '][userid]"  style="width: 200px;">' + nameOptions + '</select></td><td><button type="button" class="btn btn-danger btn-sm remove-tr"><i class="mdi mdi-minus"></i></button></td></tr>'
                );

                $("#selUser" + i).select2();
            });
            $(document).on('click', '.remove-tr', function () {
                $(this).parents('tr').remove();
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var patent = <?php echo $patent->author; ?>;

            var postURL = "<?php echo url('addmore'); ?>";
            var i = 0;
            //console.log(patent)

            for (i = 0; i < patent.length; i++) {
                //console.log(patent);
                var obj = patent[i];
                $("#dynamic_field").append('<tr id="row' + i +
                    '" class="dynamic-added"><td><input type="text" name="fname[]" value="' + obj.author_fname + '" placeholder="Enter your Name" class="form-control name_list" /></td><td><input type="text" name="lname[]" value="' + obj.author_lname + '" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');
                //document.getElementById("selUser" + i).value = obj.id;
                //console.log(obj.author_fname)
                // let doc=document.getElementById("row" + i)
                // doc.setAttribute('fname','aaa');
                // doc.setAttribute('lname','bbb');
                //document.getElementById("row" + i).value = obj.author_lname;
                //document.getAttribute("lname").value = obj.author_lname;
                //$("#selUser" + i).select2()


                //document.getElementById("#dynamicAddRemove").value = "10";
            }

            $('#add').click(function () {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '" class="dynamic-added"><td><input type="text" name="fname[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><input type="text" name="lname[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>
@endsection