@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
@section('content')
<!-- <div class="row">
    <div class="col-lg-12" style="text-align: center">
        <div>
            <h2>ความเชี่ยวชาญ</h2>
        </div>
        <br />
    </div>
</div> -->
<!-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-expertise" data-toggle="modal">Add
                Expertise</a>
        </div>
    </div>
</div> -->
<!-- <br />
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p id="msg">{{ $message }}</p>
</div>
@endif -->
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center;">{{trans('message.expertise')}}</h4>
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{trans('message.no_dot')}}</th>
                        @if(Auth::user()->hasRole('admin'))
                        <th>{{trans('message.expertise_teacher_name')}}</th>
                        @endif
                        <th>{{trans('message.expertise_name')}}</th>

                        <th>{{trans('message.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experts as $i => $expert)
                    <tr id="expert_id_{{ $expert->id }}">
                        <td>{{ $i+1 }}</td>
                        @if(Auth::user()->hasRole('admin'))
                        <td>
                            @if(app()->getLocale() == 'th')
                            {{ $expert->user->fname_th }} {{ $expert->user->lname_th }}
                            @else
                            {{ $expert->user->fname_en }} {{ $expert->user->lname_en }}
                            @endif
                        </td>

                        @endif
                            @php
                            $locale = app()->getLocale();
                            $expert_name = trim($expert->expert_name); // ตัดช่องว่างออก
                            $expert_name_key = 'message.expertise_translation.' . $expert_name;
                            $translated_expert_name = null;

                            // ตรวจจับเฉพาะ Smart X แล้วใช้ key พิเศษ
                            if ($expert_name === 'Smart X: Smart Farm, Home, Health-care, Car, Building, Device, etc.') {
                            if ($locale == 'th') {
                            $translated_expert_name = trans('message.expertise_translation.smart_x');
                            } elseif ($locale == 'zh') {
                            $translated_expert_name = trans('message.expertise_translation.smart_x');
                            } else {
                            $translated_expert_name = trans('message.smart_x');
                            }
                            } else {
                            $translated_expert_name = trans($expert_name_key);
                            }

                            // ถ้าไม่มีคำแปล ให้ใช้ค่าจาก Database
                            $display_expert_name = ($translated_expert_name !== $expert_name_key) ? $translated_expert_name : $expert_name;
                            @endphp
                        <td>{{ $display_expert_name }}</td>
                        <td>
                            <form action="{{ route('experts.destroy',$expert->id) }}" method="POST">
                                <!-- <a class="btn btn-info" id="show-expertise" data-toggle="modal" data-id="{{ $expert->id }}">Show</a> -->
                                <li class="list-inline-item">
                                    <!-- <a class="btn btn-success btn-sm rounded-0" href="javascript:void(0)" id="edit-expertise" type="button" data-toggle="modal" data-placement="top" data-id="{{ $expert->id }}" title="Edit"><i class="fa fa-edit"></i></a> -->
                                    <a class="btn btn-outline-success btn-sm" id="edit-expertise" type="button" data-toggle="modal" data-id="{{ $expert->id }}" data-placement="top" title="Edit" href="javascript:void(0)"><i class="mdi mdi-pencil"></i></a>

                                </li>

                                <!-- <a href="javascript:void(0)" class="btn btn-success" id="edit-expertise" data-toggle="modal" data-id="{{ $expert->id }}">Edit </a> -->
                                @csrf
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <li class="list-inline-item">
                                    <button class="btn btn-outline-danger btn-sm show_confirm" id="delete-expertise" type="submit" data-id="{{ $expert->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-delete"></i></button>

                                </li>
                                <!-- <a id="delete-expertise" data-id="{{ $expert->id }}" class="btn btn-danger delete-user">Delete</a> -->

                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Add and Edit expertise modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="expertiseCrudModal">{{trans('message.edit_expertise')}}</h4>
            </div>
            <div class="modal-body">
                <form name="expForm" action="{{ route('experts.store') }}" method="POST">
                    <input type="hidden" name="exp_id" id="exp_id">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans('message.name_expertise')}}:</strong>
                                <input type="text" name="expert_name" id="expert_name" class="form-control" placeholder='{{trans('message.expertise_holder')}}' onchange="validate()">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary " disabled>{{trans('message.submit_button')}}</button>
                            <a href="{{ route('experts.index') }}" class="btn btn-danger">{{trans('message.cancel_button')}}</a>
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
<script src="https://cdn.datatables.net/rowgroup/1.2.0/js/dataTables.rowGroup.min.js" defer></script>
<script>
    $(document).ready(function() {
        var table1 = $(' #example1').DataTable({

            order: [
                [1, 'asc']
            ],
            rowGroup: {
                dataSrc: 1
            },
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
                a
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /* When click New expertise button */
        $('#new-expertise').click(function() {
            $('#btn-save').val("create-expertise");
            $('#expertise').trigger("reset");
            $('#expertiseCrudModal').html(
                "Add New Expertise"
            );
            $('#crud-modal').modal('show');
        });

        /* Edit expertise */
        $('body').on('click', '#edit-expertise', function() {
            var expert_id = $(this).data('id');
            $.get('experts/' + expert_id + '/edit', function(data) {
                $('#expertiseCrudModal').html("{{trans('message.edit_expertise')}}");
                $('#btn-update').val("Update");
                $('#btn-save').prop('disabled', false);
                $('#crud-modal').modal('show');
                $('#exp_id').val(data.id);
                $('#expert_name').val(data.expert_name);

            })
        });


        /* Delete expertise */
        $('body').on('click', '#delete-expertise', function(e) {
            var expert_id = $(this).data("id");

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
                            url: "experts/" + expert_id,
                            data: {
                                "id": expert_id,
                                "_token": token,
                            },
                            success: function(data) {
                                $('#msg').html('program entry deleted successfully');
                                $("#expert_id_" + expert_id).remove();
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
        if (document.expForm.expert_name.value != '')
            document.expForm.btnsave.disabled = false
        else
            document.expForm.btnsave.disabled = true
    }
</script>
@stop
