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

@endsection

{{-- Content section --}}
@section('content')
    
@endsection
