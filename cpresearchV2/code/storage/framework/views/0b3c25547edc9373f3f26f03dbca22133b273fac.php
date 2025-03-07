
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="justify-content-center">
        <?php if(\Session::has('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e(\Session::get('success')); ?></p>
        </div>
        <?php endif; ?>
        <div class="card col-8" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title"><?php echo e(trans('message.roles')); ?></h4>
                <p class="card-description"><?php echo e(trans('message.details_info')); ?></p>
                <div class="row">
                    <p class="card-text col-sm-3"><b><?php echo e(trans('message.name')); ?> </b></p>
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
?>

<p class="card-text col-sm-9">
    <?php if($locale == 'th' || $locale == 'zh' || $locale == 'en'): ?>
        <?php echo e(isset($roleMap[$role->name]) ? $roleMap[$role->name] : $role->name); ?>

    <?php else: ?>
        <?php echo e($role->name); ?>

    <?php endif; ?>
</p>
                </div>
                <div class="row mt-3">
                    <p class="card-text col-sm-3"><b><?php echo e(trans('message.permissions')); ?></b></p>
                    <?php if(!empty($rolePermissions)): ?>
                    <p class="card-text col-sm-9" style="line-height: 1.85rem;"><?php $__currentLoopData = $rolePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label
                            class="badge badge-success"> <?php echo e($permission->name); ?> </label>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></p>
                    <?php endif; ?>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
                <a class="btn btn-primary mt-5" href="<?php echo e(route('roles.index')); ?>"><?php echo e(trans('message.back')); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/roles/show.blade.php ENDPATH**/ ?>