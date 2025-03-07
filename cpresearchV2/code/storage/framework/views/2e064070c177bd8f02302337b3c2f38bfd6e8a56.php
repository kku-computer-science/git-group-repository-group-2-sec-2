
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="justify-content-center">
        <?php if(\Session::has('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e(\Session::get('success')); ?></p>
        </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><?php echo e(trans('message.permissions')); ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-create')): ?>
                <span class="float-right">
                    <a class="btn btn-primary" href="<?php echo e(route('permissions.create')); ?>"><?php echo e(trans('message.permission_new')); ?></a>
                </span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <table id ="example1" class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th><?php echo e(trans('message.no_dot')); ?></th>
                            <th><?php echo e(trans('message.permission_name')); ?></th>
                            <th width="280px"><?php echo e(trans('message.action')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($permission->id); ?></td>
                            <td><?php echo e($permission->name); ?></td>
                            <td>
                                <form action="<?php echo e(route('permissions.destroy',$permission->id)); ?>" method="POST">
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="<?php echo e(route('permissions.show',$permission->id)); ?>"><i class="mdi mdi-eye"></i></a>
                                    </li>

                                    <!-- <a class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="view" href="<?php echo e(route('permissions.show',$permission->id)); ?>"><i class="fa fa-table"></i></a> -->
                                    <!-- <a class="btn btn-success" href="<?php echo e(route('permissions.show',$permission->id)); ?>">Show</a> -->
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-edit')): ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo e(route('permissions.edit',$permission->id)); ?>"><i class="mdi mdi-pencil"></i></a>
                                    </li>
                                    <!-- <a class="btn btn-primary" href="<?php echo e(route('permissions.edit',$permission->id)); ?>">Edit</a> -->
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-delete')): ?>
                                    <!-- <?php echo Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']); ?>

                                <?php echo Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit','class' => 'btn btn-danger btn-sm rounded-0','type'=>'button','data-toggle'=>'tooltip' ,'data-placement'=>'top', 'title'=>'Delete']); ?>

                                <?php echo Form::close(); ?> -->
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <li class="list-inline-item">
                                        <button class="btn btn-outline-danger btn-sm show_confirm" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </li>

                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="justify-content-center">

            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
<script src = "https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js" defer ></script>
<script src = "https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" defer ></script>
<script>
    $(document).ready(function() {
        var table1 = $('#example1').DataTable({
            responsive: true,
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
            }
        });
    });
</script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `<?php echo e(trans('message.Are_You_Sure')); ?>`,
                text: `<?php echo e(trans('message.Delete_Warning')); ?>`,
                icon: "warning",
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
            })
            .then((willDelete) => {
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
                        form.submit();
                    });
                }
            });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/permissions/index.blade.php ENDPATH**/ ?>