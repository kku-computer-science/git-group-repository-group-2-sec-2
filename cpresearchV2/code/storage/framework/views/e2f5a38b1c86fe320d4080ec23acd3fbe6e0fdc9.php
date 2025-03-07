
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="justify-content-center">
        <?php if(\Session::has('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e(\Session::get('success')); ?></p>
        </div>
        <?php endif; ?>
        <div class="card" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title"><?php echo e(trans('message.roles')); ?></h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
                <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="<?php echo e(route('roles.create')); ?>"><i class="mdi mdi-plus btn-icon-prepend"></i><?php echo e(trans('message.add')); ?></a>
                <?php endif; ?>

                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th><?php echo e(trans('message.no_dot')); ?></th>
                            <th><?php echo e(trans('message.role_name')); ?></th>
                            <th width="280px"><?php echo e(trans('message.action')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td><?php echo e($i++); ?></td>
                            <td>
                                <?php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                $roleTranslations = [
                                'admin' => ['en' => 'Admin', 'th' => 'ผู้ดูแลระบบ', 'zh' => '管理员'],
                                'teacher' => ['en' => 'Teacher', 'th' => 'อาจารย์', 'zh' => '教师'],
                                'student' => ['en' => 'Student', 'th' => 'นักศึกษา', 'zh' => '学生'],
                                'staff' => ['en' => 'Staff', 'th' => 'เจ้าหน้าที่', 'zh' => '职员'],
                                'head project' => ['en' => 'Head Project', 'th' => 'หัวหน้าโครงการ', 'zh' => '项目负责人'],
                                'project leader' => ['en' => 'Project Leader', 'th' => 'หัวหน้าโครงการ', 'zh' => '项目负责人'],
                                'System Administrator' => ['en' => 'System Administrator', 'th' => 'ผู้ดูแลระบบระบบ', 'zh' => '系统管理员'],
                                'Public Relations Officer' => ['en' => 'Public Relations Officer', 'th' => 'เจ้าหน้าที่ประชาสัมพันธ์', 'zh' => '公关人员'],
                                'Educator' => ['en' => 'Educator', 'th' => 'นักการศึกษา', 'zh' => '教育者'],
                                'Undergrad Student' => ['en' => 'Undergrad Student', 'th' => 'นักศึกษาปริญญาตรี', 'zh' => '本科生'],
                                'Master Student' => ['en' => 'Master Student', 'th' => 'นักศึกษาปริญญาโท', 'zh' => '研究生'],
                                'Doctoral Student' => ['en' => 'Doctoral Student', 'th' => 'นักศึกษาปริญญาเอก', 'zh' => '博士生'],
                                ];
                                ?>

                                <?php if($locale == 'en'): ?>
                                <?php echo e($roleTranslations[$role->name][$locale]); ?>

                                <?php elseif(isset($roleTranslations[$role->name][$locale])): ?>
                                <?php echo e($roleTranslations[$role->name][$locale]); ?>

                                <?php else: ?>
                                <?php echo e($role->name); ?>

                                <?php endif; ?>
                            </td>

                            <td>
                                <form action="<?php echo e(route('roles.destroy',$role->id)); ?>" method="POST">
                                    <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="<?php echo e(route('roles.show',$role->id)); ?>"><i class="mdi mdi-eye"></i></a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-edit')): ?>
                                    <a class="btn btn-outline-success btn-sm " type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo e(route('roles.edit',$role->id)); ?>"><i class="mdi mdi-pencil"></i></a>
                                    <?php endif; ?>


                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-delete')): ?>

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
                <?php echo e($data->render()); ?>

            </div>
        </div>
    </div>
</div>
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

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/roles/index.blade.php ENDPATH**/ ?>