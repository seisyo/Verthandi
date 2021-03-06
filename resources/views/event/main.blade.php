@extends('component.layout', ['title' => $eventInfo->name])

{{-- Custom css section --}}
@section('custom_css')
<link rel="stylesheet" href="{{url('assets/css/custom/lightbox.css')}}">
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
        {{$eventInfo->name}}
    </h2>
    <li>
        <a href="{{route('index')}}">首頁</a>
    </li>
    <li>
        <a href="{{route('event::manage::main')}}">活動管理</a>
    </li>
    <li>
        <a href="{{url('event/' . $eventInfo->id . '/main')}}">{{$eventInfo->name}}</a>
    </li>
@endsection

{{-- Content section --}}
@section('content')

@endsection
