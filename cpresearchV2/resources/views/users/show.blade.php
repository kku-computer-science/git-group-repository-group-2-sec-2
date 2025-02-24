@extends('dashboards.users.layouts.user-dash-layout')
@section('content')

<div class="container">
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>
    @endif
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{ trans('message.user_info') }}</h4>
                <p class="card-description">{{ trans('message.user_details') }}</p>
                <div class="row mt-2">
                    <h6 class="col-md-3"><b>{{ trans('message.name_th') }}</b></h6>
                    <h6 class="col-md-9">{{$user->title_name_th}} {{ $user->fname_th }} {{ $user->lname_th }}</h6>
                </div>
                <div class="row mt-2">
                    <h6 class="col-md-3"><b>{{ trans('message.name_en') }}</b></h6>
                    <h6 class="col-md-9">{{$user->title_name_en}} {{ $user->fname_en }} {{ $user->lname_en }}</h6>
                </div>
                <div class="row mt-2">
                    <h6 class="col-md-3"><b>{{ trans('message.email') }} :</b></h6>
                    <h6 class="col-md-9">{{ $user->email }}</h6>
                </div>
                @php
    $locale = app()->getLocale();
    $roleMap = [];
    if ($locale == 'th') {
        $roleMap = [
            'admin'       => 'ผู้ดูแลระบบ',
            'teacher'     => 'อาจารย์',
            'student'     => 'นักศึกษา',
            'staff'       => 'เจ้าหน้าที่',
            'headproject' => 'หัวหน้าโครงการ',
        ];
    } elseif ($locale == 'zh') {
        $roleMap = [
            'admin'       => '管理员',
            'teacher'     => '教师',
            'student'     => '学生',
            'staff'       => '职员',
            'headproject' => '项目负责人',
        ];
    }
@endphp

@foreach($user->getRoleNames() as $val)
    <div class="row mt-2">
        <h6 class="col-md-3"><b>{{ trans('message.role') }} </b></h6>
        <h6 class="col-md-9">
            <label class="badge badge-dark">
                @if($locale == 'th' || $locale == 'zh')
                    {{ isset($roleMap[strtolower($val)]) ? $roleMap[strtolower($val)] : $val }}
                @else
                    {{ $val }}
                @endif
            </label>
        </h6>
    </div>
@endforeach

                @if($val == "teacher")
                <div class="row mt-2">
                    <h6 class="col-md-3"><b> {{ trans('message.academic_ranks') }} </b></h6>

                    <!-- ============================================================================ -->
                    @php
    // กำหนด mapping สำหรับ academic_ranks ในภาษาอังกฤษไปเป็นภาษาจีน
    $academic_ranks_map = [
        'Associate Professor'   => '副教授',
        'Professor'             => '教授',
        'Assistant Professor'   => '助理教授',
        'Lecturer'              => '讲师',
    ];
@endphp

<h6 class="col-md-9">
    @if(app()->getLocale() == 'zh')
        {{-- สำหรับภาษาจีน ใช้ mapping ที่เรากำหนด --}}
        {{ $academic_ranks_map[$user->academic_ranks_en] ?? $user->academic_ranks_en }}
    @else
        {{-- สำหรับภาษาอื่น ๆ ดึงจากฟิลด์ที่เก็บไว้ --}}
        {{ $user->{'academic_ranks_'.app()->getLocale()} }}
    @endif
</h6>
                  
                    <!-- ============================================================================ -->

                </div>
                 <!-- ============================================================================ -->
                <div class="row mt-2">
                    <h6 class="col-md-3"><b>{{ trans('message.department') }} </b></h6>
                    @php
    // กำหนด mapping สำหรับชื่อภาควิชา (department_name) สำหรับภาษาจีน
    $department_map = [
        'Department of Computer Science' => '计算机科学系',
        // หากมีภาควิชาอื่นๆ ให้เพิ่มลงไปที่นี่
    ];
@endphp

