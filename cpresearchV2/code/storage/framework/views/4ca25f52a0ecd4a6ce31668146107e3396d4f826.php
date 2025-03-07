

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="justify-content-center">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <strong><?php echo e(trans('validation.required', ['attribute' => 'field'])); ?></strong><br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e(trans($error)); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card" style="padding: 16px;">
                    <div class="card-body">
                        <h4 class="card-title mb-5"><?php echo e(trans('message.Add_User')); ?></h4>
                        <p class="card-description"><?php echo e(trans('message.Add_User_Details')); ?></p>
                        <?php echo Form::open(array('route' => 'users.store', 'method' => 'POST')); ?>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p><b><?php echo e(trans('message.First_Name_TH')); ?></b></p>
                                <?php echo Form::text('fname_th', null, array(
        'placeholder' => '',
        'class' =>
            'form-control'
    )); ?>

                            </div>
                            <div class="col-sm-6">
                                <p><b><?php echo e(trans('message.Last_Name_TH')); ?></b></p>
                                <?php echo Form::text('lname_th', null, array(
        'placeholder' => '',
        'class' =>
            'form-control'
    )); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p><b><?php echo e(trans('message.First_Name_EN')); ?></b></p>
                                <?php echo Form::text('fname_en', null, array(
        'placeholder' => '',
        'class' =>
            'form-control'
    )); ?>

                            </div>
                            <div class="col-sm-6">
                                <p><b><?php echo e(trans('message.Last_Name_EN')); ?></b></p>
                                <?php echo Form::text('lname_en', null, array(
        'placeholder' => '',
        'class' =>
            'form-control'
    )); ?>

                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-sm-8">
                                <p><b><?php echo e(trans('message.Email')); ?></b></p>
                                <?php echo Form::text('email', null, array('placeholder' => '', 'class' => 'form-control')); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p><b><?php echo e(trans('message.Password')); ?>:</b></p>
                                <?php echo Form::password('password', array('placeholder' => '', 'class' => 'form-control')); ?>

                            </div>
                            <div class="col-sm-6">
                                <p><b><?php echo e(trans('message.Confirm_Password')); ?>:</p></b>
                                <?php echo Form::password('password_confirmation', array(
        'placeholder' => '',
        'class'
        => 'form-control'
    )); ?><?php
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
                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <p><b><?php echo e(trans('message.Role')); ?>:</b></p>
                            <div class="col-sm-8">
                                <select class="selectpicker" name="roles[]" multiple title="Select Role">
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>"> <?php echo e(isset($roleMap[$role->name]) ? $roleMap[$role->name] : $role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 for="category"><?php echo e(trans('message.Department')); ?> <span class="text-danger">*</span>
                                    </h6>
                                    <select class="form-control" name="cat" id="cat" style="width: 100%;" required
                                        oninvalid="this.setCustomValidity(getValidationMessage())"
                                        oninput="this.setCustomValidity('')">
                                        <option value=""><?php echo e(trans('message.Select_Subcategory')); ?></option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php
                                                                                $locale = app()->getLocale();
                                                                                $department_name = ($locale === 'th') ? $cat->department_name_th :
                                                                                    $cat->department_name_en;
                                                                            ?>
                                                                            <option value="<?php echo e($cat->id); ?>"><?php echo e($department_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <h6 for="subcat"><?php echo e(trans('message.Program')); ?> <span class="text-danger">*</span></h6>
                                    <select class="form-control select2" name="sub_cat" id="subcat" required
                                        oninvalid="this.setCustomValidity(getValidationMessage())"
                                        oninput="this.setCustomValidity('')">
                                        <option value=""><?php echo e(trans('message.Select_Subcategory')); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p><b><?php echo e(trans('message.Scholar_ID_(Optional)')); ?></b></p>
                                <?php echo Form::text('scholar_id', null, array('placeholder' => '', 'class' => 'form-control')); ?>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo e(trans('message.Submit')); ?></button>
                        <a class="btn btn-secondary" href="<?php echo e(route('users.index')); ?>"><?php echo e(trans('message.Cancle')); ?></a>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

    <script>
        $('#cat').on('change', function (e) {
            var cat_id = e.target.value;
            var locale = "<?php echo e(app()->getLocale()); ?>"; // ดึงค่าภาษาปัจจุบัน

            $.get('/ajax-get-subcat?cat_id=' + cat_id, function (data) {
                $('#subcat').empty();
                $.each(data, function (index, areaObj) {
                    var program_name = (locale === 'th') ? areaObj.program_name_th : areaObj
                        .program_name_en;
                    $('#subcat').append('<option value="' + areaObj.id + '">' + areaObj.degree
                        .title_en + ' in ' + program_name + '</option>');
                });
            });
        });


        function getValidationMessage() {
            let locale = "<?php echo e(app()->getLocale()); ?>"; // ดึงภาษาปัจจุบัน
            let messages = {
                en: "Please select an item in the list.",
                th: "กรุณาเลือกข้อมูลจากรายการ",
                zh: "请选择列表中的项目"
            };
            return messages[locale] || messages['en']; // ถ้าไม่เจอภาษาที่รองรับ ให้ใช้ภาษาอังกฤษ
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/users/create.blade.php ENDPATH**/ ?>