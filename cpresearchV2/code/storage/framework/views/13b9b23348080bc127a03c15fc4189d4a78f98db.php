
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="justify-content-center">
        <?php if(\Session::has('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(\Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header"><?php echo e(trans('message.permission')); ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
                    <span class="float-right">
                        <a class="btn btn-primary" href="<?php echo e(route('permissions.index')); ?>"><?php echo e(trans('message.back')); ?></a>
                    </span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="lead">
                    <strong><?php echo e(trans('message.name')); ?> :</strong>
                    <?php echo e($permission->name); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/permissions/show.blade.php ENDPATH**/ ?>