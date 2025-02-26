@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.other_academic_works') }}</h4>
            <p class="card-description">{{ trans('message.other_academic_works_info') }}</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.name') }}</b></p>
                <p class="card-text col-sm-9">{{ $patent->ac_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.type') }}</b></p>
                <p class="card-text col-sm-9">
    @php
        $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
    @endphp

    @if ($locale == 'th')
        {{ $patent->ac_type }} {{-- แสดงค่าตาม Database ถ้าเป็นภาษาไทย --}}
    @elseif ($locale == 'zh')
        @switch($patent->ac_type)
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
                {{ $patent->ac_type }}
        @endswitch
    @else {{-- ภาษาอังกฤษ --}}
        @switch($patent->ac_type)
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
                {{ $patent->ac_type }}
        @endswitch
    @endif
</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.registration_date') }}</b></p>
                <p class="card-text col-sm-9">{{ $patent->ac_year }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.registration_number') }}</b></p>
                <p class="card-text col-sm-9">{{ trans('message.number') }} : {{ $patent->ac_refnumber }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.prepared_by') }}</b></p>
                <!-- ================================================================================================= -->
                <p class="card-text col-sm-9">
                        @foreach($patent->user as $a)
                        {{ app()->getLocale() == 'zh' ? $a->fname_en : $a->{'fname_'.app()->getLocale()} }} 
                        {{ app()->getLocale() == 'zh' ? $a->lname_en : $a->{'lname_'.app()->getLocale()} }}
                        @if (!$loop->last),@endif
                        @endforeach
                </p>
                <!-- ================================================================================================= -->

                </p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.prepared_by_co') }}</b></p>
                <p class="card-text col-sm-9">
                @foreach($patent->author as $a)
                    {{ $a->author_fname }} {{ $a->author_lname }}
                @if (!$loop->last),@endif
                @endforeach</p>
            </div>

            
            <div class="pull-right mt-5">
                <a class="btn btn-primary btn-sm" href="{{ route('patents.index') }}"> {{ trans('message.back') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection