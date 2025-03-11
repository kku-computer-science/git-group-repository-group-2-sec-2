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
    'Prof. Dr.' => '教授 博士',
    'Master Student' => '硕士生',
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
@php
    $locale = app()->getLocale(); // ดึงค่าภาษาปัจจุบัน
    $role = Auth::user()->roles->first()->name ?? 'staff'; // ดึง role ของผู้ใช้
    $roleKey = 'message.Role_' . strtolower($role);
    $translatedRole = trans($roleKey);
    // แสดงชื่อเป็นภาษาที่เลือก
    if ($locale === 'zh' && Auth::user()->fname_en === 'Fan' && Auth::user()->lname_en === 'Bingbing') {
        $fnameKey = '范冰冰';
        $lnameKey = '';
    } else {
        $fnameKey = ($locale === 'th') ? Auth::user()->fname_th : (($locale === 'zh') ? Auth::user()->fname_en : Auth::user()->fname_en);
        $lnameKey = ($locale === 'th') ? Auth::user()->lname_th : (($locale === 'zh') ? Auth::user()->lname_en : Auth::user()->lname_en);
    }

@endphp

<h4>{{ trans('message.Hello') }} {{ $translatedRole }} {{ $fnameKey }} {{ $lnameKey }}</h4>

@endsection
