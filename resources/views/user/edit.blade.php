@extends('component.layout', ['title' => '修改密碼'])

{{-- Custom css section --}}
@section('custom_css')
<link rel="stylesheet" href="assets/css/plugins/toastr/toastr.min.css">
@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="assets/js/plugins/toastr/toastr.min.js"></script>
@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
@include('component.navbar.default')
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
<h2>
    修改密碼
</h2>
<li>
    <a href="{{route('index')}}">首頁</a>
</li>
<li>
    <a href="{{route('password::main')}}">編輯帳號</a>
</li>
@endsection

{{-- Content section --}}
@section('content')

@endsection