<h6 class="col-md-9">
    @if(app()->getLocale() == 'zh')
        {{-- ใช้ mapping สำหรับภาษาจีน --}}
        {{ $department_map[$user->program->department->department_name_en] ?? $user->program->department->department_name_en }}
    @else
        {{-- สำหรับภาษาอื่น ๆ ใช้ field ที่เหมาะสม --}}
        {{ $user->program->department->{'department_name_'.app()->getLocale()} }}
    @endif
</h6>

                </div>
                 <!-- ============================================================================ -->
                <div class="row mt-2">
                    <h6 class="col-md-3"><b>{{ trans('message.program') }} </b></h6>
                    @php
    // กำหนด mapping สำหรับ program_name เมื่อ locale เป็น zh
    $program_map = [
        'Computer Science' => '计算机科学',
        'Infomation Technology' => '信息技术',
        'Geo-Informatics' => '地理信息学',
        'Computer Science and Infomation Technology' => '计算机科学与信息技术',
        'Data Science and Artificial Intelligence (International Program)' => '数据科学与人工智能（国际项目）',
        'Computer Science and Infomation Technology (International Program)' => '计算机科学与信息技术（国际项目）',
    ];
@endphp

<h6 class="col-md-9">
    @if(app()->getLocale() == 'zh')
        {{ $program_map[$user->program->program_name_en] ?? $user->program->program_name_en }}
    @else
        {{ $user->program->{'program_name_'.app()->getLocale()} }}
    @endif
