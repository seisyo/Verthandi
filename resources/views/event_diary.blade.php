@extends('component.layout', ['title' => 'SITCON 2016'])

{{-- Custom css section --}}
@section('custom_css')
@parent
<link href="{{url('assets/css/bootstrap-datepicker3.css')}}" rel="stylesheet" >
<link href="{{url('assets/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
@endsection

{{-- Custom js section --}}
@section('custom_js')
@parent
<script src="{{url('assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{url('assets/js/plugins/footable/footable.all.min.js')}}"></script>
<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });
</script>
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
    <a href="{{url('/event_manage')}}">活動帳簿管理</a>
</li>
<li>
    <a href="{{url('/event')}}">SITCON 2016</a>
</li>
<li>
    <a href="{{url('/event_diary')}}">日記簿</a>
</li>
@endsection

{{-- Content section --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
                            ＋新增交易分錄
                        </button>

                        <div class="modal fade" id="adduser">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">新增交易分錄</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            @include('component.modal.transaction')
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                        <button type="button" class="btn btn-primary">新增</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal end -->
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div> 
            </div>

        </div>
    </div>
</div>
@endsection
