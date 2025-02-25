@extends('dashboards.users.layouts.user-dash-layout')
@section('title','Dashboard')

@section('content')

<h3 style="padding-top: 10px;">{{trans('message.welcome_message')}}</h3>
<br>
@php
    $locale = app()->getLocale(); // ดึงค่าภาษาปัจจุบัน
    $role = Auth::user()->roles->first()->name ?? 'staff'; // ดึง role ของผู้ใช้
    $roleKey = 'message.Role_' . strtolower($role);
    $translatedRole = trans($roleKey);

    // แสดงชื่อเป็นภาษาที่เลือก
    $fnameKey = ($locale === 'th') ? Auth::user()->fname_th : (($locale === 'zh') ? Auth::user()->fname_en : Auth::user()->fname_en);
    $lnameKey = ($locale === 'th') ? Auth::user()->lname_th : (($locale === 'zh') ? Auth::user()->lname_en : Auth::user()->lname_en);
@endphp

<h4>{{ trans('message.Hello') }} {{ $translatedRole }} {{ $fnameKey }} {{ $lnameKey }}</h4>

@endsection
