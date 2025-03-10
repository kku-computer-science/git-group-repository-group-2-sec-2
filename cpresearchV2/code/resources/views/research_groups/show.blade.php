@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-10" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.research_group_detail') }}</h4>
            <p class="card-description">{{ trans('message.research_group_detail_info') }}</p>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.research_group_name_th') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchGroup->group_name_th }}</p>
            </div>
            <div class="row mt-1">
                <p class="card-text col-sm-3"><b>{{ trans('message.research_group_name_en') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchGroup->group_name_en }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.research_group_description_th') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchGroup->group_desc_th }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.research_group_description_en') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchGroup->group_desc_en }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.research_group_details_th') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchGroup->group_detail_th }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.research_group_details_en') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchGroup->group_detail_en }}</p>
            </div>
            <div class="row mt-3">
                <p class="card-text col-sm-3"><b>{{ trans('message.research_group_leader') }}</b></p>
                <p class="card-text col-sm-9">
                    @foreach($researchGroup->user as $user)
                    @if ( $user->pivot->role == 1)
                    <!-- {{ app()->getLocale() == 'zh' ? $user->program->department->department_name_en : $user->program->department->{'department_name_'.app()->getLocale()} }} -->
                    <!-- {{$user->position_th}}{{ $user->fname_th}} {{ $user->lname_th}}   -->
                    @php
    $locale = app()->getLocale();
    $positionMap = [];
    if ($locale === 'zh') {
        $positionMap = [
            'Assoc. Prof. Dr.' => '副教授 博士',
            'Prof. Dr.'        => '教授 博士',
            'Asst. Prof. Dr.'  => '助理教授 博士',
            'Asst. Prof.'      => '助理教授',
            'Lecturer'         => '讲师',
        ];
    }
@endphp

{{ $locale == 'zh' ? ($positionMap[$user->position_en] ?? $user->position_en) : $user->{'position_'.app()->getLocale()} }}
                        {{ app()->getLocale() == 'zh' ? $user->fname_en : $user->{'fname_'.app()->getLocale()} }}
                        {{ app()->getLocale() == 'zh' ? $user->lname_en : $user->{'lname_'.app()->getLocale()} }}

                    @endif
                    @endforeach</p>
            </div>
            @php
    $locale = app()->getLocale();
    // กำหนด mapping สำหรับตำแหน่งในภาษาจีน
    $positionMap = [];
    if ($locale === 'zh') {
        $positionMap = [
            'Assoc. Prof. Dr.' => '副教授 博士',
            'Prof. Dr.'        => '教授 博士',
            'Asst. Prof. Dr.'  => '助理教授 博士',
            'Asst. Prof.'      => '助理教授',
            'Lecturer'         => '讲师',
        ];
    }
    // กรองสมาชิกของกลุ่มที่มี role == 2
    $members = $researchGroup->user->filter(function($user) {
        return $user->pivot->role == 2;
    });
@endphp

<div class="row mt-1">
    <p class="card-text col-sm-3"><b>{{ trans('message.research_group_members') }}</b></p>
    <p class="card-text col-sm-9">
        @foreach($members as $user)
            {{ $locale == 'zh' 
                ? ($positionMap[$user->position_en] ?? $user->position_en) 
                : $user->{'position_'.app()->getLocale()} 
            }}
            {{ $locale == 'zh' ? $user->fname_en : $user->{'fname_'.app()->getLocale()} }}
            {{ $locale == 'zh' ? $user->lname_en : $user->{'lname_'.app()->getLocale()} }}
            @if(!$loop->last)
                ,
            @endif
        @endforeach
    </p>
</div>

            <a class="btn btn-primary mt-5" href="{{ route('researchGroups.index') }}"> {{ trans('message.back') }}</a>
        </div>
    </div>
    
@stop
@section('javascript')
<script>
$(document).ready(function() {

    /* When click New customer button */
    $('#new-customer').click(function() {
        $('#btn-save').val("create-customer");
        $('#customer').trigger("reset");
        $('#customerCrudModal').html("Add New Customer EiEi");
        $('#crud-modal').modal('show');
    });
    /* When click New customer button */
    $('#new-customer2').click(function() {
        $('#btn-save').val("create-customer");
        $('#customer').trigger("reset");
        $('#customerCrudModal').html("Add New Customer EiEi");
        $('#crud-modal').modal('show');
    });
});
</script>

@stop