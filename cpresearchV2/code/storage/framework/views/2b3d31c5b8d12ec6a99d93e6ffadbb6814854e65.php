
<?php $__env->startSection('content'); ?>

<div class="container refund">
    <p><?php echo e(trans('message.research_proj_head')); ?></p>

    <?php
        $locale = app()->getLocale();

        $proj_type_en = [
            'ทุนภายใน' => 'Internal Funding',
            'ทุนภายนอก' => 'External Funding',
        ];
        $proj_type_th = [
            'ทุนภายใน' => 'ทุนภายใน',
            'ทุนภายนอก' => 'ทุนภายนอก',
        ];
        $proj_type_zh = [
            'ทุนภายใน' => '内部资金',
            'ทุนภายนอก' => '外部资金',
        ];

        $res_agency_en = [
            'สาขาวิชาวิทยาการคอมพิวเตอร์' => 'Department of Computer Science',
        ];
        $res_agency_th = [
            'สาขาวิชาวิทยาการคอมพิวเตอร์' => 'สาขาวิชาวิทยาการคอมพิวเตอร์',
        ];
        $res_agency_zh = [
            'สาขาวิชาวิทยาการคอมพิวเตอร์' => '计算机科学系',
        ];

        $fund_agency_en = [
            'มหาวิทยาลัยขอนแก่น' => 'Khon Kaen University',
            'OU, BOKU, JU, ITC, AIT, YNNU, FNU' => 'OU, BOKU, JU, ITC, AIT, YNNU, FNU',
            'สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ' => 'National Science Technology and Innovation Policy Office',
            'สำนักงานคณะกรรมการวิจัยแห่งชาติ' => 'National Research Council of Thailand',
            'กระทรวงวิทยาศาสตร์และเทคโนโลยี' => 'Ministry of Science and Technology',
            'คณะวิทยาศาสตร์ มข.' => 'Faculty of Science, KKU',
            'วิทยาลัยการคอมพิวเตอร์' => 'College of Local Administration',
            'ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ' => 'Geo-Informatics and Space Technology Development Agency (Public Organization)',
            'สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม' => 'Office of the Permanent Secretary, Ministry of Higher Education, Science, Research and Innovation',

        ];
        $fund_agency_th = [
            'มหาวิทยาลัยขอนแก่น' => 'มหาวิทยาลัยขอนแก่น',
            'OU, BOKU, JU, ITC, AIT, YNNU, FNU' => 'OU, BOKU, JU, ITC, AIT, YNNU, FNU',
            'สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ' => 'สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ',
            'สำนักงานคณะกรรมการวิจัยแห่งชาติ' => 'สำนักงานคณะกรรมการวิจัยแห่งชาติ',
            'กระทรวงวิทยาศาสตร์และเทคโนโลยี' => 'กระทรวงวิทยาศาสตร์และเทคโนโลยี',
            'คณะวิทยาศาสตร์ มข.' => 'คณะวิทยาศาสตร์ มข.',
            'วิทยาลัยการคอมพิวเตอร์' => 'วิทยาลัยการคอมพิวเตอร์',
            'ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ' => 'ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ',
            'สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม' => 'สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม',

        ];
        $fund_agency_zh = [
            'มหาวิทยาลัยขอนแก่น' => '孔敬大学',
            'OU, BOKU, JU, ITC, AIT, YNNU, FNU' => 'OU, BOKU, JU, ITC, AIT, YNNU, FNU',
            'สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ' => '国家科技创新政策办公室',
            'สำนักงานคณะกรรมการวิจัยแห่งชาติ' => '泰国国家研究委员会',
            'กระทรวงวิทยาศาสตร์และเทคโนโลยี' => '泰国科学技术部',
            'คณะวิทยาศาสตร์ มข.' => '科学学院，KKU',
            'วิทยาลัยการคอมพิวเตอร์' => '地方管理学院',
            'ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ' => '地理信息与空间技术发展局（公共机构）',
            'สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม' => '高等教育，科学，研究和创新部常任秘书办公室',
        ];

        if ($locale === 'zh') {
            $proj_type_map = $proj_type_zh;
            $res_agency_map = $res_agency_zh;
            $fund_agency_map = $fund_agency_zh;
            $currencyText = '铢';
        } elseif ($locale === 'en') {
            $proj_type_map = $proj_type_en;
            $res_agency_map = $res_agency_en;
            $fund_agency_map = $fund_agency_en;
            $currencyText = 'Baht';
        } else {
            $proj_type_map = $proj_type_th;
            $res_agency_map = $res_agency_th;
            $fund_agency_map = $fund_agency_th;
            $currencyText = 'บาท';
        }
        

    ?>

    <div class="table-refund table-responsive">
        <table id="example1" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th style="font-weight: bold;"><?php echo e(trans('message.No.')); ?></th>
                    <th class="col-md-1" style="font-weight: bold;"><?php echo e(trans('message.year')); ?></th>
                    <th class="col-md-4" style="font-weight: bold;"><?php echo e(trans('message.proj_name')); ?></th>
                    <!-- <th>ระยะเวลาโครงการ</th>
                    <th>ผู้รับผิดชอบโครงการ</th>
                    <th>ประเภททุนวิจัย</th>
                    <th>หน่วยงานที่สนันสนุนทุน</th>
                    <th>งบประมาณที่ได้รับจัดสรร</th> -->
                    <th class="col-md-4" style="font-weight: bold;"><?php echo e(trans('message.desc')); ?></th>
                    <th class="col-md-2" style="font-weight: bold;"><?php echo e(trans('message.proj_lead')); ?></th>
                    <!-- <th class="col-md-5">หน่วยงานที่รับผิดชอบ</th> -->
                    <th class="col-md-1" style="font-weight: bold;"><?php echo e(trans('message.status')); ?></th>
                </tr>
            </thead>


            <tbody>
                <?php $__currentLoopData = $resp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $re): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $locale = app()->getLocale();
                                    $project_start = \Carbon\Carbon::parse($re->project_start);
                                    $project_end = \Carbon\Carbon::parse($re->project_end);

                                    if ($locale === 'th') {
                                        $formatted_start = $project_start->thaidate('j F Y');
                                        $formatted_end = $project_end->thaidate('j F Y');
                                    } else if ($locale === 'en') {
                                        $formatted_start = $project_start->format('j F Y');
                                        $formatted_end = $project_end->format('j F Y');
                                    } else {
                                        $formatter = new \IntlDateFormatter('zh_CN', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE, 'Asia/Shanghai', \IntlDateFormatter::GREGORIAN, 'yyyy年M月d日');
                                        $formatted_start = $formatter->format($project_start);
                                        $formatted_end = $formatter->format($project_end);
                                    }
                                ?>
                                <tr>
                                    <td style="vertical-align: top;text-align: left;"><?php echo e($i + 1); ?></td>
                                    <td style="vertical-align: top; text-align: left;">
                                        <?php if($locale === 'th'): ?>
                                            <?php echo e($re->project_year + 543); ?>

                                        <?php else: ?>
                                            <?php echo e($re->project_year); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td style="vertical-align: top;text-align: left;">
                                        <?php echo e($re->project_name); ?>


                                    </td>
                                    <td>
                                        <div style="padding-bottom: 10px">

                                            <?php if($re->project_start != null): ?>
                                                <span style="font-weight: bold;">
                                                    <?php echo e(trans('message.proj_duration')); ?>

                                                </span>

                                                <span style="padding-left: 10px;">
                                                    <?php echo e($formatted_start); ?> <?php echo e(trans('message.to')); ?> <?php echo e($formatted_end); ?>

                                                </span>
                                            <?php else: ?>
                                                <span style="font-weight: bold;">
                                                    <?php echo e(trans('message.proj_duration')); ?>

                                                </span>
                                                <span>

                                                </span>
                                            <?php endif; ?>
                                        </div>


                                        <!-- <?php if($re->project_start != null): ?>
                                                                                                                                        <td><?php echo e(\Carbon\Carbon::parse($re->project_start)->thaidate('j F Y')); ?><br>ถึง <?php echo e(\Carbon\Carbon::parse($re->project_end)->thaidate('j F Y')); ?></td>
                                                                                                                                        <?php else: ?>
                                                                                                                                        <td></td>
                                                                                                                                        <?php endif; ?> -->

                                        <!-- <td><?php $__currentLoopData = $re->user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                                                            <?php echo e($user->position); ?><?php echo e($user->fname_th); ?> <?php echo e($user->lname_th); ?><br>
                                                                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                                                        </td> -->
                                        <!-- <td>
                                                                                                                                            <?php if(is_null($re->fund)): ?>
                                                                                                                                            <?php else: ?>
                                                                                                                                            <?php echo e($re->fund->fund_type); ?>

                                                                                                                                            <?php endif; ?>
                                                                                                                                        </td> -->
                                        <!-- <td><?php if(is_null($re->fund)): ?>
                                                                                                                                            <?php else: ?>
                                                                                                                                            <?php echo e($re->fund->support_resource); ?>

                                                                                                                                            <?php endif; ?>
                                                                                                                                        </td> -->
                                        <!-- <td><?php echo e($re->budget); ?></td> -->
                                        <div style="padding-bottom: 10px;">
                                            <span style="font-weight: bold;"><?php echo e(trans('message.proj_type')); ?></span>
                                            <span style="padding-left: 10px;"> <?php if(is_null($re->fund)): ?>
                                            <?php else: ?>
                                                <?php echo e($proj_type_map[$re->fund->fund_type] ?? $re->fund->fund_type); ?>

                                            <?php endif; ?>
                                            </span>
                                        </div>
                                        <div style="padding-bottom: 10px;">
                                            <span style="font-weight: bold;"><?php echo e(trans('message.funding_agency')); ?></span>
                                            <span style="padding-left: 10px;"> <?php if(is_null($re->fund)): ?>
                                            <?php else: ?>
                                                <?php echo e($fund_agency_map[$re->fund->support_resource] ?? $re->fund->support_resource); ?>

                                            <?php endif; ?>
                                            </span>
                                        </div>
                                        <div style="padding-bottom: 10px;">
                                            <span style="font-weight: bold;"><?php echo e(trans('message.res_agency')); ?></span>
                                            <span style="padding-left: 10px;">
                                                <?php echo e($res_agency_map[$re->responsible_department] ?? $re->responsible_department); ?>

                                            </span>
                                        </div>
                                        <div style="padding-bottom: 10px;">

                                            <span style="font-weight: bold;"><?php echo e(trans('message.allocated_budget')); ?></span>
                                            <span style="padding-left: 10px;"> <?php echo e(number_format($re->budget)); ?> <?php echo e($currencyText); ?></span>
                                        </div>
                                    </td>

                                    <td style="vertical-align: top;text-align: left;">
                                        <div style="padding-bottom: 10px;">
                                            <span>
                                                <?php $__currentLoopData = $re->user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                // แปลง Ph.D. เป็น 博士 ถ้าเป็นภาษาจีน
                                                $doctoral_degree = $user->doctoral_degree == 'Ph.D.' ? ($locale == 'zh' ? '博士' : 'Ph.D.') : '';
                                                $positionMap = [];
                                                if ($locale === 'zh') {
                                                    $positionMap = [
                                                        'Assoc. Prof. Dr.' => '副教授 博士',
                                                        'Prof. Dr.'        => '教授 博士',
                                                        'Asst. Prof. Dr.'  => '助理教授 博士',
                                                        'Asst. Prof.'      => '助理教授',

                                                    ];
                                                }
                                                ?>
                                                
                                                    <?php if($locale === 'th'): ?>
                                                        <?php if($user->position_en !== 'Lecturer'): ?>
                                                            <?php echo e($user->position_th); ?> <?php echo e($user->fname_th); ?> <?php echo e($user->lname_th); ?><br>
                                                        <?php else: ?>
                                                            <?php echo e($user->position_th); ?> <?php echo e($user->fname_th); ?> <?php echo e($user->lname_th); ?><br>
                                                        <?php endif; ?>
                                                    <?php elseif($locale === 'en'): ?>
                                                        <?php if($user->position_en !== 'Lecturer'): ?>
                                                            <?php echo e($user->position_en); ?> <?php echo e($user->fname_en); ?> <?php echo e($user->lname_en); ?><br>
                                                        <?php else: ?>
                                                            <?php echo e($user->fname_en); ?> <?php echo e($user->lname_en); ?>, <?php echo e($doctoral_degree); ?> <br>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if($user->position_en !== 'Lecturer'): ?>
                                                            <?php echo e($positionMap[$user->position_en]); ?> <?php echo e($user->fname_en); ?> <?php echo e($user->lname_en); ?><br>
                                                        <?php else: ?>
                                                            <?php echo e($user->fname_en); ?> <?php echo e($user->lname_en); ?>, <?php echo e($doctoral_degree); ?><br>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span>
                                        </div>
                                    </td>
                                    <?php if($re->status == 1): ?>
                                        <td style="vertical-align: top;text-align: left;">
                                            <h6><label class="badge badge-success"><?php echo e(trans('message.proj_req')); ?></label></h6>
                                        </td>
                                    <?php elseif($re->status == 2): ?>
                                        <td style="vertical-align: top;text-align: left;">
                                            <h6><label class="badge bg-warning text-dark"><?php echo e(trans('message.proj_op')); ?></label></h6>
                                        </td>
                                    <?php else: ?>
                                        <td style="vertical-align: top;text-align: left;">
                                            <h6><label class="badge bg-dark"><?php echo e(trans('message.proj_closed')); ?></label>
                                                <h6>
                                        </td>
                                    <?php endif; ?>
                                    <!-- <td></td>
                                                                                                                                        <td></td> -->
                                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</div>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    $(document).ready(function () {

        var MultiLang = {
            "sProcessing": "<?php echo e(trans('message.Processing...')); ?>",
            "sLengthMenu": "<?php echo e(trans('message.Showing')); ?> _MENU_ <?php echo e(trans('message.entries')); ?>",
            "sZeroRecords": "<?php echo e(trans('message.No data available in table')); ?>",
            "sInfo": "<?php echo e(trans('message.Showing')); ?> _START_ <?php echo e(trans('message.to')); ?> _END_ <?php echo e(trans('message.of')); ?> _TOTAL_ <?php echo e(trans('message.entries')); ?>",
            "sInfoEmpty": "<?php echo e(trans('message.Showing')); ?> 0 <?php echo e(trans('message.to')); ?> 0 <?php echo e(trans('message.of')); ?> 0 <?php echo e(trans('message.entries')); ?>",
            "sInfoFiltered": "(<?php echo e(trans('message.filtered from')); ?> _MAX_ <?php echo e(trans('message.entries')); ?>)",
            "sSearch": "<?php echo e(trans('message.Search')); ?>:",
            "oPaginate": {
                "sFirst": "<?php echo e(trans('message.First Page')); ?>",
                "sPrevious": "<?php echo e(trans('message.Previous Page')); ?>",
                "sNext": "<?php echo e(trans('message.Next Page')); ?>",
                "sLast": "<?php echo e(trans('message.Last Page')); ?>"
            }
        };

        var table1 = $('#example1').DataTable({ responsive: true, language: MultiLang });

    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/research_proj.blade.php ENDPATH**/ ?>