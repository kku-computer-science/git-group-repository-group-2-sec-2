

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2><?php echo e(trans('message.highlight')); ?></h2>
    <p><?php echo e(trans('message.welcome_higlight')); ?></p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/highlight/index.blade.php ENDPATH**/ ?>