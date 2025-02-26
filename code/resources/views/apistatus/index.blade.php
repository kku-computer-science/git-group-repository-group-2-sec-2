@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <h2>{{trans('message.api_status')}}</h2>
    <table class="table">
        <thead>
            <tr>
                <th>{{trans('message.api_name')}}</th>
                <th>{{trans('message.status')}}</th>
                <th>{{trans('message.last_checked')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
                <tr>
                    <td>{{ $status->api_name }}</td>
                    <td>
                        @if ($status->status == 'active')
                            <span class="badge bg-success">{{trans('message.active')}}</span>
                        @else
                            <span class="badge bg-danger">{{trans('message.inactive')}}</span>
                        @endif
                    </td>
                    <td>{{ $status->last_checked }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection