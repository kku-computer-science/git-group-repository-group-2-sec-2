
<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<?php
$user = Auth::user();
$locale = app()->getLocale();

// Define position mappings
$position_map = [
    'Assoc. Prof. Dr.' => '副教授 博士',
    'Asst. Prof.' => '助理教授',
    'Asst. Prof. Dr.' => '助理教授 博士',
    'Lecturer' => '讲师',
    'Prof. Dr.' => '教授 博士'
];

// Determine position translation
if ($locale === 'zh') {
    $position = $position_map[$user->position_en] ?? 'N/A';
    $fname = $user->fname_en ?? 'N/A';
    $lname = $user->lname_en ?? 'N/A';
} else {
    $position = $user->{'position_' . $locale} ?? $user->position_en ?? 'N/A';
    $fname = $user->{'fname_' . $locale} ?? 'N/A';
    $lname = $user->{'lname_' . $locale} ?? 'N/A';
}
?>

<h3 style="padding-top: 10px;"><?php echo e(trans('message.welcome_message')); ?></h3>
<br>
<?php
    $locale = app()->getLocale(); // ดึงค่าภาษาปัจจุบัน
    $role = Auth::user()->roles->first()->name ?? 'staff'; // ดึง role ของผู้ใช้
    $roleKey = 'message.Role_' . strtolower($role);
    $translatedRole = trans($roleKey);

    // แสดงชื่อเป็นภาษาที่เลือก
    $fnameKey = ($locale === 'th') ? Auth::user()->fname_th : (($locale === 'zh') ? Auth::user()->fname_en : Auth::user()->fname_en);
    $lnameKey = ($locale === 'th') ? Auth::user()->lname_th : (($locale === 'zh') ? Auth::user()->lname_en : Auth::user()->lname_en);
?>

<h4><?php echo e(trans('message.Hello')); ?> <?php echo e($translatedRole); ?> <?php echo e($fnameKey); ?> <?php echo e($lnameKey); ?></h4>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/dashboards/users/index.blade.php ENDPATH**/ ?>