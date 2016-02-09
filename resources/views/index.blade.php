@extends('component.layout', ['title' => '首頁'])

{{-- Custom css section --}}
@section('custom_css')
<link rel="stylesheet" href="{{url('assets/css/plugins/toastr/toastr.min.css')}}">
@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="{{url('assets/js/plugins/toastr/toastr.min.js')}}"></script>
@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
    @parent
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
    <h2>首頁</h2>
    <li>
        <a href="{{route('index')}}">首頁</a>
    </li>
@endsection

{{-- Content section --}}
@section('content')
@include('component.toast')
@endsection