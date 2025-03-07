
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<?php $__env->startSection('content'); ?>
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
<?php if($message = Session::get('success')): ?>
<div class="alert alert-success">
    <p id="msg"><?php echo e($message); ?></p>
</div>
<?php endif; ?> -->
<div class="container">
    <?php if($message = Session::get('success')): ?>
    <div class="alert alert-success">
        <p><?php echo e($message); ?></p>
    </div>
    <?php endif; ?>
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center;"><?php echo e(trans('message.expertise')); ?></h4>
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo e(trans('message.no_dot')); ?></th>
                        <?php if(Auth::user()->hasRole('admin')): ?>
                        <th><?php echo e(trans('message.expertise_teacher_name')); ?></th>
                        <?php endif; ?>
                        <th><?php echo e(trans('message.expertise_name')); ?></th>

                        <th><?php echo e(trans('message.action')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $experts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $expert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="expert_id_<?php echo e($expert->id); ?>">
                        <td><?php echo e($i+1); ?></td>
                        <?php if(Auth::user()->hasRole('admin')): ?>
                        <td>
                            <?php if(app()->getLocale() == 'th'): ?>
                            <?php echo e($expert->user->fname_th); ?> <?php echo e($expert->user->lname_th); ?>

                            <?php else: ?>
                            <?php echo e($expert->user->fname_en); ?> <?php echo e($expert->user->lname_en); ?>

                            <?php endif; ?>
                        </td>

                        <?php endif; ?>
                            <?php
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
                            ?>
                        <td><?php echo e($display_expert_name); ?></td>
                        <td>
                            <form action="<?php echo e(route('experts.destroy',$expert->id)); ?>" method="POST">
                                <!-- <a class="btn btn-info" id="show-expertise" data-toggle="modal" data-id="<?php echo e($expert->id); ?>">Show</a> -->
                                <li class="list-inline-item">
                                    <!-- <a class="btn btn-success btn-sm rounded-0" href="javascript:void(0)" id="edit-expertise" type="button" data-toggle="modal" data-placement="top" data-id="<?php echo e($expert->id); ?>" title="Edit"><i class="fa fa-edit"></i></a> -->
                                    <a class="btn btn-outline-success btn-sm" id="edit-expertise" type="button" data-toggle="modal" data-id="<?php echo e($expert->id); ?>" data-placement="top" title="Edit" href="javascript:void(0)"><i class="mdi mdi-pencil"></i></a>

                                </li>

                                <!-- <a href="javascript:void(0)" class="btn btn-success" id="edit-expertise" data-toggle="modal" data-id="<?php echo e($expert->id); ?>">Edit </a> -->
                                <?php echo csrf_field(); ?>
                                <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
                                <li class="list-inline-item">
                                    <button class="btn btn-outline-danger btn-sm show_confirm" id="delete-expertise" type="submit" data-id="<?php echo e($expert->id); ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-delete"></i></button>

                                </li>
                                <!-- <a id="delete-expertise" data-id="<?php echo e($expert->id); ?>" class="btn btn-danger delete-user">Delete</a> -->

                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <h4 class="modal-title" id="expertiseCrudModal"><?php echo e(trans('message.edit_expertise')); ?></h4>
            </div>
            <div class="modal-body">
                <form name="expForm" action="<?php echo e(route('experts.store')); ?>" method="POST">
                    <input type="hidden" name="exp_id" id="exp_id">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><?php echo e(trans('message.name_expertise')); ?>:</strong>
                                <input type="text" name="expert_name" id="expert_name" class="form-control" placeholder='<?php echo e(trans('message.expertise_holder')); ?>' onchange="validate()">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary " disabled><?php echo e(trans('message.submit_button')); ?></button>
                            <a href="<?php echo e(route('experts.index')); ?>" class="btn btn-danger"><?php echo e(trans('message.cancel_button')); ?></a>
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
                search: `<?php echo e(trans('message.search')); ?>:`,
                lengthMenu: `<?php echo e(trans('message.show')); ?> _MENU_ <?php echo e(trans('message.entries')); ?>`,
                info: `<?php echo e(trans('message.showing')); ?> _START_ <?php echo e(trans('message.to')); ?> _END_ <?php echo e(trans('message.of')); ?> _TOTAL_ <?php echo e(trans('message.entries')); ?>`,
                paginate: {
                    next: `<?php echo e(trans('message.next')); ?>`,
                    previous: `<?php echo e(trans('message.previous')); ?>`
                },
                emptyTable: `<?php echo e(trans('message.empty_table')); ?>`,
                zeroRecords: `<?php echo e(trans('message.zero_record')); ?>`,
                infoEmpty: `<?php echo e(trans('message.showing')); ?> 0 <?php echo e(trans('message.to')); ?> 0 <?php echo e(trans('message.of')); ?> 0 <?php echo e(trans('message.entries')); ?>`,
                infoFiltered: `(<?php echo e(trans('message.filtered')); ?> <?php echo e(trans('message.from')); ?> _MAX_ <?php echo e(trans('message.entries')); ?>)`,
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
                $('#expertiseCrudModal').html("<?php echo e(trans('message.edit_expertise')); ?>");
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
                title: `<?php echo e(trans('message.Are_You_Sure')); ?>`,
                text: `<?php echo e(trans('message.Delete_Warning')); ?>`,
                type: "warning",
                buttons: true,
                dangerMode: true,
                buttons: {
                    cancel: {
                        text: `<?php echo e(trans('message.Cancel')); ?>`,
                        visible: true,
                        className: "btn btn-secondary"
                    },
                    confirm: {
                        text: `<?php echo e(trans('message.OK')); ?>`,
                        className: "btn btn-danger"
                    }
                },
            }).then((willDelete) => {
                if (willDelete) {
                    swal(`<?php echo e(trans('message.Delete_Warning')); ?>`, {
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: `<?php echo e(trans('message.OK')); ?>`,
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/expertise/index.blade.php ENDPATH**/ ?>