@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<style type="text/css">
    .dropdown-toggle {
        height: 40px;
        width: 400px !important;
    }

    body label:not(.input-group-text) {
        margin-top: 10px;
    }

    body .my-select {
        background-color: #EFEFEF;
        color: #212529;
        border: 0 none;
        border-radius: 10px;
        padding: 6px 20px;
        width: 100%;
    }
</style>
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center;">{{trans('message.programs')}}</h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="javascript:void(0)" id="new-program" data-toggle="modal"><i class="mdi mdi-plus btn-icon-prepend"></i>{{trans('message.add')}}</a>
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{trans('message.no_dot')}}</th>
                        <th>{{trans('message.program_name')}}</th>
                        <!-- <th>Name (Eng)</th> -->
                        <th>{{trans('message.program_degree')}}</th>
                        <th>{{trans('message.action')}}
                            </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $i => $program)
                    <tr id="program_id_{{ $program->id }}">
                        <td>{{ $i+1 }}</td>
                        <td>
                            @if(app()->getLocale() == 'th')
                            {{ $program->program_name_th }}
                            @elseif(app()->getLocale() == 'zh')
                            {{ $program->program_name_zh  ?? $program->program_name_en }}
                            @else
                            {{ $program->program_name_en }}
                            @endif
                        </td>

                        <!-- <td>{{ $program->program_name_en }}</td> -->
                        <td>
                            @if(app()->getLocale() == 'th')
                            {{ $program->degree->degree_name_th }}
                            @elseif(app()->getLocale() == 'zh')
                            {{ $program->degree->degree_name_zh ?? $program->degree->degree_name_en }}
                            @else
                            {{ $program->degree->degree_name_en }}
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('programs.destroy',$program->id) }}" method="POST">
                                <!-- <a class="btn btn-info" id="show-program" data-toggle="modal" data-id="{{ $program->id }}">Show</a> -->

                                <!-- <a class="btn btn-outline-primary btn-sm" id="show-program" type="button" data-toggle="modal" data-placement="top" title="view" data-id="{{ $program->id }}"><i class="mdi mdi-eye"></i></a>
                                     -->
                                <!-- <a href="javascript:void(0)" class="btn btn-success" id="edit-program" data-toggle="modal" data-id="{{ $program->id }}">Edit </a> -->
                                <li class="list-inline-item">
                                    <a class="btn btn-outline-success btn-sm" id="edit-program" type="button" data-toggle="modal" data-id="{{ $program->id }}" data-placement="top" title="Edit" href="javascript:void(0)"><i class="mdi mdi-pencil"></i></a>
                                </li>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <li class="list-inline-item">
                                    <button class="btn btn-outline-danger btn-sm " id="delete-program" type="submit" data-id="{{ $program->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-delete"></i></button>
                                </li>
                            </form>
                            <!-- <a id="delete-program" data-id="{{ $program->id }}" class="btn btn-danger delete-user">Delete</a> -->

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Add and Edit program modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="programCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form name="proForm" action="{{ route('programs.store') }}" method="POST">
                    <input type="hidden" name="pro_id" id="pro_id">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
    <strong>{{ trans('message.Education_Level') }}:</strong>
    <div class="col-sm-8">
        <select id="degree" class="custom-select my-select" name="degree">
            @foreach($degree as $d)
            @php
                $locale = app()->getLocale();
                if ($locale === 'th') {
                    $degree_name = $d->degree_name_th;
                } elseif ($locale === 'zh') {
                    $degree_name = $d->degree_name_zh;
                } else {
                    $degree_name = $d->degree_name_en;
                }
            @endphp
                <option value="{{ $d->id }}">{{ $degree_name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <strong>{{ trans('message.Academic_Program') }}:</strong>
    <div class="col-sm-8">
        <select id="department" class="custom-select my-select" name="department">
            @foreach($department as $d)
            @php
                $locale = app()->getLocale();
                if ($locale === 'th') {
                    $department_name = $d->department_name_th;
                } elseif ($locale === 'zh') {
                    $department_name = $d->department_name_zh;
                } else {
                    $department_name = $d->department_name_en;
                }
            @endphp
                <option value="{{ $d->id }}">{{ $department_name }}</option>
            @endforeach
        </select>
    </div>
</div>

                        <div class="form-group">
                            <strong>{{ trans('message.Name_TH') }}:</strong>
                            <input type="text" name="program_name_th" id="program_name_th" class="form-control" 
                                placeholder="{{ trans('message.placeholder_program_name_th') }}" onchange="validate()">
                        </div>
                        <div class="form-group">
                            <strong>{{ trans('message.Name_EN') }}:</strong>
                            <input type="text" name="program_name_en" id="program_name_en" class="form-control" 
                                placeholder="{{ trans('message.placeholder_program_name_en') }}" onchange="validate()">
                        </div>
                        <div class="form-group">
                            <strong>{{ trans('message.Name_ZH') }}:</strong>
                            <input type="text" name="program_name_zh" id="program_name_zh" class="form-control" 
                                placeholder="{{ trans('message.placeholder_program_name_zh') }}" onchange="validate()">
</div>
                            <!-- <div class="form-group">
                                <strong>ระดับการศึกษา:</strong>
                                <input type="text" name="degree_id" id="degree_id" class="form-control" placeholder="degree_id" onchange="validate()">
                            </div> -->

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>{{trans('message.Submit')}}</button>
                            <a href="{{ route('programs.index') }}" class="btn btn-danger">{{trans('message.Cancle')}}</a>
                            <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" defer></script>
<script>
    $(document).ready(function() {
        var table1 = $('#example1').DataTable({
            responsive: true,
            searching: true,
            lengthChange: true,
            language: {
                search: `{{trans('message.search')}}:`,
                lengthMenu: `{{trans('message.show')}} _MENU_ {{trans('message.entries')}}`,
                info: `{{trans('message.showing')}} _START_ {{trans('message.to')}} _END_ {{trans('message.of')}} _TOTAL_ {{trans('message.entries')}}`,
                paginate: {
                    next: `{{trans('message.next')}}`,
                    previous: `{{trans('message.previous')}}`
                },
                emptyTable: `{{trans('message.empty_table')}}`,
                zeroRecords: `{{trans('message.zero_record')}}`,
                infoEmpty: `{{trans('message.showing')}} 0 {{trans('message.to')}} 0 {{trans('message.of')}} 0 {{trans('message.entries')}}`,
                infoFiltered: `({{trans('message.filtered')}} {{trans('message.from')}} _MAX_ {{trans('message.entries')}})`,
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        /* When click New program button */
        $('#new-program').click(function() {
            $('#btn-save').val("create-program");
            $('#program').trigger("reset");
            $('#programCrudModal').html("{{trans('message.Add_New_Program')}}");
            $('#crud-modal').modal('show');
        });

        /* Edit program */
        $('body').on('click', '#edit-program', function() {
            var program_id = $(this).data('id');
            $.get('programs/' + program_id + '/edit', function(data) {
                $('#programCrudModal').html("{{ trans('message.Edit_Program') }}");
                $('#btn-update').val("Update");
                $('#btn-save').prop('disabled', false);
                $('#crud-modal').modal('show');
                $('#pro_id').val(data.id);
                $('#program_name_th').val(data.program_name_th);
                $('#program_name_en').val(data.program_name_en);
                //$('#degree').val(data.program_name_en);
                $('#degree').val(data.degree_id);
            })
        });


        /* Delete program */
        $('body').on('click', '#delete-program', function(e) {
            var program_id = $(this).data("id");

            var token = $("meta[name='csrf-token']").attr("content");
            e.preventDefault();
            //confirm("Are You sure want to delete !");
            swal({
                title: `{{trans('message.Are_You_Sure')}}`,
                text: `{{trans('message.Delete_Warning')}}`,
                type: "warning",
                buttons: true,
                dangerMode: true,
                buttons: {
                    cancel: {
                        text: `{{trans('message.Cancel')}}`,
                        visible: true,
                        className: "btn btn-secondary"
                    },
                    confirm: {
                        text: `{{trans('message.OK')}}`,
                        className: "btn btn-danger"
                    }
                },
            }).then((willDelete) => {
                if (willDelete) {
                    swal(`{{trans('message.Delete_Warning')}}`, {
                        icon: "success",
                        buttons: {
                        confirm: {
                            text: `{{trans('message.OK')}}`,
                            className: "btn btn-info"
                        }
                    },
                    }).then(function() {
                        location.reload();
                        $.ajax({
                            type: "DELETE",
                            url: "programs/" + program_id,
                            data: {
                                "id": program_id,
                                "_token": token,
                            },
                            success: function(data) {
                                $('#msg').html('program entry deleted successfully');
                                $("#program_id_" + program_id).remove();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                    });

                }
            });
        });
    });
</script>
<script>
    error = false

    function validate() {
        if (document.proForm.program_name_th.value != '' && document.proForm.program_name_en.value != '')
            document.proForm.btnsave.disabled = false
        else
            document.proForm.btnsave.disabled = true
    }
</script>
@stop
