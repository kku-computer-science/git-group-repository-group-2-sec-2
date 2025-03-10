@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.fund_detail') }}</h4>
            <p class="card-description">{{ trans('message.fund_detail_info') }}</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.fund_name') }}</b></p>
                <p class="card-text col-sm-9">{{ $fund->fund_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.year') }}</b></p>
                <p class="card-text col-sm-9">{{ $fund->fund_year }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.fund_description') }}</b></p>
                <p class="card-text col-sm-9">{{ $fund->fund_details }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.fund_type') }}</b></p>
                @php
    $locale = app()->getLocale();
    $fundTypeMap = [
        'ทุนภายใน' => [
            'th' => 'ทุนภายใน',
            'en' => 'Internal Funding',
            'zh' => '内部资助',
        ],
        'ทุนภายนอก' => [
            'th' => 'ทุนภายนอก',
            'en' => 'External Funding',
            'zh' => '外部资助',
        ],
    ];
@endphp

<p class="card-text col-sm-9">
    {{ $fundTypeMap[$fund->fund_type][$locale] ?? $fund->fund_type }}
</p>
            
</div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.fund_level') }}</b></p>
                @php
    $locale = app()->getLocale();
    $fundLevelMap = [];
    if ($locale == 'en') {
        $fundLevelMap = [
            'สูง' => 'High',
        ];
    } elseif ($locale == 'zh') {
        $fundLevelMap = [
            'สูง' => '高',
        ];
    }
@endphp

<p class="card-text col-sm-9">
    {{ isset($fundLevelMap[$fund->fund_level]) ? $fundLevelMap[$fund->fund_level] : $fund->fund_level }}
</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.agency') }}</b></p>
                @php
    $locale = app()->getLocale();
    $supportResourceMap = [
        "มหาวิทยาลัยขอนแก่น" => [
            'th' => "มหาวิทยาลัยขอนแก่น",
            'en' => "Khon Kaen University",
            'zh' => "孔敬大学",
        ],
        "สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ" => [
            'th' => "สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ",
            'en' => "National Science, Technology and Innovation Policy Council Office",
            'zh' => "National Science, Technology and Innovation Policy Council Office",
        ],
        "สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม" => [
            'th' => "สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม",
            'en' => "Office of the Permanent Secretary, Ministry of Higher Education, Science, Research and Innovation",
            'zh' => "Office of the Permanent Secretary, Ministry of Higher Education, Science, Research and Innovation",
        ],
        "สำนักงานคณะกรรมการวิจัยแห่งชาติ" => [
            'th' => "สำนักงานคณะกรรมการวิจัยแห่งชาติ",
            'en' => "National Research Council of Thailand",
            'zh' => "泰国国家研究委员会",
        ],
        "OU, BOKU, JU, ITC, AIT, YNNU, FNU" => [
            'th' => "OU, BOKU, JU, ITC, AIT, YNNU, FNU",
            'en' => "OU, BOKU, JU, ITC, AIT, YNNU, FNU",
            // สำหรับภาษาจีน ให้ใช้ข้อความภาษาอังกฤษเหมือนเดิม
            'zh' => "OU, BOKU, JU, ITC, AIT, YNNU, FNU",
        ],
        "กระทรวงวิทยาศาสตร์และเทคโนโลยี" => [
            'th' => "กระทรวงวิทยาศาสตร์และเทคโนโลยี",
            'en' => "Ministry of Science and Technology",
            'zh' => "Ministry of Science and Technology",
        ],
        "ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ" => [
            'th' => "ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ",
            'en' => "Geoinformatics Center for the Development of the Northeast",
            'zh' => "Geoinformatics Center for the Development of the Northeast",
        ],
        "คณะวิทยาศาสตร์ มข." => [
            'th' => "คณะวิทยาศาสตร์ มข.",
            'en' => "Faculty of Science, Khon Kaen University",
            'zh' => "理学院 孔敬大学",
        ],
        "วิทยาลัยการคอมพิวเตอร์" => [
            'th' => "วิทยาลัยการคอมพิวเตอร์",
            'en' => "College of Computing",
            'zh' => "College of Computing",
        ],
    ];
@endphp

<p class="card-text col-sm-9">
    {{ $supportResourceMap[$fund->support_resource][$locale] ?? $fund->support_resource }}
</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.added_by') }}</b></p>
                <!-- <p class="card-text col-sm-9">{{ $fund->user->fname_th }} {{ $fund->user->lname_th}}</p> -->
                <!-- ========================================================================================================= -->
                <p class="card-text col-sm-9">
                    {{ app()->getLocale() == 'zh' ? $fund->user->fname_en : $fund->user->{'fname_'.app()->getLocale()} }} 
                    {{ app()->getLocale() == 'zh' ? $fund->user->lname_en : $fund->user->{'lname_'.app()->getLocale()} }}
                </p>
                <!-- ========================================================================================================= -->


            </div>
            <div class="pull-right mt-5">
                <a class="btn btn-primary btn-sm" href="{{ route('funds.index') }}"> {{ trans('message.back') }}</a>
            </div>
        </div>

    </div>


</div>
@endsection