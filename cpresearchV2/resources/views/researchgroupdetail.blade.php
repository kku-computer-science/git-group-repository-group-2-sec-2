@extends('layouts.layout')
<style>
    .name {

        font-size: 20px;

    }
</style>
@section('content')
<div class="container card-4 mt-5">
    <div class="card">
        @foreach ($resgd as $rg)
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body">
                    <img src="{{asset('img/'.$rg->group_image)}}" alt="...">
                    <h1 class="card-text-1"> {{ trans('message.laboratory_supervisor') }} </h1>
                    <h2 class="card-text-2">
                    @foreach ($rg->user as $r)
    @if($r->hasRole('teacher'))
        @if(app()->getLocale() == 'zh')
            @php
                $positionMap = [
                    'Assoc. Prof. Dr.' => '副教授 博士',
                    'Prof. Dr.'        => '教授 博士',
                    'Asst. Prof. Dr.'  => '助理教授 博士',
                    'Asst. Prof.'      => '助理教授',
                    'Lecturer'         => '讲师',
                ];
            @endphp
            {{ isset($positionMap[$r->position_en]) ? $positionMap[$r->position_en] : $r->position_en }}
            {{ $r->fname_en }} {{ $r->lname_en }}
            <br>
        @elseif(app()->getLocale() == 'en' and $r->academic_ranks_en == 'Lecturer' and $r->doctoral_degree == 'Ph.D.')
            {{ $r->{'fname_'.app()->getLocale()} }} {{ $r->{'lname_'.app()->getLocale()} }}, Ph.D.
            <br>
        @elseif(app()->getLocale() == 'en' and $r->academic_ranks_en == 'Lecturer')
            {{ $r->{'fname_'.app()->getLocale()} }} {{ $r->{'lname_'.app()->getLocale()} }}
            <br>
        @elseif(app()->getLocale() == 'en' and $r->doctoral_degree == 'Ph.D.')
            {{ str_replace('Dr.', ' ', $r->{'position_'.app()->getLocale()}) }} {{ $r->{'fname_'.app()->getLocale()} }} {{ $r->{'lname_'.app()->getLocale()} }}, Ph.D.
            <br>
        @else                            
            {{ $r->{'position_'.app()->getLocale()} }} {{ $r->{'fname_'.app()->getLocale()} }} {{ $r->{'lname_'.app()->getLocale()} }}
            <br>
        @endif
    @endif
@endforeach

                    </h2>
                    <h1 class="card-text-1"> {{ trans('message.student') }}</h1>
                    <h2 class="card-text-2">
                        @foreach ($rg->user as $user)
                        @if($user->hasRole('student'))
                        {{$user->{'position_'.app()->getLocale()} }} {{$user->{'fname_'.app()->getLocale()} }} {{$user->{'lname_'.app()->getLocale()} }}
                        <br>
                        @endif
                        @endforeach
                    </h2>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">
    {{ app()->getLocale() == 'zh' ? $rg->group_name_en : $rg->{'group_name_'.app()->getLocale()} }}
</h5>

