@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'Dashboard')

@section('content')
@php
$user = Auth::user();
$locale = app()->getLocale();

// Use English names if language is Chinese
if ($locale === 'zh') {
    $position = '教授';
    $fname = $user->fname_en ?? 'N/A';
    $lname = $user->lname_en ?? 'N/A';
} else {
    // Default mapping based on locale
    $position = $user->{'position_' . $locale} ?? $user->position_en ?? 'N/A';
    $fname = $user->{'fname_' . $locale} ?? 'N/A';
    $lname = $user->{'lname_' . $locale} ?? 'N/A';
}


@endphp

<h3 style="padding-top: 10px;">{{trans('message.welcome_message')}}</h3>
<br>
<h4>{{ trans('message.greeting', ['position' => $position, 'fname' => $fname, 'lname' => $lname]) }}</h4>


@endsection
