@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card col-md-8" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.research_projects_detail') }}</h4>
            <p class="card-description">{{ trans('message.research_projects_detail_info') }}</p>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.project_name') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->project_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.project_start_date') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->project_start }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.project_end_date') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->project_end }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.research_funding_source') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->fund->fund_name }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.amount') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->budget }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.project_details') }}</b></p>
                <p class="card-text col-sm-9">{{ $researchProject->note }}</p>
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.project_status') }}</b></p>
                @if($researchProject->status == 1)
                <p class="card-text col-sm-9">{{ trans('message.requested') }}</p>
                @elseif($researchProject->status == 2)
                <p class="card-text col-sm-9">{{ trans('message.in_progress') }}</p>
                @else
                <p class="card-text col-sm-9">{{ trans('message.closed') }}</p>
                @endif
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.project_leader') }}</b></p>
                @foreach($researchProject->user as $user)
                @if ( $user->pivot->role == 1)
                <p class="card-text col-sm-9">{{$user->position_th}}{{ $user->fname_th}} {{ $user->fname_th}}</p>
                @endif
                @endforeach
            </div>
            <div class="row">
                <p class="card-text col-sm-3"><b>{{ trans('message.project_members') }}</b></p>
                @foreach($researchProject->user as $user)
                @if ( $user->pivot->role == 2)
                <p class="card-text col-sm-9">{{$user->position_th}}{{ $user->fname_th}} {{ $user->fname_th}}
				@if (!$loop->last),@endif
                @endif
                
                @endforeach

                @foreach($researchProject->outsider as $user)
                @if ( $user->pivot->role == 2)
                ,{{$user->title_name}}{{ $user->fname}} {{ $user->fname}}</p>
				@if (!$loop->last),@endif
                @endif
                
                @endforeach
            </div>
            <div class="pull-right mt-5">
                <a class="btn btn-primary" href="{{ route('researchProjects.index') }}">{{ trans('message.back') }}</a>
            </div>

        </div>
    </div>
</div>
@endsection