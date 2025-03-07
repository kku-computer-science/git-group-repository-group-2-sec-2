

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2><?php echo e(trans('message.api_status')); ?></h2>
    <table class="table">
        <thead>
            <tr>
                <th><?php echo e(trans('message.api_name')); ?></th>
                <th><?php echo e(trans('message.status')); ?></th>
                <th><?php echo e(trans('message.last_checked')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($status->api_name); ?></td>
                    <td>
                        <?php if($status->status == 'active'): ?>
                            <span class="badge bg-success"><?php echo e(trans('message.active')); ?></span>
                        <?php else: ?>
                            <span class="badge bg-danger"><?php echo e(trans('message.inactive')); ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($status->last_checked); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/apistatus/index.blade.php ENDPATH**/ ?>