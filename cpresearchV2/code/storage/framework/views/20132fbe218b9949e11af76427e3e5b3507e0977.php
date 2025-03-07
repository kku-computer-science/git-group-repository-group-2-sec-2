
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="justify-content-center">
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
            <strong><?php echo e(trans('message.Oops')); ?></strong> <?php echo e(trans('message.Something went wrong, please check below errors')); ?>.<br><br>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><?php echo e(trans('message.Create Role')); ?>

                <span class="float-right">
                    <a class="btn btn-primary" href="<?php echo e(route('roles.index')); ?>"><?php echo e(trans('message.Roles')); ?></a>
                </span>
            </div>
            <div class="card-body">
                <?php echo Form::open(array('route' => 'roles.store','method'=>'POST')); ?>

                    <div class="form-group">
                        <strong><?php echo e(trans('message.Role Name')); ?></strong>
                        <?php echo Form::text('name', null, array('placeholder' => trans('message.Role Name'),'class' => 'form-control')); ?>

                    </div>
                    <div class="form-group">
                        <strong><?php echo e(trans('message.Permission')); ?></strong>
                        <br/>
                        <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label><?php echo e(Form::checkbox('permission[]', $value->id, false, array('class' => 'name'))); ?>

                            <?php echo e($value->name); ?></label>
                        <br/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo e(trans('message.Submit')); ?></button>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/roles/create.blade.php ENDPATH**/ ?>