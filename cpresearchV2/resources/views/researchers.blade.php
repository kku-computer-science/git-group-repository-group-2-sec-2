@extends('layouts.layout')
@section('content')
<div class="container card-2">
    <p class="title"> {{trans('message.researchers')}} </p>
    @foreach($request as $res)
    <span>
        <ion-icon name="caret-forward-outline" size="small"></ion-icon>
        @switch($res->name)
        @case('teacher')
        {{ trans('message.researcher_role_teacher') }}
        @break
        @case('Undergrad Student')
        {{ trans('message.researcher_role_undergrad_student') }}
        @break
        @case('Master Student')
        {{ trans('message.researcher_role_master_student') }}
        @break
        @case('Doctoral Student')
        {{ trans('message.researcher_role_doctoral_student') }}
        @break
        @default
        {{ $res->name }}
        @endswitch

    </span>
    <div class="d-flex">
        <div class="ml-auto">
            <form class="row row-cols-lg-auto g-3" method="GET" action="{{ route('searchresearchers',['id'=>$res->id])}}">
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control" name="textsearch" placeholder="{{ trans('message.placeholder_research') }}">
                    </div>
                </div>
                <!-- <div class="col-12">
                        <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                        <select class="form-select" id="inlineFormSelectPref">
                            <option selected> Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div> -->
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-primary"> {{ trans('message.search') }}</button>
                </div>
            </form>
        </div>
    </div>


    <div class="row row-cols-1 row-cols-md-2 g-0">
        @foreach($users as $r)
        <a href=" {{ route('detail',Crypt::encrypt($r->id))}}">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-sm-4">
                        <img class="card-image" src="{{ $r->picture}}" alt="">
                    </div>
                    <div class="col-sm-8 overflow-hidden" style="text-overflow: clip; @if(app()->getLocale() == 'en') max-height: 220px; @else max-height: 210px;@endif">
                        <div class="card-body">
                        @php
    $locale = app()->getLocale();

    // ถ้าเลือกภาษาไทยให้แสดงชื่อภาษาไทยก่อน
    if ($locale == 'th') {
        $fname = $r->fname_th;
        $lname = $r->lname_th;
        $position = $r->position_th;
    } else {
        // ถ้าไม่ใช่ภาษาไทย ใช้ภาษาอังกฤษก่อน ถ้าไม่มี fallback เป็นภาษาไทย
        $fname = !empty($r->fname_en) ? $r->fname_en : $r->fname_th;
        $lname = !empty($r->lname_en) ? $r->lname_en : $r->lname_th;
        $position = !empty($r->position_en) ? $r->position_en : $r->position_th;
    }

    // ตรวจสอบว่ามี academic rank หรือไม่ ถ้าไม่มีให้เป็นค่าว่าง
    $academic_rank = '';
    if (!empty($r->academic_ranks_en)) {
        $academic_rank_key = strtolower(str_replace(' ', '_', $r->academic_ranks_en));
        $academic_rank = trans('message.' . $academic_rank_key);
    }

    // แปลง Ph.D. เป็น 博士 ถ้าเป็นภาษาจีน
    $doctoral_degree = $r->doctoral_degree == 'Ph.D.' ? ($locale == 'zh' ? '博士' : 'Ph.D.') : '';
@endphp


@if($locale == 'en' || $locale == 'zh')
    <h5 class="card-title">
        {{ $fname }} {{ $lname }}{{ $doctoral_degree ? ', ' . $doctoral_degree : '' }}
    </h5>
    @if(!empty($academic_rank))
        <h5 class="card-title-2">{{ $academic_rank }}</h5>
    @endif
@else
    <h5 class="card-title">
        {{ $position }} {{ $fname }} {{ $lname }}
    </h5>
@endif

<p class="card-text-1">{{ trans('message.expertise') }}</p>
<div class="card-expertise">
    @foreach($r->expertise->sortBy('expert_name') as $exper)
        @php
            // ใช้ trans() ดึงค่าจากไฟล์ message.php ถ้ามีแปลเป็นภาษาจีนก็ใช้ ถ้าไม่มีใช้ค่าเดิม
            $expert_name = ($locale == 'zh' && trans('message.expertise_translation.' . $exper->expert_name) != 'message.expertise_translation.' . $exper->expert_name)
                ? trans('message.expertise_translation.' . $exper->expert_name)
                : $exper->expert_name;
        @endphp
        <p class="card-text">{{ $expert_name }}</p>
    @endforeach
</div>

                            <!-- <div class="card-expertise">
                                @foreach($r->expertise->sortBy('expert_name') as $exper)
                                <p class="card-text">{{ $exper->expert_name }}</p>
                                @endforeach
                            </div> -->
                        </div>
                    </diV>
                </div>
            </div>
        </a>
        @endforeach
        @endforeach
    </div>
</div>

@stop
