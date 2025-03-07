
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="justify-content-center">
        <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <strong>Oops!</strong> Something went wrong, please check below errors.<br><br>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>
        <div class="card col-8" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title"><?php echo e(trans('message.edit_user')); ?></h4>
                <p class="card-description"><?php echo e(trans('message.edit_user_details')); ?></p>
                <?php echo Form::model($user, ['route' => ['users.update', $user->id], 'method'=>'PATCH']); ?>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <p><b><?php echo e(trans('message.First_Name_TH')); ?></b></p>
                        <input type="text" name="fname_th" value="<?php echo e($user->fname_th); ?>" class="form-control" placeholder="<?php echo e($user->fname_th); ?>">
                    </div>
                    <div class="col-sm-6">
                        <p><b><?php echo e(trans('message.Last_Name_TH')); ?></b></p>
                        <input type="text" name="lname_th" value="<?php echo e($user->lname_th); ?>" class="form-control" placeholder="<?php echo e($user->lname_th); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <p><b><?php echo e(trans('message.First_Name_EN')); ?></b></p>
                        <input type="text" name="fname_en" value="<?php echo e($user->fname_en); ?>" class="form-control" placeholder="<?php echo e($user->fname_en); ?>">
                    </div>
                    <div class="col-sm-6">
                        <p><b><?php echo e(trans('message.Last_Name_EN')); ?></b></p>
                        <input type="text" name="lname_en" value="<?php echo e($user->lname_en); ?>" class="form-control" placeholder="<?php echo e($user->lname_en); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b><?php echo e(trans('message.Email')); ?></b></p>
                    <div class="col-sm-8">
                        <input type="text" name="email" value="<?php echo e($user->email); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b><?php echo e(trans('message.Password')); ?></b></p>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b><?php echo e(trans('message.Confirm_Password')); ?></b></p>
                    <div class="col-sm-8">
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
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
                <div class="form-group row">
                    <p class="col-sm-3"><b><?php echo e(trans('message.Role')); ?></b></p>
                    <div class="col-sm-8">
                        <?php echo Form::select('roles[]', $roleMap, $userRole, array('class' => 'selectpicker','multiple data-live-search'=>"true")); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-sm-3"><b><?php echo e(trans('message.edit_user_status')); ?></b></p>
                    <div class="col-sm-8">
                        <select id='status' class="form-control" style='width: 200px;' name="status">
                            <option value="1" <?php echo e("1" == $user->status ? 'selected' : ''); ?>><?php echo e(trans('message.edit_user_studying')); ?></option>
                            <option value="2" <?php echo e("2" == $user->status ? 'selected' : ''); ?>><?php echo e(trans('message.edit_user_graduated')); ?></option>
                        </select>
                    </div>
                </div>
                <?php
    $locale = app()->getLocale();
?>

<div class="form-group row">
    <div class="col-md-6">
        <p for="category"><b><?php echo e(trans('message.Department')); ?> <span class="text-danger">*</span></b></p>
        <select class="form-control" name="cat" id="cat" style="width: 100%;" required>
            <option value=""><?php echo e(trans('message.Select Category')); ?></option>
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    // เลือกชื่อแสดงผลตามภาษา
                    $department_name = ($locale == 'th') ? $cat->department_name_th : $cat->department_name_en;
                ?>
                <option value="<?php echo e($cat->id); ?>" <?php echo e($user->program->department_id == $cat->id  ? 'selected' : ''); ?>>
                    <?php echo e($department_name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-md-6">
        <p for="category"><b><?php echo e(trans('message.Program')); ?> <span class="text-danger">*</span></b></p>
        <select class="form-control select2" name="sub_cat" id="subcat" required>
            <option value=""><?php echo e(trans('message.Select Category')); ?></option>
            <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    // เลือกชื่อแสดงผลตามภาษา
                    $program_name = ($locale == 'th') ? $cat->program_name_th : $cat->program_name_en;
                ?>
                <option value="<?php echo e($cat->id); ?>" <?php echo e($user->program->id == $cat->id  ? 'selected' : ''); ?>>
                    <?php echo e($program_name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

                <div class="form-group row">
                    <p class="col-sm-3"><b>Scholar ID</b></p>
                    <div class="col-sm-8">
                        <input type="text" name="scholar_id" value="<?php echo e($user->scholar_id); ?>" class="form-control" placeholder="<?php echo e(trans('message.edit_user_schorlarID_holder')); ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-5"><?php echo e(trans('message.submit_button')); ?></button>
                <a class="btn btn-light mt-5" href="<?php echo e(route('users.index')); ?>"><?php echo e(trans('message.cancel_button')); ?></a>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script>
    $('#cat').on('change', function(e) {
        var cat_id = e.target.value;
        $.get('/ajax-get-subcat?cat_id=' + cat_id, function(data) {
            $('#subcat').empty();
            $.each(data, function(index, areaObj) {
                $('#subcat').append('<option value="' + areaObj.id + '" >' + areaObj.program_name_en + '</option>');
            });
        });
    });
</script>
<script>
    $('#cat').on('change', function(e) {
        var cat_id = e.target.value;
        $.get('/ajax-get-subcat?cat_id=' + cat_id, function(data) {
            $('#subcat').empty();
            $.each(data, function(index, areaObj) {
                var locale = "<?php echo e(app()->getLocale()); ?>"; // ดึงค่าภาษาปัจจุบัน
                var programName = (locale === 'th') ? areaObj.program_name_th : areaObj.program_name_en;
                $('#subcat').append('<option value="' + areaObj.id + '">' + programName + '</option>');
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/users/edit.blade.php ENDPATH**/ ?>