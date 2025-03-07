
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="justify-content-center">
            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <strong><?php echo e(trans('message.Whoops!')); ?></strong>
                    <?php echo e(trans('message.There were some problems with your input.')); ?><br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php
                $locale = app()->getLocale();
                $roleMap = [];
                if ($locale == 'th') {
                    $roleMap = [
                        'admin' => 'ผู้ดูแลระบบ',
                        'teacher' => 'อาจารย์',
                        'student' => 'นักศึกษา',
                        'staff' => 'เจ้าหน้าที่',
                        'head project' => 'หัวหน้าโครงการ',
                        'project leader' => 'หัวหน้าโครงการ',
                        'System Administrator' => 'ผู้ดูแลระบบระบบ',
                        'Public Relations Officer' => 'เจ้าหน้าที่ประชาสัมพันธ์',
                        'Educator' => 'นักการศึกษา',
                        'Undergrad Student' => 'นักศึกษาปริญญาตรี',
                        'Master Student' => 'นักศึกษาปริญญาโท',
                        'Doctoral Student' => 'นักศึกษาปริญญาเอก',
                    ];
                } elseif ($locale == 'zh') {
                    $roleMap = [
                        'admin' => '管理员',
                        'teacher' => '教师',
                        'student' => '学生',
                        'staff' => '职员',
                        'head project' => '项目负责人',
                        'project leader' => '项目负责人',
                        'System Administrator' => '系统管理员',
                        'Public Relations Officer' => '公关人员',
                        'Educator' => '教育者',
                        'Undergrad Student' => '本科生',
                        'Master Student' => '研究生',
                        'Doctoral Student' => '博士生',
                    ];
                } else {
                    $roleMap = [
                        'admin' => 'Admin',
                        'teacher' => 'Teacher',
                        'student' => 'Student',
                        'staff' => 'Staff',
                        'head project' => 'Head Project',
                        'project leader' => 'Project Leader',
                        'System Administrator' => 'System Administrator',
                        'Public Relations Officer' => 'Public Relations Officer',
                        'Educator' => 'Educator',
                        'Undergrad Student' => 'Undergrad Student',
                        'Master Student' => 'Master Student',
                        'Doctoral Student' => 'Doctoral Student',
                    ];
                }
                $roleNameTranslated = $roleMap[$role->name] ?? $role->name;
            ?>
            <div class="card col-8" style="padding: 16px;">
                <div class="card-body">
                    <h4 class="card-title"><?php echo e(trans('message.edit_role')); ?></h4>
                    <?php echo Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PATCH']); ?>

                    <div class="form-group row">
                        <p class="col-sm-3"><?php echo e(trans('message.role_name')); ?></p>
                        <div class="col-sm-8">
                            <?php echo Form::hidden('name', $role->name); ?>

                            <p><?php echo e($roleNameTranslated); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="col-sm-3"><?php echo e(trans('message.permission')); ?></p>
                        <div class="col-sm-9">
                            <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p><?php echo e(Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name'])); ?>

                                    <?php echo e($value->name); ?>

                                </p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5"><?php echo e(trans('message.Submit')); ?></button>
                    <a class="btn btn-light mt-5" href="<?php echo e(route('roles.index')); ?>"><?php echo e(trans('message.back')); ?></a>
                    <?php echo Form::close(); ?>



                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/roles/edit.blade.php ENDPATH**/ ?>