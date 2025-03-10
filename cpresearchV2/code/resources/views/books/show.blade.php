@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.book_detail') }}</h4>
            <p class="card-description">{{ trans('message.book_detail_info') }}</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.book_name') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->ac_name }}</p>
            </div>  
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.book_year') }}</b></p>
                <p class="card-text col-sm-9">{{  date('Y', strtotime($paper->ac_year))+543 }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.book_publisher') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->ac_sourcetitle }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.book_page') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->ac_page }}</p>
            </div>

            <div class="pull-right mt-5">
                <a class="btn btn-primary btn-sm" href="{{ route('books.index') }}">{{ trans('message.back') }}</a>
            </div>
        </div>

    </div>


</div>
@endsection