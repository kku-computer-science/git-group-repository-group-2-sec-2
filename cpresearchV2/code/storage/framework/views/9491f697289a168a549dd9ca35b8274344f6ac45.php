
<?php $__env->startSection('content'); ?>
<div class="container card-2">
    <p class="title"> <?php echo e(trans('message.researchers')); ?> </p>
    <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span>
        <ion-icon name="caret-forward-outline" size="small"></ion-icon>
        <?php switch($res->name):
        case ('teacher'): ?>
        <?php echo e(trans('message.researcher_role_teacher')); ?>

        <?php break; ?>
        <?php case ('Undergrad Student'): ?>
        <?php echo e(trans('message.researcher_role_undergrad_student')); ?>

        <?php break; ?>
        <?php case ('Master Student'): ?>
        <?php echo e(trans('message.researcher_role_master_student')); ?>

        <?php break; ?>
        <?php case ('Doctoral Student'): ?>
        <?php echo e(trans('message.researcher_role_doctoral_student')); ?>

        <?php break; ?>
        <?php default: ?>
        <?php echo e($res->name); ?>

        <?php endswitch; ?>

    </span>
    <div class="d-flex">
        <div class="ml-auto">
            <form class="row row-cols-lg-auto g-3" method="GET" action="<?php echo e(route('searchresearchers',['id'=>$res->id])); ?>">
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control" name="textsearch" placeholder="<?php echo e(trans('message.placeholder_research')); ?>">
                    </div>
                </div>
                <!-- <div class="col-12">
                        <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                        <select class="form-select" id="inlineFormSelectPref">
                            <option selected> Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div> -->
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-primary"> <?php echo e(trans('message.search')); ?></button>
                </div>
            </form>
        </div>
    </div>


    <div class="row row-cols-1 row-cols-md-2 g-0">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href=" <?php echo e(route('detail',Crypt::encrypt($r->id))); ?>">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-sm-4">
                        <img class="card-image" src="<?php echo e($r->picture); ?>" alt="">
                    </div>
                    <div class="col-sm-8 overflow-hidden" style="text-overflow: clip; <?php if(app()->getLocale() == 'en'): ?> max-height: 220px; <?php else: ?> max-height: 210px;<?php endif; ?>">
                        <div class="card-body">
                            <?php
                            $locale = app()->getLocale();

                            // ถ้าเลือกภาษาไทยให้แสดงชื่อภาษาไทยก่อน
                            if ($locale == 'th') {
                            $fname = $r->fname_th;
                            $lname = $r->lname_th;
                            $position = $r->position_th;
                            } else {
                            // ถ้าไม่ใช่ภาษาไทย ใช้ภาษาอังกฤษก่อน ถ้าไม่มี fallback เป็นภาษาไทย
                            $fname = !empty($r->fname_en) ? $r->fname_en : $r->fname_th;
                            $lname = !empty($r->lname_en) ? $r->lname_en : $r->lname_th;
                            $position = !empty($r->position_en) ? $r->position_en : $r->position_th;
                            }

                            // ตรวจสอบว่ามี academic rank หรือไม่ ถ้าไม่มีให้เป็นค่าว่าง
                            $academic_rank = '';
                            if (!empty($r->academic_ranks_en)) {
                            $academic_rank_key = strtolower(str_replace(' ', '_', $r->academic_ranks_en));
                            $academic_rank = trans('message.' . $academic_rank_key);
                            }

                            // แปลง Ph.D. เป็น 博士 ถ้าเป็นภาษาจีน
                            $doctoral_degree = $r->doctoral_degree == 'Ph.D.' ? ($locale == 'zh' ? '博士' : 'Ph.D.') : '';
                            ?>


                            <?php if($locale == 'en' || $locale == 'zh'): ?>
                            <h5 class="card-title">
                                <?php echo e($fname); ?> <?php echo e($lname); ?><?php echo e($doctoral_degree ? ', ' . $doctoral_degree : ''); ?>

                            </h5>
                            <?php if(!empty($academic_rank)): ?>
                            <h5 class="card-title-2"><?php echo e($academic_rank); ?></h5>
                            <?php endif; ?>
                            <?php else: ?>
                            <h5 class="card-title">
                                <?php echo e($position); ?> <?php echo e($fname); ?> <?php echo e($lname); ?>

                            </h5>
                            <?php endif; ?>

                            <p class="card-text-1"><?php echo e(trans('message.expertise')); ?></p>
                            <div class="card-expertise">
                                <?php $__currentLoopData = $r->expertise->sortBy('expert_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $locale = app()->getLocale();
                                $expert_name = trim($exper->expert_name); // ตัดช่องว่างออก
                                $expert_name_key = 'message.expertise_translation.' . $expert_name;
                                $translated_expert_name = null;

                                if ($locale == 'zh' || $locale == 'th') {
                                // ใช้ค่าจากการแปล ถ้าเป็นภาษาจีนหรือภาษาไทย
                                $translated_expert_name = trans($expert_name_key);
                                }

                                // ถ้าเป็นภาษาอังกฤษ ใช้ค่าจาก Database
                                if ($locale == 'en') {
                                $display_expert_name = $expert_name;
                                } else {
                                // ถ้ามีคำแปล ใช้ค่าที่แปลได้, ถ้าไม่มีให้ใช้ค่าจาก Database
                                $display_expert_name = ($translated_expert_name !== $expert_name_key) ? $translated_expert_name : $expert_name;
                                }
                                ?>
                                <p class="card-text"><?php echo e($display_expert_name); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>


                            <!-- <div class="card-expertise">
                                <?php $__currentLoopData = $r->expertise->sortBy('expert_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="card-text"><?php echo e($exper->expert_name); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div> -->
                        </div>
                    </diV>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/researchers.blade.php ENDPATH**/ ?>