@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'Dashboard')

@section('content')
@php
$user = Auth::user();
$locale = app()->getLocale();

// Define position mappings
$position_map = [
    'Assoc. Prof. Dr.' => '副教授 博士',
    'Asst. Prof.' => '助理教授',
    'Asst. Prof. Dr.' => '助理教授 博士',
    'Lecturer' => '讲师',
    'Prof. Dr.' => '教授 博士'
];

// Determine position translation
if ($locale === 'zh') {
    $position = $position_map[$user->position_en] ?? 'N/A';
    $fname = $user->fname_en ?? 'N/A';
    $lname = $user->lname_en ?? 'N/A';
} else {
    $position = $user->{'position_' . $locale} ?? $user->position_en ?? 'N/A';
    $fname = $user->{'fname_' . $locale} ?? 'N/A';
    $lname = $user->{'lname_' . $locale} ?? 'N/A';
}
@endphp

<h3 style="padding-top: 10px;">{{ trans('message.welcome_message') }}</h3>
<br>
<h4>{{ trans('message.greeting', ['position' => $position, 'fname' => $fname, 'lname' => $lname]) }}</h4>

@endsection
