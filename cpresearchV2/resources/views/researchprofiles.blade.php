@extends('layouts.layout')
<style>
    .count {
        background-color: #fff;
        padding: 2px 0;
        border-radius: 5px;


    }

    .count-title {
        font-size: 25px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
        line-height: 1.8;
        font-weight: 800;
    }

    .count-text {
        font-size: 13px;
        font-weight: normal;
        margin-top: 5px;
        margin-bottom: 0;
        text-align: center;
        color: #000;


    }

    .fa-2x {
        margin: 0 auto;
        float: none;
        display: table;
        color: #4ad1e5;
    }
</style>

@section('content')

<div class="container cardprofile mt-5">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-2">
                <img class="card-image" src="{{$res->picture}}" alt="">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h6 class="card-text"><b>{{$res->position_th}} {{$res->fname_th}} {{$res->lname_th}}</b></h6>
                    @if($res->doctoral_degree == 'Ph.D.')
                    <h6 class="card-text"><b>{{$res->fname_en}} {{$res->lname_en}}, {{$res->doctoral_degree}} </b>
                        @else
                        <h6 class="card-text"><b>{{$res->fname_en}} {{$res->lname_en}}</b>
                            @endif</h6>
                            <h6 class="card-text1"><b>{{$res->{'academic_ranks_' . app()->getLocale()} }}</b></h6>
                        <!-- <h6 class="card-text1">Department of {{$res->program->program_name_en}}</h6> -->
                        <!-- <h6 class="card-text1">College of Computing</h6>
                    <h6 class="card-text1">Khon Kaen University</h6> -->
                        <h6 class="card-text1">E-mail: {{$res->email}}</h6>
                        <h6 class="card-title">{{ trans('message.education') }}</h6>
                        @php

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

                        @foreach( $res->education as $edu)
                        <h6 class="card-text2 col-sm-10"> {{$edu->year}} {{$edu_qua_map[$edu->qua_name] ?? $edu->qua_name}} {{$uni_map[$edu->uname] ?? $edu->uname}}</h6>
                        @endforeach
                        <!-- <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            {{ trans('message.expertise') }}
                        </button> -->
                        <!-- <h6 class="card-title">Metrics overview</h6>
                    <h6 class="card-text2" id="citation">Citation count</h6>
                    <h6 class="card-text2" id="doc_count">Document count</h6>
                    <h6 class="card-text2" id="cite_count">Cited By count</h6>
                    <h6 class="card-text2" id="h-index">H-index </h6> -->

                </div>
            </div>

            <div class="col-md-4">
                <h6 class="title-pub">{{ trans('message.publications2') }}</h6>
                <div class="col-xs-12 text-center bt">
                    <div class="clearfix"></div>
                    <div class="row text-center">
                        <div class="col">
                            <div class="count" id='all'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="count" id='scopus_sum'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="count" id='wos_sum'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="count" id='tci_sum'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="count" id='scholar_sum'>
                        </div>
                        </div>


                    </div>
                    <br>
                    <div class="chart">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ความเชี่ยวชาญ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @foreach($res->expertise as $exper)
                                <p class="card-text"> {{$exper->expert_name}}</p>
                                @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->
    <br>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">{{ trans('message.Summary') }}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="scopus-tab" data-bs-toggle="tab" data-bs-target="#scopus" type="button" role="tab" aria-controls="scopus" aria-selected="false">SCOPUS</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="wos-tab" data-bs-toggle="tab" data-bs-target="#wos" type="button" role="tab" aria-controls="wos" aria-selected="false">Web of Science</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tci-tab" data-bs-toggle="tab" data-bs-target="#tci" type="button" role="tab" aria-controls="tci" aria-selected="false">TCI</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="book-tab" data-bs-toggle="tab" data-bs-target="#book" type="button" role="tab" aria-controls="book" aria-selected="false">{{ trans('message.Book') }}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="patent-tab" data-bs-toggle="tab" data-bs-target="#patent" type="button" role="tab" aria-controls="patent" aria-selected="false">{{ trans('message.Others') }}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="scholar-tab" data-bs-toggle="tab" data-bs-target="#scholar" type="button" role="tab" aria-controls="scholar" aria-selected="false">Scholar</button>
        </li>
    </ul>
    <br>
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="tab-content" style="padding-bottom: 20px;">
                <a class="btn btn-success" href="{{ route('excel', ['id' => $res->id]) }}" target="_blank">{{ trans('message.Export to Excel')}}</a>
            </div>
            <table id="example1" class="table table-striped" style="width:100%">
                <thead>
                    <!-- <tr>
                        <th><a href="{{ route('excel', ['id' => $res->id]) }}" target="_blank">#Export</a></td>
                    </tr> -->
                    <tr>
                        <th>{{ trans('message.No.') }}</th>
                        <th>{{ trans('message.Year') }}</th>
                        <th>{{ trans('message.Paper Name') }}</th>
                        <th>{{ trans('message.Author') }}</th>
                        <th>{{ trans('message.Document Type') }}</th>
                        <th>{{ trans('message.Page') }}</th>
                        <th>{{ trans('message.Journals/Transactions') }}</th>
                        <th>{{ trans('message.Citations') }}</th>
                        <th>{{ trans('message.Doi') }}</th>
                        <th>{{ trans('message.Source') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($papers as $n => $paper)
                    <tr>
                        <td> {{$n+1}}</td>
                        <td>{{ $paper->paper_yearpub }}</td>
                        <!-- <td style="width:90%;">{{$paper->paper_name}}</td> -->
                        <td style="width:90%;">{!! html_entity_decode(preg_replace('<inf>', 'sub', $paper->paper_name)) !!}</td>
                        <td>
                            @foreach ($paper->author as $author)
                            <span>
                                <a>{{$author -> author_fname}} {{$author -> author_lname}}</a>
                            </span>
                            @endforeach
                            @foreach ($paper->teacher as $author)
                            <span >
                                <a href="{{ route('detail',Crypt::encrypt($author->id))}}">
                                <teacher>@php
        $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
        $fname = $author->{'fname_' . $locale} ?? $author->fname_en;
        $lname = $author->{'lname_' . $locale} ?? $author->lname_en;
        if ($locale != 'th' && $locale != 'en') {
            $fname = $author->fname_en;
            $lname = $author->lname_en;
        }
    @endphp
    {{ $fname }} {{ $lname }}</teacher>
                                </a>
                            </span>
                            @endforeach
                        </td>
                        <td>@php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                @endphp

                                @if ($locale == 'th')
                                @switch($paper->paper_type)
                                @case('Journal')
                                วารสาร
                                @break
                                @case('Conference Proceeding')
                                เอกสารการประชุม
                                @break
                                @case('Book Series')
                                หนังสือชุด
                                @break
                                @case('Book')
                                หนังสือ
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @elseif ($locale == 'zh')
                                @switch($paper->paper_type)
                                @case('Journal')
                                期刊
                                @break
                                @case('Conference Proceeding')
                                会议论文
                                @break
                                @case('Book Series')
                                丛书
                                @break
                                @case('Book')
                                书籍
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @else
                                {{ $paper->paper_type }}
                                @endif</td>
                        <td style="width:100%;">{{$paper->paper_page}}</td>
                        <td>{{$paper->paper_sourcetitle}}</td>
                        <td>{{$paper->paper_citation}}</td>
                        <td>{{$paper->paper_doi}}</td>
                        <td>
                            @foreach ($paper->source as $s)
                            <span>
                                <a>{{$s -> source_name}}@if (!$loop->last) , @endif</a>
                            </span>
                            @endforeach
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
        <div class="tab-pane fade" id="scopus" role="tabpanel" aria-labelledby="scopus-tab">

            <table id="example2" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ trans('message.No.') }}</th>
                        <th>{{ trans('message.Year') }}</th>
                        <th style="width:90%">{{ trans('message.Paper Name') }}</th>
                        <th>{{ trans('message.Author') }}</th>
                        <th>{{ trans('message.Document Type') }}</th>
                        <th style="width:100%">{{ trans('message.Page') }}</th>
                        <th>{{ trans('message.Journals/Transactions') }}</th>
                        <th>{{ trans('message.Citations') }}</th>
                        <th>{{ trans('message.Doi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($papers_scopus as $n => $paper)
                    <tr>
                        <td> {{$n+1}}</td>
                        <td>{{ $paper->paper_yearpub }}</td>
                        <!-- <td style="width:90%;">{{$paper->paper_name}}</td> -->
                        <td style="width:90%;">{!! html_entity_decode(preg_replace('<inf>', 'sub', $paper->paper_name)) !!}</td>
                        <td>
                            @foreach ($paper->author as $author)
                            <span>
                                <a>{{$author -> author_fname}} {{$author -> author_lname}}</a>
                            </span>
                            @endforeach
                            @foreach ($paper->teacher as $author)
                            <span>
                                <a href="{{ route('detail',Crypt::encrypt($author->id))}}">
                                <teacher>@php
        $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
        $fname = $author->{'fname_' . $locale} ?? $author->fname_en;
        $lname = $author->{'lname_' . $locale} ?? $author->lname_en;
        if ($locale != 'th' && $locale != 'en') {
            $fname = $author->fname_en;
            $lname = $author->lname_en;
        }
    @endphp
    {{ $fname }} {{ $lname }}</teacher>
                                </a>
                            </span>
                            @endforeach
                        </td>
                        <td>@php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                @endphp

                                @if ($locale == 'th')
                                @switch($paper->paper_type)
                                @case('Journal')
                                วารสาร
                                @break
                                @case('Conference Proceeding')
                                เอกสารการประชุม
                                @break
                                @case('Book Series')
                                หนังสือชุด
                                @break
                                @case('Book')
                                หนังสือ
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @elseif ($locale == 'zh')
                                @switch($paper->paper_type)
                                @case('Journal')
                                期刊
                                @break
                                @case('Conference Proceeding')
                                会议论文
                                @break
                                @case('Book Series')
                                丛书
                                @break
                                @case('Book')
                                书籍
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @else
                                {{ $paper->paper_type }}
                                @endif</td>
                        <td style="width:100%;">{{$paper->paper_page}}</td>
                        <td>{{$paper->paper_sourcetitle}}</td>
                        <td>{{$paper->paper_citation}}</td>
                        <td>{{$paper->paper_doi}}</td>


                    </tr>
                    @endforeach
                </tbody>

            </table>


        </div>
        <div class="tab-pane fade" id="wos" role="tabpanel" aria-labelledby="wos-tab">

            <table id="example3" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                    <th>{{ trans('message.No.') }}</th>
                        <th>{{ trans('message.Year') }}</th>
                        <th style="width:90%">{{ trans('message.Paper Name') }}</th>
                        <th>{{ trans('message.Author') }}</th>
                        <th>{{ trans('message.Document Type') }}</th>
                        <th style="width:100%">{{ trans('message.Page') }}</th>
                        <th>{{ trans('message.Journals/Transactions') }}</th>
                        <th>{{ trans('message.Citations') }}</th>
                        <th>{{ trans('message.Doi') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($papers_wos as $n => $paper)
                    <tr>
                        <td> {{$n+1}}</td>
                        <td>{{ $paper->paper_yearpub }}</td>
                        <!-- <td style="width:90%;">{{$paper->paper_name}}</td> -->
                        <td style="width:90%;">{!! html_entity_decode(preg_replace('<inf>', 'sub', $paper->paper_name)) !!}</td>
                        <td>
                            @foreach ($paper->author as $author)
                            <span>
                                <a>{{$author -> author_fname}} {{$author -> author_lname}}</a>
                            </span>
                            @endforeach
                            @foreach ($paper->teacher as $author)
                            <span>
                                <a href="{{ route('detail',Crypt::encrypt($author->id))}}">
                                    <teacher>@php
        $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
        $fname = $author->{'fname_' . $locale} ?? $author->fname_en;
        $lname = $author->{'lname_' . $locale} ?? $author->lname_en;
        if ($locale != 'th' && $locale != 'en') {
            $fname = $author->fname_en;
            $lname = $author->lname_en;
        }
    @endphp
    {{ $fname }} {{ $lname }}</teacher></a>
                            </span>
                            @endforeach
                        </td>
                        <td>@php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                @endphp

                                @if ($locale == 'th')
                                @switch($paper->paper_type)
                                @case('Journal')
                                วารสาร
                                @break
                                @case('Conference Proceeding')
                                เอกสารการประชุม
                                @break
                                @case('Book Series')
                                หนังสือชุด
                                @break
                                @case('Book')
                                หนังสือ
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @elseif ($locale == 'zh')
                                @switch($paper->paper_type)
                                @case('Journal')
                                期刊
                                @break
                                @case('Conference Proceeding')
                                会议论文
                                @break
                                @case('Book Series')
                                丛书
                                @break
                                @case('Book')
                                书籍
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @else
                                {{ $paper->paper_type }}
                                @endif</td>
                        <td style="width:100%;">{{$paper->paper_page}}</td>
                        <td>{{$paper->paper_sourcetitle}}</td>
                        <td>{{$paper->paper_citation}}</td>
                        <td>{{$paper->paper_doi}}</td>


                    </tr>
                    @endforeach
                </tbody>

            </table>


        </div>

        <div class="tab-pane fade" id="tci" role="tabpanel" aria-labelledby="tci-tab">
            <table id="example4" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                    <th>{{ trans('message.No.') }}</th>
                        <th>{{ trans('message.Year') }}</th>
                        <th style="width:90%">{{ trans('message.Paper Name') }}</th>
                        <th>{{ trans('message.Author') }}</th>
                        <th>{{ trans('message.Document Type') }}</th>
                        <th style="width:100%">{{ trans('message.Page') }}</th>
                        <th>{{ trans('message.Journals/Transactions') }}</th>
                        <th>{{ trans('message.Citations') }}</th>
                        <th>{{ trans('message.Doi') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($papers_tci as $n => $paper)
                    <tr>
                        <td> {{$n+1}}</td>
                        <td>{{ $paper->paper_yearpub }}</td>
                        <!-- <td style="width:90%;">{{$paper->paper_name}}</td> -->
                        <td style="width:90%;">{!! html_entity_decode(preg_replace('<inf>', 'sub', $paper->paper_name)) !!}</td>
                        <td>
                            @foreach ($paper->author as $author)
                            <span>
                                <a>{{$author -> author_fname}} {{$author -> author_lname}}</a>
                            </span>
                            @endforeach
                            @foreach ($paper->teacher as $author)
                            <span>
                                <a href="{{ route('detail',Crypt::encrypt($author->id))}}">
                                    <teacher>@php
        $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
        $fname = $author->{'fname_' . $locale} ?? $author->fname_en;
        $lname = $author->{'lname_' . $locale} ?? $author->lname_en;
        if ($locale != 'th' && $locale != 'en') {
            $fname = $author->fname_en;
            $lname = $author->lname_en;
        }
    @endphp
    {{ $fname }} {{ $lname }}</teacher></a>
                            </span>
                            @endforeach
                        </td>
                        <td>@php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                @endphp

                                @if ($locale == 'th')
                                @switch($paper->paper_type)
                                @case('Journal')
                                วารสาร
                                @break
                                @case('Conference Proceeding')
                                เอกสารการประชุม
                                @break
                                @case('Book Series')
                                หนังสือชุด
                                @break
                                @case('Book')
                                หนังสือ
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @elseif ($locale == 'zh')
                                @switch($paper->paper_type)
                                @case('Journal')
                                期刊
                                @break
                                @case('Conference Proceeding')
                                会议论文
                                @break
                                @case('Book Series')
                                丛书
                                @break
                                @case('Book')
                                书籍
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @else
                                {{ $paper->paper_type }}
                                @endif</td>
                        <td style="width:100%;">{{$paper->paper_page}}</td>
                        <td>{{$paper->paper_sourcetitle}}</td>
                        <td>{{$paper->paper_citation}}</td>
                        <td>{{$paper->paper_doi}}</td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="book" role="tabpanel" aria-labelledby="book-tab">
            <table id="example5" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">{{ trans('message.No.') }}</th>
                        <th scope="col">{{ trans('message.Year') }}</th>
                        <th scope="col">{{ trans('message.BookName') }}</th>
                        <th scope="col">{{ trans('message.Author') }}</th>
                        <th scope="col">{{ trans('message.Publication Place') }}</th>
                        <th scope="col">{{ trans('message.Page') }}</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($book_chapter as $n => $paper)
                    <tr>
                        <td>{{$n+1}}</td>
                        <td style="width:80px">{{ date('Y', strtotime($paper->ac_year))+543 }}</td>
                        <td>{{$paper->ac_name}}</td>
                        <td>
                            @foreach ($paper->author as $author)
                            <span>
                                <a>{{$author -> author_fname}} {{$author -> author_lname}}</a>

                            </span>
                            @endforeach
                            @foreach ($paper->user as $author)
                            <span>
                                <a> {{$author -> fname_en}} {{$author -> lname_en}}</a>
                            </span>
                            @endforeach
                        </td>
                        <td>{{$paper->ac_sourcetitle}}</td>
                        <td>{{ $paper->ac_page }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="patent" role="tabpanel" aria-labelledby="patent-tab">
            <table id="example6" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">{{ trans('message.No.') }}</th>
                        <th scope="col">{{ trans('message.Name') }}</th>
                        <th scope="col">{{ trans('message.Author') }}</th>
                        <th scope="col">{{ trans('message.Type') }}</th>
                        <th scope="col">{{ trans('message.Registration Number')}}</th>
                        <th scope="col">{{ trans('message.Registration Date')}}</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($patent as $n => $paper)
                    <tr>
                        <td>{{$n+1}}</td>
                        <td>{{$paper->ac_name}}</td>
                        <td>
                            @foreach ($paper->author as $author)
                            <span>
                                <a>{{$author -> author_fname}} {{$author -> author_lname}}</a>

                            </span>
                            @endforeach
                            @foreach ($paper->user as $author)
                            <span>
                                <a href="{{ route('detail',Crypt::encrypt($author->id))}}">
                                    <teacher>@php
        $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
        $fname = $author->{'fname_' . $locale} ?? $author->fname_en;
        $lname = $author->{'lname_' . $locale} ?? $author->lname_en;
        if ($locale != 'th' && $locale != 'en') {
            $fname = $author->fname_en;
            $lname = $author->lname_en;
        }
    @endphp
    {{ $fname }} {{ $lname }}</teacher></a>

                            </span>
                            @endforeach
                        </td>
                        <td>
                                @php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                @endphp

                                @if ($locale == 'th')
                                {{ $paper->ac_type }} {{-- แสดงค่าตาม Database ถ้าเป็นภาษาไทย --}}
                                @elseif ($locale == 'zh')
                                @switch($paper->ac_type)
                                @case('สิทธิบัตร')
                                专利
                                @break
                                @case('สิทธิบัตร (การประดิษฐ์)')
                                发明专利
                                @break
                                @case('สิทธิบัตร (การออกแบบผลิตภัณฑ์)')
                                设计专利
                                @break
                                @case('อนุสิทธิบัตร')
                                实用新型
                                @break
                                @case('ลิขสิทธิ์')
                                版权
                                @break
                                @case('ลิขสิทธิ์ (วรรณกรรม)')
                                文学版权
                                @break
                                @case('ลิขสิทธิ์ (ตนตรีกรรม)')
                                音乐版权
                                @break
                                @case('ลิขสิทธิ์ (ภาพยนตร์)')
                                电影版权
                                @break
                                @case('ลิขสิทธิ์ (ศิลปกรรม)')
                                艺术版权
                                @break
                                @case('ลิขสิทธิ์ (งานแพร่เสี่ยงแพร่ภาพ)')
                                广播版权
                                @break
                                @case('ลิขสิทธิ์ (โสตทัศนวัสดุ)')
                                视听资料版权
                                @break
                                @case('ลิขสิทธิ์ (งานอื่นใดในแผนกวรรณคดี/วิทยาศาสตร์/ศิลปะ)')
                                其他文学/科学/艺术版权
                                @break
                                @case('ลิขสิทธิ์ (สิ่งบันทึกเสียง)')
                                录音版权
                                @break
                                @case('ความลับทางการค้า')
                                商业机密
                                @break
                                @case('เครื่องหมายการค้า')
                                商标
                                @break
                                @default
                                {{ $paper->ac_type }}
                                @endswitch
                                @else {{-- ภาษาอังกฤษ --}}
                                @switch($paper->ac_type)
                                @case('สิทธิบัตร')
                                Patent
                                @break
                                @case('สิทธิบัตร (การประดิษฐ์)')
                                Invention Patent
                                @break
                                @case('สิทธิบัตร (การออกแบบผลิตภัณฑ์)')
                                Design Patent
                                @break
                                @case('อนุสิทธิบัตร')
                                Utility Model
                                @break
                                @case('ลิขสิทธิ์')
                                Copyright
                                @break
                                @case('ลิขสิทธิ์ (วรรณกรรม)')
                                Literary Copyright
                                @break
                                @case('ลิขสิทธิ์ (ตนตรีกรรม)')
                                Musical Copyright
                                @break
                                @case('ลิขสิทธิ์ (ภาพยนตร์)')
                                Film Copyright
                                @break
                                @case('ลิขสิทธิ์ (ศิลปกรรม)')
                                Artistic Copyright
                                @break
                                @case('ลิขสิทธิ์ (งานแพร่เสี่ยงแพร่ภาพ)')
                                Broadcast Copyright
                                @break
                                @case('ลิขสิทธิ์ (โสตทัศนวัสดุ)')
                                Audiovisual Copyright
                                @break
                                @case('ลิขสิทธิ์ (งานอื่นใดในแผนกวรรณคดี/วิทยาศาสตร์/ศิลปะ)')
                                Other Literary/Scientific/Artistic Copyright
                                @break
                                @case('ลิขสิทธิ์ (สิ่งบันทึกเสียง)')
                                Sound Recording Copyright
                                @break
                                @case('ความลับทางการค้า')
                                Trade Secret
                                @break
                                @case('เครื่องหมายการค้า')
                                Trademark
                                @break
                                @default
                                {{ $paper->ac_type }}
                                @endswitch
                                @endif
                            </td>
                        <td>{{$paper->ac_refnumber }}</td>
                        <td>{{$paper->ac_year}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="scholar" role="tabpanel" aria-labelledby="scholar-tab">
    <table id="example7" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>{{ trans('message.Year') }}</th>
                        <th style="width:90%">{{ trans('message.Paper Name') }}</th>
                        <th>{{ trans('message.Author') }}</th>
                        <th>{{ trans('message.Document Type') }}</th>
                        <th style="width:100%">{{ trans('message.Page') }}</th>
                        <th>{{ trans('message.Journals/Transactions') }}</th>
                        <th>{{ trans('message.Citations') }}</th>
                        <th>{{ trans('message.Doi') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($papers_scholar as $n => $paper)
            <tr>
                <td> {{$n+1}}</td>
                <td>{{ $paper->paper_yearpub }}</td>
                <td style="width:90%;">{!! html_entity_decode(preg_replace('<inf>', 'sub', $paper->paper_name)) !!}</td>
                <td>
                    @foreach ($paper->author as $author)
                    <span>
                        <a>{{$author->author_fname}} {{$author->author_lname}}</a>
                    </span>
                    @endforeach
                    @foreach ($paper->teacher as $author)
                    <span>
                        <a href="{{ route('detail',Crypt::encrypt($author->id))}}">
                                    <teacher>@php
        $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
        $fname = $author->{'fname_' . $locale} ?? $author->fname_en;
        $lname = $author->{'lname_' . $locale} ?? $author->lname_en;
        if ($locale != 'th' && $locale != 'en') {
            $fname = $author->fname_en;
            $lname = $author->lname_en;
        }
    @endphp
    {{ $fname }} {{ $lname }}</teacher></a>
                    </span>
                    @endforeach
                </td>
                <td>{{$paper->paper_type}}</td>
                <td>{{$paper->paper_page}}</td>
                <td>{{$paper->paper_sourcetitle}}</td>
                <td>{{$paper->paper_citation}}</td>
                <td>{{$paper->paper_doi}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



    </div>
    

    
</div>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    $(document).ready(function() {

        var MultiLang = {
            "sProcessing": "{{ trans('message.Processing...') }}",
            "sLengthMenu": "{{ trans('message.Showing') }} _MENU_ {{ trans('message.entries') }}",
            "sZeroRecords": "{{ trans('message.No data available in table') }}",
            "sInfo": "{{ trans('message.Showing') }} _START_ {{ trans('message.to') }} _END_ {{ trans('message.of') }} _TOTAL_ {{ trans('message.entries') }}",
            "sInfoEmpty": "{{ trans('message.Showing') }} 0 {{ trans('message.to') }} 0 {{ trans('message.of') }} 0 {{ trans('message.entries') }}",
            "sInfoFiltered": "({{ trans('message.filtered from') }} _MAX_ {{ trans('message.entries') }})",
            "sSearch": "{{ trans('message.Search') }}:",
            "oPaginate": {
                "sFirst": "{{ trans('message.First Page') }}",
                "sPrevious": "{{ trans('message.Previous Page') }}",
                "sNext": "{{ trans('message.Next Page') }}",
                "sLast": "{{ trans('message.Last Page') }}"
            }
        };

        var table1 = $('#example1').DataTable({ responsive: true, language: MultiLang });
        var table2 = $('#example2').DataTable({ responsive: true, language: MultiLang });
        var table3 = $('#example3').DataTable({ responsive: true, language: MultiLang });
        var table4 = $('#example4').DataTable({ responsive: true, language: MultiLang });
        var table5 = $('#example5').DataTable({ responsive: true, language: MultiLang });
        var table6 = $('#example6').DataTable({ responsive: true, language: MultiLang });
        var table7 = $('#example7').DataTable({ responsive: true, language: MultiLang });


        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(event) {
            var tabID = $(event.target).attr('data-bs-target');
            if (tabID === '#scopus') {
                table2.columns.adjust().draw()
            }
            if (tabID === '#wos') {
                table3.columns.adjust().draw()
            }
            if (tabID === '#tci') {
                table4.columns.adjust().draw()
            }
            if (tabID === '#book') {
                table5.columns.adjust().draw()
            }
            if (tabID === '#patent') {
                table6.columns.adjust().draw()
            }
            if (tabID === '#scholar') {
                table7.columns.adjust().draw()
            }


        });

    });
</script>

<script>
    var year = <?php echo $year; ?>;
    var paper_tci = <?php echo $paper_tci; ?>;
    var paper_scopus = <?php echo $paper_scopus; ?>;
    var paper_wos = <?php echo $paper_wos; ?>;
    var areaChartData = {

        labels: year,

        datasets: [{
                label: 'SCOPUS',
                backgroundColor: '#83E4B5',
                borderColor: 'rgba(255, 255, 255, 0.5)',
                pointRadius: false,
                pointColor: '#83E4B5',
                pointStrokeColor: '#3b8bba',
                pointHighlightFill: '#fff',
                pointHighlightStroke: '#83E4B5',
                data: paper_scopus
            },
            {
                label: 'TCI',
                backgroundColor: '#3994D6',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: '#3994D6',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: '#3994D6',
                data: paper_tci
            },
            {
                label: 'WOS',
                backgroundColor: '#FCC29A',
                borderColor: 'rgba(0, 0, 255, 1)',
                pointRadius: false,
                pointColor: '#FCC29A',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: '#FCC29A',
                data: paper_wos
            },
        ]
    }



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
        scales: {
            yAxes: [{
                ticks: {
                    stepSize: 1
                }
            }]
        }

    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
</script>

<script type="text/javascript">
    function myDisplayer(some) {

        document.getElementById("citation").innerHTML = "Citation count : " + some['h-index'];
        document.getElementById("doc_count").innerHTML = "Document count : " + some['coredata']['citation-count'];
        document.getElementById("cite_count").innerHTML = "Cited By count : " + some['coredata']['cited-by-count'];
        document.getElementById("h-index").innerHTML = "H-index : " + some['h-index'];

    }
    async function myFunction() {
        var res = <?php echo $res; ?>;
        //var fname = res.fname_en;
        //var fname = res.fname_en.substr(0, 1); 
        //console.log(fname);
        //const response = await fetch('https://api.elsevier.com/content/search/scopus?query=AUTHOR-NAME('+ res.lname_en +','+fname+')%20&apikey=6ab3c2a01c29f0e36b00c8fa1d013f83&httpAccept=application%2Fjson');
        const response = await fetch('https://api.elsevier.com/content/search/author?query=authlast(' + res.lname_en +
            ')%20and%20authfirst(' + res.fname_en +
            ')%20&apiKey=6ab3c2a01c29f0e36b00c8fa1d013f83&httpAccept=application%2Fjson');
        //var a = got["search-results"];
        const got = await response.json();
        aid = got["search-results"]["entry"][0]['dc:identifier'];
        aid = aid.split(":");
        aid = aid[1];
        const resultC = await fetch('https://api.elsevier.com/content/author?author_id=' + aid +
            '&view=metrics&apiKey=6ab3c2a01c29f0e36b00c8fa1d013f83&httpAccept=application%2Fjson');
        const data = await resultC.json();
        auth = data['author-retrieval-response'][0];
        //data = data['h-index'];

        return auth

    }
    myFunction().then(
        function(value) {
            myDisplayer(value);
        },
        function(error) {
            myDisplayer(error);
        }
    );
</script>
</div>
<script>
    var paper_tci_s = <?php echo $paper_tci_s; ?>;
    var paper_scopus_s = <?php echo $paper_scopus_s; ?>;
    var paper_wos_s = <?php echo $paper_wos_s; ?>;
    var paper_book_s = <?php echo $paper_book_s; ?>;
    var paper_patent_s = <?php echo $paper_patent_s; ?>;
    var paper_scholar_s = <?php echo $paper_scholar_s; ?>;

    //console.log(paper_book_s);
    let sumtci = 0;
    let sumsco = 0;
    let sumwos = 0;
    let sumbook = 0;
    let sumpatent = 0;
    let sumscholar = 0;
    (function($) {
        for (let i = 0; i < paper_scopus_s.length; i++) {
            sumsco += paper_scopus_s[i];
        }
        for (let i = 0; i < paper_tci_s.length; i++) {
            sumtci += paper_tci_s[i];
        }
        for (let i = 0; i < paper_wos_s.length; i++) {
            sumwos += paper_wos_s[i];
        }
        for (let i = 0; i < paper_book_s.length; i++) {
            sumbook += paper_book_s[i];
        }
        for (let i = 0; i < paper_patent_s.length; i++) {
            sumpatent += paper_patent_s[i];
        }
        for (let i = 0; i < paper_scholar_s.length; i++) {
            sumscholar += paper_scholar_s[i];
        }
        let sum = sumsco + sumtci + sumwos + sumbook + sumpatent + sumscholar;

        //$("#scopus").append('data-to="100"');
        document.getElementById("all").innerHTML += `   
                <h2 class="timer count-title count-number" data-to="${sum}" data-speed="1500"></h2>
                <p class="count-text ">{{ trans('message.Summary') }}</p>`

        document.getElementById("scopus_sum").innerHTML += `   
                <h2 class="timer count-title count-number" data-to="${sumsco}" data-speed="1500"></h2>
                <p class="count-text">SCOPUS</p>`

        document.getElementById("wos_sum").innerHTML += `    
                <h2 class="timer count-title count-number" data-to="${sumwos}" data-speed="1500"></h2>
                <p class="count-text ">WOS</p>`

        document.getElementById("tci_sum").innerHTML += `  
                <h2 class="timer count-title count-number" data-to="${sumtci}" data-speed="1500"></h2>
                <p class="count-text ">TCI</p>`
        
        document.getElementById("scholar_sum").innerHTML += `  
                <h2 class="timer count-title count-number" data-to="${sumscholar}" data-speed="1500"></h2>
                <p class="count-text ">Google Scholar</p>`


        //document.getElementById("scopus").appendChild('data-to="100"');
        $.fn.countTo = function(options) {
            options = options || {};

            return $(this).each(function() {
                // set options for current element
                var settings = $.extend({}, $.fn.countTo.defaults, {
                    from: $(this).data('from'),
                    to: $(this).data('to'),
                    speed: $(this).data('speed'),
                    refreshInterval: $(this).data('refresh-interval'),
                    decimals: $(this).data('decimals')
                }, options);

                // how many times to update the value, and how much to increment the value on each update
                var loops = Math.ceil(settings.speed / settings.refreshInterval),
                    increment = (settings.to - settings.from) / loops;

                // references & variables that will change with each update
                var self = this,
                    $self = $(this),
                    loopCount = 0,
                    value = settings.from,
                    data = $self.data('countTo') || {};

                $self.data('countTo', data);

                // if an existing interval can be found, clear it first
                if (data.interval) {
                    clearInterval(data.interval);
                }
                data.interval = setInterval(updateTimer, settings.refreshInterval);

                // initialize the element with the starting value
                render(value);

                function updateTimer() {
                    value += increment;
                    loopCount++;

                    render(value);

                    if (typeof(settings.onUpdate) == 'function') {
                        settings.onUpdate.call(self, value);
                    }

                    if (loopCount >= loops) {
                        // remove the interval
                        $self.removeData('countTo');
                        clearInterval(data.interval);
                        value = settings.to;

                        if (typeof(settings.onComplete) == 'function') {
                            settings.onComplete.call(self, value);
                        }
                    }
                }

                function render(value) {
                    var formattedValue = settings.formatter.call(self, value, settings);
                    $self.html(formattedValue);
                }
            });
        };

        $.fn.countTo.defaults = {
            from: 0, // the number the element should start at
            to: 0, // the number the element should end at
            speed: 1000, // how long it should take to count between the target numbers
            refreshInterval: 100, // how often the element should be updated
            decimals: 0, // the number of decimal places to show
            formatter: formatter, // handler for formatting the value before rendering
            onUpdate: null, // callback method for every time the element is updated
            onComplete: null // callback method for when the element finishes updating
        };

        function formatter(value, settings) {
            return value.toFixed(settings.decimals);
        }
    }(jQuery));

    jQuery(function($) {
        // custom formatting example
        $('.count-number').data('countToOptions', {
            formatter: function(value, options) {
                return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
            }
        });

        // start all the timers
        $('.timer').each(count);

        function count(options) {
            var $this = $(this);
            options = $.extend({}, options || {}, $this.data('countToOptions') || {});
            $this.countTo(options);
        }
    });
</script>

@endsection