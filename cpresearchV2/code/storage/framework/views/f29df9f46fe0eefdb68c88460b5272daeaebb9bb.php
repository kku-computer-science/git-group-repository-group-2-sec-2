
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<?php $__env->startSection('content'); ?>
<style>
    .table-responsive {
        margin: 30px 0;
    }

    .table-wrapper {
        min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }


    .search-box {
        position: relative;
        float: right;
    }

    .search-box .input-group {
        min-width: 300px;
        position: absolute;
        right: 0;
    }

    .search-box .input-group-addon,
    .search-box input {
        border-color: #ddd;
        border-radius: 0;
    }

    .search-box input {
        height: 34px;
        padding-right: 35px;
        background: #0e393e;
        color: #ffffff;
        border: none;
        border-radius: 15px !important;
    }

    .search-box input:focus {
        background: #0e393e;
        color: #ffffff;
    }

    .search-box input::placeholder {
        font-style: italic;
    }

    .search-box .input-group-addon {
        min-width: 35px;
        border: none;
        background: transparent;
        position: absolute;
        right: 0;
        z-index: 9;
        padding: 6px 0;
    }

    .search-box i {
        color: #a0a5b1;
        font-size: 19px;
        position: relative;
        top: 2px;
    }
</style>
<script>
    $(document).ready(function() {
        // Activate tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Filter table rows based on searched term
        $("#search").on("keyup", function() {
            var term = $(this).val().toLowerCase();
            $("table tbody tr").each(function() {
                $row = $(this);
                var name = $row.find("td:nth-child(2)").text().toLowerCase();
                console.log(name);
                if (name.search(term) < 0) {
                    $row.hide();
                } else {
                    $row.show();
                }
            });
        });
    });
</script>
<div class="container">
    <?php if(\Session::has('success')): ?>
    <div class="alert alert-success">
        <p><?php echo e(\Session::get('success')); ?></p>
    </div>
    <?php endif; ?>
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title"><?php echo e(trans('message.users')); ?></h4>
            <a class="btn btn-primary btn-icon-text btn-sm" href="<?php echo e(route('users.create')); ?>"><i class="ti-plus btn-icon-prepend icon-sm"></i><?php echo e(trans('message.user_new_user')); ?></a>
            <a class="btn btn-primary btn-icon-text btn-sm" href="<?php echo e(route('importfiles')); ?>"><i class="ti-download btn-icon-prepend icon-sm"></i><?php echo e(trans('message.user_import_new_user')); ?></a>
            <!-- <div class="search-box">
                <div class="input-group">
                    <input type="text" id="search" class="form-control" placeholder="Search by Name">
                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                </div>
            </div> -->

            <div class="table-responsive">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo e(trans('message.no_dot')); ?></th>
                            <th><?php echo e(trans('message.user_name')); ?></th>
                            <th><?php echo e(trans('message.user_department')); ?></th>
                            <th><?php echo e(trans('message.user_email')); ?></th>
                            <th><?php echo e(trans('message.user_role')); ?></th>
                            <th width="280px"><?php echo e(trans('message.action')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key++); ?></td>
                            <td>
                                <?php if(app()->getLocale() == 'th'): ?>
                                <?php echo e($user->fname_th); ?> <?php echo e($user->lname_th); ?>

                                <?php else: ?>
                                <?php echo e($user->fname_en ?? $user->fname_th); ?> <?php echo e($user->lname_en ?? $user->lname_th); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(app()->getLocale() == 'th'): ?>
                                <?php echo e(Str::limit($user->program->program_name_th, 20)); ?>

                                <?php else: ?>
                                <?php echo e(Str::limit($user->program->program_name_en, 20)); ?>

                                <?php endif; ?>
                            </td>

                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <?php if(!empty($user->getRoleNames())): ?>
                                <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <label class="badge badge-dark"><?php echo e($roleTranslations[$val][$locale] ?? $val); ?></label>
                                <?php else: ?>
                                <label class="badge badge-dark">
                                    <?php echo e($roleTranslations[$val][$locale] ?? $val); ?>

                                </label>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>

                            <td>
                                <form action="<?php echo e(route('users.destroy',$user->id)); ?>" method="POST">
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" href="<?php echo e(route('users.show',$user->id)); ?>"><i class="mdi mdi-eye"></i></a>
                                    </li>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-edit')): ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" href="<?php echo e(route('users.edit',$user->id)); ?>"><i class="mdi mdi-pencil"></i></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-delete')): ?>
                                    <!-- <?php echo Form::open(['method' => 'DELETE','route' => ['users.destroy',
                                $user->id],'style'=>'display:inline']); ?>

                                <?php echo Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit','class' => 'btn btn-outline-danger btn-sm','type'=>'button','data-toggle'=>'tooltip'
                                ,'data-placement'=>'top', 'title'=>'Delete']); ?>

                                <?php echo Form::close(); ?> -->
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <li class="list-inline-item">
                                        <button class="btn btn-outline-danger btn-sm show_confirm" type="submit" data-toggle="tooltip" data-placement="top"><i class="mdi mdi-delete"></i></button>
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

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/users/index.blade.php ENDPATH**/ ?>