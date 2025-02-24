@extends('layouts.layout')

@section('content')
<div class="container card-3 ">
    <p>{{ trans('message.Research_Group') }}</p>
    @foreach ($resg as $index => $rg)
    @php
        $locale = app()->getLocale();

        // คำอธิบายภาษาจีนเฉพาะของแต่ละกลุ่ม
        $descriptions_zh = [
            '在互联网、地理信息系统 (GIS)、健康 GIS 以及 GIS 水文建模领域开展研究并提供学术服务。',
            '本实验室致力于研究高性能计算的智能技术，该技术模仿自然启发的行为。',
            '本研究实验室汇集了多个跨学科研究领域，如数据科学与数据分析、数据挖掘、文本挖掘、观点挖掘、商业智能、ERP 系统、IT 管理、语义网、情感分析、图像处理、泛在学习、混合学习以及生物信息学。',
            '该项目的主要目的是开展研究并构建有关机器学习和智能系统及其应用的新知识。',
            '该项目的主要目标是研究计算机系统中的自然语言和语音处理、机器翻译系统、语音合成与语音识别计算机系统、字符识别与信息检索，以及构建和开发用于整合自然语言和语音的工作系统。',
        ];

        // ตรวจสอบภาษา ถ้าเป็น zh ให้ดึงจาก `$descriptions_zh` ตามลำดับของกลุ่ม
        if ($locale === 'zh') {
            $group_name = $rg->group_name_en ?? 'N/A';
            $group_desc = $descriptions_zh[$loop->index] ?? 'N/A';
        } else {
            // ใช้ค่าเดิมจากฐานข้อมูล
            $group_name = $rg->{'group_name_' . $locale} ?? 'N/A';
            $group_desc = $rg->{'group_desc_' . $locale} ?? 'N/A';
        }
    @endphp
    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body">
                    <img src="{{ asset('img/'.$rg->group_image) }}" alt="...">
                    <h2 class="card-text-1">{{ trans('message.Laboratory_Supervisor') }}</h2>
                    
                    <h2 class="card-text-2">
                        @foreach ($rg->user as $r)
                        @if ($r->hasRole('teacher'))
                            @php
                                $fname = ($locale === 'zh') ? ($r->fname_en ?? 'N/A') : ($r->{'fname_' . $locale} ?? 'N/A');
                                $lname = ($locale === 'zh') ? ($r->lname_en ?? 'N/A') : ($r->{'lname_' . $locale} ?? 'N/A');
                                $position = ($locale === 'zh') ? '教授' : ($r->{'position_' . $locale} ?? $r->position_en ?? 'N/A');
                            @endphp
                            {{ $position }} {{ $fname }} {{ $lname }}
                            <br>
                        @endif
                        @endforeach
                    </h2>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $group_name }}</h5>
                    <h3 class="card-text">
                        {{ $group_desc }}
                    </h3>
                </div>
                <div>
                    <a href="{{ route('researchgroupdetail', ['id' => $rg->id]) }}" class="btn btn-outline-info">
                        {{ trans('message.details') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop
