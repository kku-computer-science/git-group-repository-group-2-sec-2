
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
            <h4 class="card-title"><?php echo e(trans('message.published_research')); ?></h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="<?php echo e(route('papers.create')); ?>"><i class="mdi mdi-plus btn-icon-prepend"></i> <?php echo e(trans('message.add')); ?></a>
            <?php if(Auth::user()->hasRole('teacher')): ?>
            <!-- <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="<?php echo e(route('callscopus',Auth::user()->id)); ?>"><i class="mdi mdi-refresh btn-icon-prepend"></i> Call Paper</a> -->
            <a class="btn btn-primary btn-icon-text btn-sm mb-3" href="<?php echo e(route('callpaper', Crypt::encrypt(Auth::user()->id))); ?>">
                <i class="mdi mdi-refresh btn-icon-prepend icon-sm"></i> <?php echo e(trans('message.published_research_call_paper')); ?>

            </a>

            <?php endif; ?>
            <!-- <div class="table-responsive"> -->
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo e(trans('message.no_dot')); ?></th>
                        <th><?php echo e(trans('message.published_research_name')); ?></th>
                        <th><?php echo e(trans('message.published_research_type')); ?></th>
                        <th><?php echo e(trans('message.published_research_year')); ?></th>
                        <!-- <th>ผู้เขียน</th>   -->
                        <!-- <th>Source Title</th> -->
                        <th width="280px"><?php echo e(trans('message.action')); ?></th>
                    </tr>
                    <thead>
                    <tbody>
                        <?php $__currentLoopData = $papers->sortByDesc('paper_yearpub'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i+1); ?></td>
                            <td><?php echo e(Str::limit($paper->paper_name,50)); ?></td>
                            <td>
                                <?php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                ?>

                                <?php if($locale == 'th'): ?>
                                <?php switch($paper->paper_type):
                                case ('Journal'): ?>
                                วารสาร
                                <?php break; ?>
                                <?php case ('Conference Proceeding'): ?>
                                เอกสารการประชุม
                                <?php break; ?>
                                <?php case ('Book Series'): ?>
                                หนังสือชุด
                                <?php break; ?>
                                <?php case ('Book'): ?>
                                หนังสือ
                                <?php break; ?>
                                <?php default: ?>
                                <?php echo e($paper->paper_type); ?>

                                <?php endswitch; ?>
                                <?php elseif($locale == 'zh'): ?>
                                <?php switch($paper->paper_type):
                                case ('Journal'): ?>
                                期刊
                                <?php break; ?>
                                <?php case ('Conference Proceeding'): ?>
                                会议论文
                                <?php break; ?>
                                <?php case ('Book Series'): ?>
                                丛书
                                <?php break; ?>
                                <?php case ('Book'): ?>
                                书籍
                                <?php break; ?>
                                <?php default: ?>
                                <?php echo e($paper->paper_type); ?>

                                <?php endswitch; ?>
                                <?php else: ?>
                                <?php echo e($paper->paper_type); ?>

                                <?php endif; ?>
                            </td>

                            <td><?php echo e($paper->paper_yearpub); ?></td>
                            <!-- <td><?php $__currentLoopData = $paper->teacher->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($teacher->fname_en); ?> <?php echo e($teacher->lname_en); ?>,
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $paper->author->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($teacher->author_fname); ?> <?php echo e($teacher->author_lname); ?>

                                    <?php if(!$loop->last): ?>,<?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </td> -->
                            <!-- <td><?php echo e(Str::limit($paper->paper_sourcetitle,50)); ?></td> -->

                            <td>
                                <form action="<?php echo e(route('papers.destroy',$paper->id)); ?>" method="POST">

                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="<?php echo e(route('papers.show',$paper->id)); ?>"><i class="mdi mdi-eye"></i></a>
                                    </li>
                                    <?php if(Auth::user()->can('update',$paper)): ?>
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo e(route('papers.edit',Crypt::encrypt($paper->id))); ?>"><i class="mdi mdi-pencil"></i></a>
                                    </li>
                                    <?php endif; ?>
                                    <!-- <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <li class="list-inline-item">
                                         <button class="btn btn-outline-danger btn-sm show_confirm" type="submit"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                 class="mdi mdi-delete"></i></button>
                                        </li> -->
                                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tbody>
            </table>
            <br>

            <!-- </div> -->
            <br>

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

<?php echo $__env->make('dashboards.users.layouts.user-dash-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Work2568\ProjectSoften\git-group-repository-group-2-sec-2\cpresearchV2\code\resources\views/papers/index.blade.php ENDPATH**/ ?>