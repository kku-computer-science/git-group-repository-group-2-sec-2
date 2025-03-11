@extends('layouts.layout')

@section('content')
<div class="container card-3 ">
    <p>{{ trans('message.research_group') }}</p>
    @foreach ($resg as $index => $rg)
    @php
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
    @endphp
    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body">
                    <img src="{{ asset('img/'.$rg->group_image) }}" alt="...">
                    <h2 class="card-text-1">{{ trans('message.laboratory_supervisor') }}</h2>

                    <h2 class="card-text-2">
                        @foreach ($rg->user as $r)
                        @if ($r->hasRole('teacher'))
                            @php
                                $fname = ($locale === 'zh') ? ($r->fname_en ?? 'N/A') : ($r->{'fname_' . $locale} ?? 'N/A');
                                $lname = ($locale === 'zh') ? ($r->lname_en ?? 'N/A') : ($r->{'lname_' . $locale} ?? 'N/A');
                                $position = ($locale === 'zh') ? ($positionMap[$r->position_en] ?? $r->position_en) : ($r->{'position_' . $locale} ?? $r->position_en ?? 'N/A');
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
                    <h3 class="card-text" id="group_desc_{{ $index }}">
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

<!-- Script แปลเฉพาะคำอธิบาย (group_desc) -->
@php
$locale = app()->getLocale();
@endphp

<script>
document.addEventListener("DOMContentLoaded", function() {
    @if ($locale == 'zh')
        @foreach ($resg as $index => $rg)
            translateGroupDesc('group_desc_{{ $index }}', 'zh-CN');
        @endforeach
    @endif
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
@stop
