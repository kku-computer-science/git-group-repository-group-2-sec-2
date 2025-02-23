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
                <p class="card-text col-sm-9">{{ $fund->fund_type }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.fund_level') }}</b></p>
                <p class="card-text col-sm-9">{{ $fund->fund_level }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.agency') }}</b></p>
                <p class="card-text col-sm-9">{{ $fund->support_resource }}</p>
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