</h6>

                </div>
                 <!-- ============================================================================ -->

                <div class="row mt-2">
                    <h6 class="col-md-3"><b>{{ trans('message.education_history') }}</b></h6>

                    <!-- <h6 class="col-md-4" style="line-height:1.4;">@foreach( $user->education as $edu){{$edu->qua_name}} <br>@endforeach</h6> -->
                    @php
    // Define education qualification mappings for each locale

    $edu_qua_en = [
        'วท.บ. (สถิติ)' => 'B.Sc. (Statistics)',
        'พบ.ม (สถิติประยุกต์)' => 'M.Sc. (Applied Statistics)',
        'วท.ด. (วิทยาการคอมพิวเตอร์)' => 'Sc.D. (Computer Science)',
        'วท.บ. (คณิตศาสตร์)' => 'B.Sc. (Mathematics)',
        'วท.ม. (วิทยาศาสตร์คอมพิวเตอร์)' => 'M.Sc. (Computer Science)',
        'ปร.ด. (วิทยาการคอมพิวเตอร์)' => 'Ph.D. (Computer Science)',
        'วท.บ. (ฟิสิกส์)' => 'B.Sc. (Physics)',
        'วท.ม. (วิทยาการคอมพิวเตอร์)' => 'M.Sc. (Computer Science)',
        'Ph.D. (Interdisciplinary Intelligent Systems Engineering)' => 'Ph.D. (Interdisciplinary Intelligent Systems Engineering)',
        'พบ.ม. (สถิติประยุกต์)' => 'M.Sc. (Applied Statistics)',
        'D.Tech.Sc. (Computer Science)' => 'D.Tech.Sc. (Computer Science)',
        'สถ.บ. (สถาปัตยกรรม)' => 'B.Arch. (Architecture)',
        'วท.ม.  (การรับรู้จากระยะไกลและระบบสารสนเทศภูมิศาสตร์)' => 'M.Sc. (Remote Sensing and Geographic Information Systems)',
        'วศ.ด. (วิศวกรรมสำรวจ)' => 'Ph.D. (Survey Engineering)',
        'พบ.ม. สถิติประยุกต์ (สาขาวิทยาการคอมพิวเตอร์)' => 'M.Sc. (Applied Statistics, Computer Science)',
        'วท.บ. (เคมีเทคนิค/เคมีวิศวกรรม)' => 'B.Sc. (Chemical Technology/Chemical Engineering)',
        'วศ.บ. (วิศวกรรมคอมพิวเตอร์)' => 'B.Eng. (Computer Engineering)',
        'MA.Sc. (Electronic Systems  Engineering)' => 'MA.Sc. (Electronic Systems Engineering)',
        'Ph.D. (Electronic Systems Engineering)' => 'Ph.D. (Electronic Systems Engineering)',
        'วท.บ. (ภูมิศาสตร์)' => 'B.Sc. (Geography)',
        'วท.บ. (วิทยาการคอมพิวเตอร์)' => 'B.Sc. (Computer Science)',
        'M.Sc. (Computer Science)' => 'M.Sc. (Computer Science)',
        '-' => '-',
        'วท.ม.  (สถิติประยุกต์และเทคโนโลยีสารสนเทศ)' => 'M.Sc. (Applied Statistics and Information Technology)',
        'Ph.D. (Business Information  Systems)' => 'Ph.D. (Business Information Systems)',
        'อส.บ. (เทคโนโลยีไฟฟ้าอุตสาหกรรม)' => 'B.Eng. (Industrial Electrical Technology)',
        'M.Sc. (Agricultural Engineering)' => 'M.Sc. (Agricultural Engineering)',
        'Ph.D. (Agricultural Engineering)' => 'Ph.D. (Agricultural Engineering)',
        'วศ.ม. (วิศวกรรมคอมพิวเตอร์)' => 'M.Eng. (Computer Engineering)',
        'วศ.ด. (วิศวกรรมคอมพิวเตอร์)' => 'Ph.D. (Computer Engineering)',
        'วท.ม. (สถิติประยุกต์)' => 'M.Sc. (Applied Statistics)',
        'วศ.ด. (วิศวกรรมไฟฟ้า)' => 'Ph.D. (Electrical Engineering)',
        'ปร.ด. (วิธีการเรียนรู้ทางอิเล็กทรอนิกส์)' => 'Ph.D. (Electronic Learning Methods)',
        'วท.บ. (วิทยาศาสตร์สิ่งแวดล้อม)' => 'B.Sc. (Environmental Science)',
        'ปร.ด.  (การรับรู้จากระยะไกลและระบบสารสนเทศภูมิศาสตร์)' => 'Ph.D. (Remote Sensing and Geographic Information Systems)',
        'วท.บ. (ศาสตร์คอมพิวเตอร์)' => 'B.Sc. (Computer Science)',
        'M.Eng. (Information and Communication Technology for Embedded Systems)' => 'M.Eng. (Information and Communication Technology for Embedded Systems)',
        'Ph.D. (Information Engineering)' => 'Ph.D. (Information Engineering)',
        'ปร.ด. (สารสนเทศศึกษา)' => 'Ph.D. (Information Studies)',
        'Ph.D. (Remote Sensing and Geographic Information Systems)' => 'Ph.D. (Remote Sensing and Geographic Information Systems)',
        'B.S. (Computer Science)' => 'B.S. (Computer Science)',
        'MGIS (Geographic Information  Science)' => 'MGIS (Geographic Information Science)',
        'วท.บ. (ธรณีวิทยา)' => 'B.Sc. (Geology)',
        'M.Sc. (Rural and Land Ecology  Survey)' => 'M.Sc. (Rural and Land Ecology Survey)',
        'วท.ด. (ปฐพีศาสตร์)' => 'Sc.D. (Earth Science)',
        'วศ.ม (วิศวกรรมคอมพิวเตอร์)' => 'M.Eng. (Computer Engineering)',
        'Ph.D. (Information Systems and  Technology)' => 'Ph.D. (Information Systems and Technology)',
    ];

    $edu_qua_th = [
        'วท.บ. (สถิติ)' => 'วท.บ. (สถิติ)',
        'พบ.ม (สถิติประยุกต์)' => 'พบ.ม (สถิติประยุกต์)',
        'วท.ด. (วิทยาการคอมพิวเตอร์)' => 'วท.ด. (วิทยาการคอมพิวเตอร์)',
        'วท.บ. (คณิตศาสตร์)' => 'วท.บ. (คณิตศาสตร์)',
        'วท.ม. (วิทยาศาสตร์คอมพิวเตอร์)' => 'วท.ม. (วิทยาศาสตร์คอมพิวเตอร์)',
        'ปร.ด. (วิทยาการคอมพิวเตอร์)' => 'ปร.ด. (วิทยาการคอมพิวเตอร์)',
        'วท.บ. (ฟิสิกส์)' => 'วท.บ. (ฟิสิกส์)',
        'วท.ม. (วิทยาการคอมพิวเตอร์)' => 'วท.ม. (วิทยาการคอมพิวเตอร์)',
        'Ph.D. (Interdisciplinary Intelligent Systems Engineering)' => 'Ph.D. (Interdisciplinary Intelligent Systems Engineering)',
        'พบ.ม. (สถิติประยุกต์)' => 'พบ.ม. (สถิติประยุกต์)',
        'D.Tech.Sc. (Computer Science)' => 'D.Tech.Sc. (Computer Science)',
        'สถ.บ. (สถาปัตยกรรม)' => 'สถ.บ. (สถาปัตยกรรม)',
        'วท.ม.  (การรับรู้จากระยะไกลและระบบสารสนเทศภูมิศาสตร์)' => 'วท.ม.  (การรับรู้จากระยะไกลและระบบสารสนเทศภูมิศาสตร์)',
        'วศ.ด. (วิศวกรรมสำรวจ)' => 'วศ.ด. (วิศวกรรมสำรวจ)',
        'พบ.ม. สถิติประยุกต์ (สาขาวิทยาการคอมพิวเตอร์)' => 'พบ.ม. สถิติประยุกต์ (สาขาวิทยาการคอมพิวเตอร์)',
        'วท.บ. (เคมีเทคนิค/เคมีวิศวกรรม)' => 'วท.บ. (เคมีเทคนิค/เคมีวิศวกรรม)',
        'วศ.บ. (วิศวกรรมคอมพิวเตอร์)' => 'วศ.บ. (วิศวกรรมคอมพิวเตอร์)',
        'MA.Sc. (Electronic Systems  Engineering)' => 'MA.Sc. (Electronic Systems  Engineering)',
        'Ph.D. (Electronic Systems Engineering)' => 'Ph.D. (Electronic Systems Engineering)',
        'วท.บ. (ภูมิศาสตร์)' => 'วท.บ. (ภูมิศาสตร์)',
        'วท.บ. (วิทยาการคอมพิวเตอร์)' => 'วท.บ. (วิทยาการคอมพิวเตอร์)',
        'M.Sc. (Computer Science)' => 'M.Sc. (Computer Science)',
        '-' => '-',
        'วท.ม.  (สถิติประยุกต์และเทคโนโลยีสารสนเทศ)' => 'วท.ม.  (สถิติประยุกต์และเทคโนโลยีสารสนเทศ)',
        'Ph.D. (Business Information  Systems)' => 'Ph.D. (Business Information  Systems)',
        'อส.บ. (เทคโนโลยีไฟฟ้าอุตสาหกรรม)' => 'อส.บ. (เทคโนโลยีไฟฟ้าอุตสาหกรรม)',
        'M.Sc. (Agricultural Engineering)' => 'M.Sc. (Agricultural Engineering)',
        'Ph.D. (Agricultural Engineering)' => 'Ph.D. (Agricultural Engineering)',
        'วศ.ม. (วิศวกรรมคอมพิวเตอร์)' => 'วศ.ม. (วิศวกรรมคอมพิวเตอร์)',
        'วศ.ด. (วิศวกรรมคอมพิวเตอร์)' => 'วศ.ด. (วิศวกรรมคอมพิวเตอร์)',
        'วท.ม. (สถิติประยุกต์)' => 'วท.ม. (สถิติประยุกต์)',
        'วศ.ด. (วิศวกรรมไฟฟ้า)' => 'วศ.ด. (วิศวกรรมไฟฟ้า)',
        'ปร.ด. (วิธีการเรียนรู้ทางอิเล็กทรอนิกส์)' => 'ปร.ด. (วิธีการเรียนรู้ทางอิเล็กทรอนิกส์)',
        'วท.บ. (วิทยาศาสตร์สิ่งแวดล้อม)' => 'วท.บ. (วิทยาศาสตร์สิ่งแวดล้อม)',
        'ปร.ด.  (การรับรู้จากระยะไกลและระบบสารสนเทศภูมิศาสตร์)' => 'ปร.ด.  (การรับรู้จากระยะไกลและระบบสารสนเทศภูมิศาสตร์)',
        'วท.บ. (ศาสตร์คอมพิวเตอร์)' => 'วท.บ. (ศาสตร์คอมพิวเตอร์)',
        'M.Eng. (Information and Communication Technology for Embedded Systems)' => 'M.Eng. (Information and Communication Technology for Embedded Systems)',
        'Ph.D. (Information Engineering)' => 'Ph.D. (Information Engineering)',
        'ปร.ด. (สารสนเทศศึกษา)' => 'ปร.ด. (สารสนเทศศึกษา)',
        'Ph.D. (Remote Sensing and Geographic Information Systems)' => 'Ph.D. (Remote Sensing and Geographic Information Systems)',
        'B.S. (Computer Science)' => 'B.S. (Computer Science)',
        'MGIS (Geographic Information  Science)' => 'MGIS (Geographic Information  Science)',
        'วท.บ. (ธรณีวิทยา)' => 'วท.บ. (ธรณีวิทยา)',
        'M.Sc. (Rural and Land Ecology  Survey)' => 'M.Sc. (Rural and Land Ecology  Survey)',
        'วท.ด. (ปฐพีศาสตร์)' => 'วท.ด. (ปฐพีศาสตร์)',
        'วศ.ม (วิศวกรรมคอมพิวเตอร์)' => 'วศ.ม (วิศวกรรมคอมพิวเตอร์)',
        'Ph.D. (Information Systems and  Technology)' => 'Ph.D. (Information Systems and  Technology)',
    ];

    $edu_qua_zh = [
        'วท.บ. (สถิติ)' => '理学学士（统计学）',
        'พบ.ม (สถิติประยุกต์)' => '理学硕士（应用统计学）',
        'วท.ด. (วิทยาการคอมพิวเตอร์)' => '理学博士（计算机科学）',
        'วท.บ. (คณิตศาสตร์)' => '理学学士（数学）',
        'วท.ม. (วิทยาศาสตร์คอมพิวเตอร์)' => '理学硕士（计算机科学）',
        'ปร.ด. (วิทยาการคอมพิวเตอร์)' => '博士（计算机科学）',
        'วท.บ. (ฟิสิกส์)' => '理学学士（物理学）',
        'วท.ม. (วิทยาการคอมพิวเตอร์)' => '理学硕士（计算机科学）',
        'Ph.D. (Interdisciplinary Intelligent Systems Engineering)' => '博士（跨学科智能系统工程）',
        'พบ.ม. (สถิติประยุกต์)' => '理学硕士（应用统计学）',
        'D.Tech.Sc. (Computer Science)' => '工学博士（计算机科学）',
        'สถ.บ. (สถาปัตยกรรม)' => '建筑学学士（建筑学）',
        'วท.ม.  (การรับรู้จากระยะไกลและระบบสารสนเทศภูมิศาสตร์)' => '理学硕士（遥感与地理信息系统）',
        'วศ.ด. (วิศวกรรมสำรวจ)' => '博士（测量工程）',
        'พบ.ม. สถิติประยุกต์ (สาขาวิทยาการคอมพิวเตอร์)' => '理学硕士（应用统计学，计算机科学）',
        'วท.บ. (เคมีเทคนิค/เคมีวิศวกรรม)' => '理学学士（化学技术/化学工程）',
        'วศ.บ. (วิศวกรรมคอมพิวเตอร์)' => '工学学士（计算机工程）',
        'MA.Sc. (Electronic Systems  Engineering)' => '理学硕士（电子系统工程）',
        'Ph.D. (Electronic Systems Engineering)' => '博士（电子系统工程）',
        'วท.บ. (ภูมิศาสตร์)' => '理学学士（地理学）',
        'วท.บ. (วิทยาการคอมพิวเตอร์)' => '理学学士（计算机科学）',
        'M.Sc. (Computer Science)' => '理学硕士（计算机科学）',
        '-' => '-',
        'วท.ม.  (สถิติประยุกต์และเทคโนโลยีสารสนเทศ)' => '理学硕士（应用统计与信息技术）',
        'Ph.D. (Business Information  Systems)' => '博士（商业信息系统）',
        'อส.บ. (เทคโนโลยีไฟฟ้าอุตสาหกรรม)' => '工学学士（工业电气技术）',
        'M.Sc. (Agricultural Engineering)' => '理学硕士（农业工程）',
        'Ph.D. (Agricultural Engineering)' => '博士（农业工程）',
        'วศ.ม. (วิศวกรรมคอมพิวเตอร์)' => '工学硕士（计算机工程）',
        'วศ.ด. (วิศวกรรมคอมพิวเตอร์)' => '博士（计算机工程）',
        'วท.ม. (สถิติประยุกต์)' => '理学硕士（应用统计学）',
        'วศ.ด. (วิศวกรรมไฟฟ้า)' => '博士（电气工程）',
        'ปร.ด. (วิธีการเรียนรู้ทางอิเล็กทรอนิกส์)' => '博士（电子学习方法）',
        'วท.บ. (วิทยาศาสตร์สิ่งแวดล้อม)' => '理学学士（环境科学）',
        'ปร.ด.  (การรับรู้จากระยะไกลและระบบสารสนเทศภูมิศาสตร์)' => '博士（遥感与地理信息系统）',
        'วท.บ. (ศาสตร์คอมพิวเตอร์)' => '理学学士（计算机科学）',
        'M.Eng. (Information and Communication Technology for Embedded Systems)' => '工学硕士（嵌入式系统信息与通信技术）',
        'Ph.D. (Information Engineering)' => '博士（信息工程）',
        'ปร.ด. (สารสนเทศศึกษา)' => '博士（信息学）',
        'Ph.D. (Remote Sensing and Geographic Information Systems)' => '博士（遥感与地理信息系统）',
        'B.S. (Computer Science)' => '理学学士（计算机科学）',
        'MGIS (Geographic Information  Science)' => 'MGIS（地理信息科学）',
        'วท.บ. (ธรณีวิทยา)' => '理学学士（地质学）',
        'M.Sc. (Rural and Land Ecology  Survey)' => '理学硕士（乡村与土地生态调查）',
        'วท.ด. (ปฐพีศาสตร์)' => '理学博士（地球科学）',
        'วศ.ม (วิศวกรรมคอมพิวเตอร์)' => '工学硕士（计算机工程）',
        'Ph.D. (Information Systems and  Technology)' => '博士（信息系统与技术）',
    ];

    $locale = app()->getLocale();

    if ($locale === 'zh') {
        $edu_qua_map = $edu_qua_zh;
    } elseif ($locale === 'en') {
        $edu_qua_map = $edu_qua_en;
    } else {
        $edu_qua_map = $edu_qua_th;
    }
