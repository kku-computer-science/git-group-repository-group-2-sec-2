
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <?php if($message = Session::get('success')): ?>
    <div class="alert alert-success">
        <p><?php echo e($message); ?></p>
    </div>
    <?php endif; ?>
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title"><?php echo e(trans('message.patent')); ?></h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="<?php echo e(route('patents.create')); ?>"><i class="mdi mdi-plus btn-icon-prepend"></i> <?php echo e(trans('message.add')); ?></a>
            <!-- <div class="table-responsive"> -->
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo e(trans('message.no_dot')); ?></th>
                        <th><?php echo e(trans('message.patent_name')); ?></th>
                        <th><?php echo e(trans('message.patent_type')); ?></th>
                        <th><?php echo e(trans('message.patent_date')); ?></th>
                        <th><?php echo e(trans('message.patent_number')); ?></th>
                        <th><?php echo e(trans('message.patent_author')); ?></th>
                        <th width="280px"><?php echo e(trans('message.action')); ?></th>
                    </tr>
                    <thead>
                    <tbody>
                        <?php $__currentLoopData = $patents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i+1); ?></td>
                            <td><?php echo e(Str::limit($paper->ac_name,50)); ?></td>
                            <td>
                                <?php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                ?>

                                <?php if($locale == 'th'): ?>
                                <?php echo e($paper->ac_type); ?> 
                                <?php elseif($locale == 'zh'): ?>
                                <?php switch($paper->ac_type):
                                case ('สิทธิบัตร'): ?>
                                专利
                                <?php break; ?>
                                <?php case ('สิทธิบัตร (การประดิษฐ์)'): ?>
                                发明专利
                                <?php break; ?>
                                <?php case ('สิทธิบัตร (การออกแบบผลิตภัณฑ์)'): ?>
                                设计专利
                                <?php break; ?>
                                <?php case ('อนุสิทธิบัตร'): ?>
                                实用新型
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์'): ?>
                                版权
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (วรรณกรรม)'): ?>
                                文学版权
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (ตนตรีกรรม)'): ?>
                                音乐版权
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (ภาพยนตร์)'): ?>
                                电影版权
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (ศิลปกรรม)'): ?>
                                艺术版权
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (งานแพร่เสี่ยงแพร่ภาพ)'): ?>
                                广播版权
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (โสตทัศนวัสดุ)'): ?>
                                视听资料版权
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (งานอื่นใดในแผนกวรรณคดี/วิทยาศาสตร์/ศิลปะ)'): ?>
                                其他文学/科学/艺术版权
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (สิ่งบันทึกเสียง)'): ?>
                                录音版权
                                <?php break; ?>
                                <?php case ('ความลับทางการค้า'): ?>
                                商业机密
                                <?php break; ?>
                                <?php case ('เครื่องหมายการค้า'): ?>
                                商标
                                <?php break; ?>
                                <?php default: ?>
                                <?php echo e($paper->ac_type); ?>

                                <?php endswitch; ?>
                                <?php else: ?> 
                                <?php switch($paper->ac_type):
                                case ('สิทธิบัตร'): ?>
                                Patent
                                <?php break; ?>
                                <?php case ('สิทธิบัตร (การประดิษฐ์)'): ?>
                                Invention Patent
                                <?php break; ?>
                                <?php case ('สิทธิบัตร (การออกแบบผลิตภัณฑ์)'): ?>
                                Design Patent
                                <?php break; ?>
                                <?php case ('อนุสิทธิบัตร'): ?>
                                Utility Model
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์'): ?>
                                Copyright
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (วรรณกรรม)'): ?>
                                Literary Copyright
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (ตนตรีกรรม)'): ?>
                                Musical Copyright
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (ภาพยนตร์)'): ?>
                                Film Copyright
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (ศิลปกรรม)'): ?>
                                Artistic Copyright
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (งานแพร่เสี่ยงแพร่ภาพ)'): ?>
                                Broadcast Copyright
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (โสตทัศนวัสดุ)'): ?>
                                Audiovisual Copyright
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (งานอื่นใดในแผนกวรรณคดี/วิทยาศาสตร์/ศิลปะ)'): ?>
                                Other Literary/Scientific/Artistic Copyright
                                <?php break; ?>
                                <?php case ('ลิขสิทธิ์ (สิ่งบันทึกเสียง)'): ?>
                                Sound Recording Copyright
                                <?php break; ?>
                                <?php case ('ความลับทางการค้า'): ?>
                                Trade Secret
                                <?php break; ?>
                                <?php case ('เครื่องหมายการค้า'): ?>
                                Trademark
                                <?php break; ?>
                                <?php default: ?>
                                <?php echo e($paper->ac_type); ?>

                                <?php endswitch; ?>
                                <?php endif; ?>
                            </td>

                            <td><?php echo e($paper->ac_year); ?></td>
                            <td><?php echo e($paper->ac_refnumber,50); ?></td>
                            <td>
                                <?php $__currentLoopData = $paper->user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(app()->getLocale() == 'th'): ?>
                                <?php echo e($a->fname_th); ?> <?php echo e($a->lname_th); ?>

                                <?php else: ?>
                                <?php echo e($a->fname_en); ?> <?php echo e($a->lname_en); ?>

                                <?php endif; ?>
                                <?php if(!$loop->last): ?>,<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>

                            <td>
                                <form action="<?php echo e(route('patents.destroy',$paper->id)); ?>" method="POST">

                                    <!-- <a class="btn btn-info" href="<?php echo e(route('patents.show',$paper->id)); ?>">Show</a> -->
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="<?php echo e(route('patents.show',$paper->id)); ?>"><i class="mdi mdi-eye"></i></a>
                                    </li>
                                    <!-- <a class="btn btn-primary" href="<?php echo e(route('patents.edit',$paper->id)); ?>">Edit</a> -->
                                    <?php if(Auth::user()->can('update',$paper)): ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo e(route('patents.edit',$paper->id)); ?>"><i class="mdi mdi-pencil"></i></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->can('delete',$paper)): ?>
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <li class="list-inline-item">
                                        <button class="btn btn-outline-danger btn-sm show_confirm" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </li>
                                    <?php endif; ?>
                                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tbody>
            </table>
            <!-- </div> -->
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" defer></script>
<script>
    $(document).ready(function() {
        var table1 = $('#example1').DataTable({
            responsive: true,
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

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/patents/index.blade.php ENDPATH**/ ?>