@php
    $locale = app()->getLocale();
    // Mapping สำหรับรายละเอียดกลุ่มในภาษาจีน โดย key เป็นข้อความภาษาไทย
    $group_detail_map = [
        "เพื่อดำเนินการวิจัยและให้บริการวิชาการในสาขาอินเทอร์เน็ต GIS สุขภาพ GIS และแบบจำลองทางอุทกวิทยาด้วย GIS" 
            => '在互联网、地理信息系统 (GIS)、健康 GIS 以及 GIS 水文建模领域开展研究并提供学术服务。',
        "ห้องปฏิบัติการนี้มีจุดมุ่งหมายเพื่อศึกษาและวิจัยเกี่ยวกับเทคโนโลยีอัจฉริยะสำหรับการประมวลผลประสิทธิภาพสูงซึ่งเลียนแบบพฤติกรรมที่ได้รับแรงบันดาลใจจากธรรมชาติ" 
            => '本实验室致力于研究高性能计算的智能技术，该技术模仿自然启发的行为',
        "ห้องปฏิบัติการวิจัยนี้รวบรวมสาขาการวิจัยแบบสหวิทยาการ เช่น Data Science & Data Analytics, Data Mining, Text Mining, Opinion Mining, Business Intelligence, ERP System, IT Management, Semantic Web, Sentiment Analysis, Image Processing, Ubiquitous Learning, Blended Learning และ Bioinformatics." 
            => "本研究实验室汇集了多个跨学科研究领域，如数据科学与数据分析、数据挖掘、文本挖掘、观点挖掘、商业智能、ERP 系统、IT 管理、语义网、情感分析、图像处理、泛在学习、混合学习以及生物信息学",
        "วัตถุประสงค์หลักของโครงการนี้คือการทำวิจัยและสร้างความรู้ใหม่เกี่ยวกับการเรียนรู้ของเครื่องและระบบอัจฉริยะตลอดจนการใช้งาน" 
            => "该项目的主要目的是开展研究并构建有关机器学习和智能系统及其应用的新知识",
        "จุดมุ่งหมายหลักของโครงการนี้คือ การวิจัยเกี่ยวกับภาษาธรรมชาติและการประมวลผลเสียงพูดในระบบคอมพิวเตอร์ ระบบแทนสเลชันด้วยเครื่อง ระบบคอมพิวเตอร์สังเคราะห์เสียงพูดและการรู้จำเสียง การรู้จำอักขระและการค้นหาข้อมูล การสร้างและพัฒนาระบบการทำงานเพื่อบูรณาการทางธรรมชาติ การประมวลผลภาษาและคำพูดด้วยระบบงานทางธุรกิจและเพื่อสร้างผลงานทางวิชาการเกี่ยวกับการประมวลผลตามธรรมชาติ" 
            => "该项目的主要目标是研究计算机系统中的自然语言和语音处理、机器翻译系统、语音合成与语音识别计算机系统、字符识别与信息检索，以及构建和开发用于整合自然语言和语音的工作系统",
    ];

    if ($locale == 'zh') {
        // สมมุติว่าในฐานข้อมูลเก็บรายละเอียดกลุ่มในภาษาไทยไว้ใน field group_detail_th
        $group_detail_text = $rg->{'group_detail_th'} ?? '';
        $group_detail = isset($group_detail_map[$group_detail_text]) ? $group_detail_map[$group_detail_text] : $group_detail_text;
    } else {
        $group_detail = $rg->{'group_detail_'.$locale} ?? '';
    }
@endphp

<h3 class="card-text">
    {!! $group_detail !!}
</h3>

                </div>
                
            </div>
            @endforeach
            <!-- <div id="loadMore">
                <a href="#"> Load More </a>
            </div> -->
        </div>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    $(document).ready(function() {
        $(".moreBox").slice(0, 1).show();
        if ($(".blogBox:hidden").length != 0) {
            $("#loadMore").show();
        }
        $("#loadMore").on('click', function(e) {
            e.preventDefault();
            $(".moreBox:hidden").slice(0, 1).slideDown();
            if ($(".moreBox:hidden").length == 0) {
                $("#loadMore").fadeOut('slow');
            }
        });
    });
</script>

@stop
<!-- <div class="card-body-research">
                    <p>Research</p>
                    <table class="table">
                        @foreach($rg->user as $user)
                        
                        <thead>
                            <tr>
                                <th><b class="name">{{$user->{'position_'.app()->getLocale()} }} {{$user->{'fname_'.app()->getLocale()} }} {{$user->{'lname_'.app()->getLocale()} }}</b></th>
                            </tr>
                            @foreach($user->paper->sortByDesc('paper_yearpub') as $p)
                            <tr class="hidden">
                                <th>
                                    <b><math>{!! html_entity_decode(preg_replace('<inf>', 'sub', $p->paper_name)) !!}</math></b> (
                                    <link>@foreach($p->teacher as $teacher){{$teacher->fname_en}} {{$teacher->lname_en}},
                                    @endforeach
                                    @foreach($p->author as $author){{$author->author_fname}} {{$author->author_lname}}@if (!$loop->last),@endif
                                    @endforeach</link>), {{$p->paper_sourcetitle}}, {{$p->paper_volume}},
                                    {{ $p->paper_yearpub }}.
                                    <a href="{{$p->paper_url}} " target="_blank">[url]</a> <a href="https://doi.org/{{$p->paper_doi}}" target="_blank">[doi]</a>
                                </th>
                            </tr>
                            @endforeach
                        </thead>
                        @endforeach
                    </table>
                </div> -->