@endphp

<h6 class="col-md-4" style="line-height:1.4;">
    @foreach($user->education as $edu)
        {{ $edu_qua_map[$edu->qua_name] ?? $edu->qua_name }}<br>
    @endforeach
</h6>



@php
    // Mapping สำหรับชื่อมหาวิทยาลัยในแต่ละภาษา

    $uni_en = [
        "มหาวิทยาลัยเกษตรศาสตร์" => "Kasetsart University",
        "สถาบันบัณฑิตพัฒนบริหารศาสตร์" => "National Institute of Development Administration",
        "จุฬาลงกรณ์มหาวิทยาลัย" => "Chulalongkorn University",
        "มหาวิทยาลัยขอนแก่น" => "Khon Kaen University",
        "University of the Ryukyus, Japan" => "University of the Ryukyus, Japan",
        "Asian Institute of Technology,  Thailand" => "Asian Institute of Technology, Thailand",
        "สถาบันเทคโนโลยีพระจอมเกล้า เจ้าคุณทหารลาดกระบัง" => "King Mongkut's Institute of Technology Ladkrabang",
        "University of Regina, Canada" => "University of Regina, Canada",
        "มหาวิทยาลัยนเรศวร" => "Naresuan University",
        "University of Southern California, USA" => "University of Southern California, USA",
        "-" => "-",
        "Auckland University of Technology, New Zealand" => "Auckland University of Technology, New Zealand",
        "มหาวิทยาลัยเทคโนโลยี พระจอมเกล้าพระนครเหนือ" => "King Mongkut's University of Technology North Bangkok",
        "Iowa State University, Iowa,  USA" => "Iowa State University, USA",
        "มหาวิทยาลัยมหาสารคาม" => "Mahasarakham University",
        "มหาวิทยาลัยอัสสัมชัญ" => "Assumption University",
        "มหาวิทยาลัยธรรมศาสตร์" => "Thammasat University",
        "Hiroshima University, Japan" => "Hiroshima University, Japan",
        "Asian Institute of Technology, Thailand" => "Asian Institute of Technology, Thailand",
        "University of Minnesota (Twin  Cities), USA" => "University of Minnesota (Twin Cities), USA",
        "University of Minnesota (Twin Cities), USA" => "University of Minnesota (Twin Cities), USA",
        "University of Southern California (USC), USA" => "University of Southern California (USC), USA",
        "มหาวิทยาลัยเชียงใหม่" => "Chiang Mai University",
        "International Institute for Aerospace Survey and Earth Sciences (ITC)" => "International Institute for Aerospace Survey and Earth Sciences (ITC)",
        "Claremont Graduate University, USA" => "Claremont Graduate University, USA",
    ];

    $uni_th = [
        "มหาวิทยาลัยเกษตรศาสตร์" => "มหาวิทยาลัยเกษตรศาสตร์",
        "สถาบันบัณฑิตพัฒนบริหารศาสตร์" => "สถาบันบัณฑิตพัฒนบริหารศาสตร์",
        "จุฬาลงกรณ์มหาวิทยาลัย" => "จุฬาลงกรณ์มหาวิทยาลัย",
        "มหาวิทยาลัยขอนแก่น" => "มหาวิทยาลัยขอนแก่น",
        "University of the Ryukyus, Japan" => "University of the Ryukyus, Japan",
        "Asian Institute of Technology,  Thailand" => "Asian Institute of Technology,  Thailand",
        "สถาบันเทคโนโลยีพระจอมเกล้า เจ้าคุณทหารลาดกระบัง" => "สถาบันเทคโนโลยีพระจอมเกล้า เจ้าคุณทหารลาดกระบัง",
        "University of Regina, Canada" => "University of Regina, Canada",
        "มหาวิทยาลัยนเรศวร" => "มหาวิทยาลัยนเรศวร",
        "University of Southern California, USA" => "University of Southern California, USA",
        "-" => "-",
        "Auckland University of Technology, New Zealand" => "Auckland University of Technology, New Zealand",
        "มหาวิทยาลัยเทคโนโลยี พระจอมเกล้าพระนครเหนือ" => "มหาวิทยาลัยเทคโนโลยี พระจอมเกล้าพระนครเหนือ",
        "Iowa State University, Iowa,  USA" => "Iowa State University, Iowa,  USA",
        "มหาวิทยาลัยมหาสารคาม" => "มหาวิทยาลัยมหาสารคาม",
        "มหาวิทยาลัยอัสสัมชัญ" => "มหาวิทยาลัยอัสสัมชัญ",
        "มหาวิทยาลัยธรรมศาสตร์" => "มหาวิทยาลัยธรรมศาสตร์",
        "Hiroshima University, Japan" => "Hiroshima University, Japan",
        "Asian Institute of Technology, Thailand" => "Asian Institute of Technology, Thailand",
        "University of Minnesota (Twin  Cities), USA" => "University of Minnesota (Twin  Cities), USA",
        "University of Minnesota (Twin Cities), USA" => "University of Minnesota (Twin Cities), USA",
        "University of Southern California (USC), USA" => "University of Southern California (USC), USA",
        "มหาวิทยาลัยเชียงใหม่" => "มหาวิทยาลัยเชียงใหม่",
        "International Institute for Aerospace Survey and Earth Sciences (ITC)" => "International Institute for Aerospace Survey and Earth Sciences (ITC)",
        "Claremont Graduate University, USA" => "Claremont Graduate University, USA",
    ];

    $uni_zh = [
        "มหาวิทยาลัยเกษตรศาสตร์" => "卡农业大学",
        "สถาบันบัณฑิตพัฒนบริหารศาสตร์" => "国家发展管理学院",
        "จุฬาลงกรณ์มหาวิทยาลัย" => "朱拉隆功大学",
        "มหาวิทยาลัยขอนแก่น" => "孔敬大学",
        "University of the Ryukyus, Japan" => "琉球大学，日本",
        "Asian Institute of Technology,  Thailand" => "亚洲理工学院，泰国",
        "สถาบันเทคโนโลยีพระจอมเกล้า เจ้าคุณทหารลาดกระบัง" => "国王蒙库特理工大学（拉差班）",
        "University of Regina, Canada" => "瑞吉纳大学，加拿大",
        "มหาวิทยาลัยนเรศวร" => "那烈素安大学",
        "University of Southern California, USA" => "南加州大学，美国",
        "-" => "-",
        "Auckland University of Technology, New Zealand" => "奥克兰理工大学，新西兰",
        "มหาวิทยาลัยเทคโนโลยี พระจอมเกล้าพระนครเหนือ" => "国王蒙库特北曼谷理工大学",
        "Iowa State University, Iowa,  USA" => "爱荷华州立大学",
        "มหาวิทยาลัยมหาสารคาม" => "马哈沙拉坎大学",
        "มหาวิทยาลัยอัสสัมชัญ" => "阿萨普申大学",
        "มหาวิทยาลัยธรรมศาสตร์" => "法政大学",
        "Hiroshima University, Japan" => "广岛大学，日本",
        "Asian Institute of Technology, Thailand" => "亚洲理工学院，泰国",
        "University of Minnesota (Twin  Cities), USA" => "明尼苏达大学（双城），美国",
        "University of Minnesota (Twin Cities), USA" => "明尼苏达大学（双城），美国",
        "University of Southern California (USC), USA" => "南加州大学（USC），美国",
        "มหาวิทยาลัยเชียงใหม่" => "清迈大学",
        "International Institute for Aerospace Survey and Earth Sciences (ITC)" => "国际航空测量与地球科学研究院 (ITC)",
        "Claremont Graduate University, USA" => "克莱蒙特研究生大学，美国",
    ];

    $locale = app()->getLocale();

    if ($locale === 'zh') {
        $uni_map = $uni_zh;
    } elseif ($locale === 'en') {
        $uni_map = $uni_en;
    } else {
        $uni_map = $uni_th;
    }
@endphp

<h6 class="col-md-5" style="line-height:1.4;">
    @foreach($user->education as $edu)
        {{ $uni_map[$edu->uname] ?? $edu->uname }}<br>
    @endforeach
</h6>
                </div>
                @endif
                <div class="row mt-2">
                    <h6 class="col-md-3"><b>{{ trans('message.password') }} :</b></h6>
                    <h6 class="col-md-9"></h6>
                </div>
                <div class="row mt-2">
                    <h6 class="col-md-3"><b>Scholar ID :</b></h6>
                    <h6 class="col-md-9">{{ $user->scholar_id ?? '-' }}</h6>
                </div>
                @can('role-create')
                <a class="btn btn-primary btn-sm mt-5" href="{{ route('users.index') }}">{{ trans('message.back') }}</a>
                @endcan
            </div>
        </div>
    </div>
</div>

@endsection
