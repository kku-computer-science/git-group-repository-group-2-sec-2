

<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">

<?php $__env->startSection('content'); ?>

<div class="container">
    <?php if($message = Session::get('success')): ?>
    <div class="alert alert-success">
        <p><?php echo e($message); ?></p>
    </div>
    <?php endif; ?>
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title"><?php echo e(trans('message.fund')); ?></h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="<?php echo e(route('funds.create')); ?>"><i class="mdi mdi-plus btn-icon-prepend"></i><?php echo e(trans('message.add')); ?></a>
            <div class="table-responsive">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo e(trans('message.no_dot')); ?></th>
                            <th><?php echo e(trans('message.fund_name')); ?></th>
                            <th><?php echo e(trans('message.fund_type')); ?></th>
                            <th><?php echo e(trans('message.fund_level')); ?></th>
                            <!-- <th>Create by</th> -->
                            <th><?php echo e(trans('message.action')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $funds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$fund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e($i+1); ?></td>
                            <td><?php echo e(Str::limit($fund->fund_name,80)); ?></td>
                            <td>
                                <?php
                                $locale = app()->getLocale();
                                $fundType = $fund->fund_type;

                                if ($locale == 'en') {
                                $translations = [
                                'ทุนภายใน' => 'Internal Fund',
                                'ทุนภายนอก' => 'External Fund',
                                ];
                                $fundType = $translations[$fundType] ?? $fundType;
                                } elseif ($locale == 'zh') {
                                $translations = [
                                'ทุนภายใน' => '内部资金',
                                'ทุนภายนอก' => '外部资金',
                                ];
                                $fundType = $translations[$fundType] ?? $fundType;
                                }
                                ?>
                                <?php echo e($fundType); ?>

                            </td>

                            <td>
                                <?php
                                $locale = app()->getLocale();
                                $fundLevel = $fund->fund_level; // ค่าจาก database

                                if ($locale == 'en') {
                                $translations = [
                                'สูง' => 'High',
                                'กลาง' => 'Medium',
                                'ต่ำ' => 'Low',
                                ];
                                $fundLevel = $translations[$fundLevel] ?? $fundLevel;
                                } elseif ($locale == 'zh') {
                                $translations = [
                                'สูง' => '高',
                                'กลาง' => '中',
                                'ต่ำ' => '低',
                                ];
                                $fundLevel = $translations[$fundLevel] ?? $fundLevel;
                                }
                                ?>
                                <?php echo e($fundLevel); ?>

                            </td>
                            <!-- <td><?php echo e($fund->user->fname_en); ?> <?php echo e($fund->user->lname_en); ?></td> -->

                            <td>
                                <?php echo csrf_field(); ?>
                                <form action="<?php echo e(route('funds.destroy',$fund->id)); ?>" method="POST">
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="<?php echo e(route('funds.show',$fund->id)); ?>"><i class="mdi mdi-eye"></i></a>
                                    </li>
                                    <?php if(Auth::user()->can('update',$fund)): ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo e(route('funds.edit',Crypt::encrypt($fund->id))); ?>"><i class="mdi mdi-pencil"></i></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(Auth::user()->can('delete',$fund)): ?>
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <li class="list-inline-item">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-outline-danger btn-sm show_confirm" type="submit" data-toggle="tooltip" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </li>


                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
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
        var table = $('#example1').DataTable({
            fixedHeader: true,
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

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/funds/index.blade.php ENDPATH**/ ?>