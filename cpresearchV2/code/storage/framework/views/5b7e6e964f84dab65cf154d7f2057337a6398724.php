

<?php $__env->startSection('content'); ?>
<div class="container card-3 ">
    <p><?php echo e(trans('message.Research_Group')); ?></p>
    <?php $__currentLoopData = $resg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $rg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $locale = app()->getLocale();

        // ถ้าเลือกภาษาจีน (zh) → ใช้คำอธิบายภาษาอังกฤษจากฐานข้อมูล
        if ($locale === 'zh') {
            $group_name = $rg->group_name_en ?? 'N/A';
            $group_desc = $rg->group_desc_en ?? 'N/A'; // ใช้คำอธิบายภาษาอังกฤษจากฐานข้อมูลแทน
        } else {
            $group_name = $rg->{'group_name_' . $locale} ?? 'N/A';
            $group_desc = $rg->{'group_desc_' . $locale} ?? 'N/A';
        }

        // แมปตำแหน่งอาจารย์จากภาษาอังกฤษเป็นภาษาจีน
        $positionMap = [
            'Assoc. Prof. Dr.' => '副教授 博士',
            'Prof. Dr.'        => '教授 博士',
            'Asst. Prof. Dr.'  => '助理教授 博士',
            'Asst. Prof.'      => '助理教授',
            'Lecturer'         => '讲师',
        ];
    ?>
    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body">
                    <img src="<?php echo e(asset('img/'.$rg->group_image)); ?>" alt="...">
                    <h2 class="card-text-1"><?php echo e(trans('message.Laboratory_Supervisor')); ?></h2>
                    
                    <h2 class="card-text-2">
                        <?php $__currentLoopData = $rg->user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($r->hasRole('teacher')): ?>
                            <?php
                                $fname = ($locale === 'zh') ? ($r->fname_en ?? 'N/A') : ($r->{'fname_' . $locale} ?? 'N/A');
                                $lname = ($locale === 'zh') ? ($r->lname_en ?? 'N/A') : ($r->{'lname_' . $locale} ?? 'N/A');
                                $position = ($locale === 'zh') ? ($positionMap[$r->position_en] ?? $r->position_en) : ($r->{'position_' . $locale} ?? $r->position_en ?? 'N/A');
                            ?>
                            <?php echo e($position); ?> <?php echo e($fname); ?> <?php echo e($lname); ?>

                            <br>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </h2>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($group_name); ?></h5>
                    <h3 class="card-text" id="group_desc_<?php echo e($index); ?>">
                        <?php echo e($group_desc); ?>

                    </h3>
                </div>
                <div>
                    <a href="<?php echo e(route('researchgroupdetail', ['id' => $rg->id])); ?>" class="btn btn-outline-info">
                        <?php echo e(trans('message.details')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- Script แปลเฉพาะคำอธิบาย (group_desc) -->
<?php 
$locale = app()->getLocale();
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php if($locale == 'zh'): ?>
        <?php $__currentLoopData = $resg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $rg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            translateGroupDesc('group_desc_<?php echo e($index); ?>', 'zh-CN');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
});

// ฟังก์ชันแปลคำอธิบายของกลุ่มวิจัย (group_desc)
function translateGroupDesc(elementId, lang) {
    let textElement = document.getElementById(elementId);
    if (!textElement) return;

    let text = textElement.innerText;
    let url = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${lang}&dt=t&q=` + encodeURIComponent(text);

    fetch(url)
        .then(response => response.json())
        .then(data => {
            let translatedText = data[0].map(item => item[0]).join('');
            textElement.innerText = translatedText;
        })
        .catch(error => console.error('Error:', error));
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/research_g.blade.php ENDPATH**/ ?>