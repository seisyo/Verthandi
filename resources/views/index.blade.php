@extends('component.layout', ['title' => '首頁'])

{{-- Custom css section --}}
@section('custom_css')
@endsection

{{-- Custom js section --}}
@section('custom_js')

@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
    @parent
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
<li>
    <a href="{{url('')}}">首頁</a>
</li>
@endsection

{{-- Content section --}}
@section('content')
    
@endsection