@extends('component.layout', ['title' => 'SITCON 2015'])

{{-- Custom css section --}}
@section('custom_css')
@endsection

{{-- Custom js section --}}
@section('custom_js')

@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
    @include('component.navbar.event')
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
<h2>
    SITCON 2016
</h2>
<li>
    <a href="{{url('/')}}">首頁</a>
</li>
<li>
    <a>活動帳簿管理</a>
</li>
<li>
    <a>SITCON 2016</a>
</li>
@endsection

{{-- Content section --}}
@section('content')
    
@endsection
