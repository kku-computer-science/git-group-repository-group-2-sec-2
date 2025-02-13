@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <h2>API Status</h2>
    <table class="table">
        <thead>
            <tr>
                <th>API Name</th>
                <th>Status</th>
                <th>Last Checked</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
                <tr>
                    <td>{{ $status->api_name }}</td>
                    <td>
                        @if ($status->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $status->last_checked }}</td>
                    <td>{{ $status->message ?? 'No issues' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection