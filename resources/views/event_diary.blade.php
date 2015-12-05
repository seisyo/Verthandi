@extends('component.layout', ['title' => 'SITCON 2016'])

{{-- Custom css section --}}
@section('custom_css')
<link href="{{url('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{url('assets/css/plugins/footable/footable.core.css')}}" rel="stylesheet">

@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="{{url('assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{url('assets/js/plugins/footable/footable.all.min.js')}}"></script>
<script src="{{url('assets/js/custom/add_transaction.js')}}"></script>
<script src="{{url('assets/js/custom/delete_transaction.js')}}"></script>
<script>
$(document).ready(function() {
    $(".footable").footable();
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
    SITCON 2016 日記簿
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

                        <div class="row">
                            <div class="col-md-12">

                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">交易日期</th>
                                            <th>記帳日</th>
                                            <th>交易內容</th>
                                            <th class="col-md-1">經手人</th>
                                            <th class="col-md-1">記帳人</th>   
                                            <th data-hide="all">分錄</th>
                                            <th class="col-md-2">備註</th>
                                            <th class="col-md-2">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2015-11-29</td>
                                            <td>2015-11-30</td>
                                            <td>行銷組購買文具</td>
                                            <td>影子</td>
                                            <td>遇雨</td>
                                            <td>
                                                <!-- <div class="col-md-12">
                                                    <div class="row">
                                                        <table>
                                                            <thead>
                                                                <th>借方</th>
                                                                <th>金額</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>文具用品</td>
                                                                    <td>1000</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <table>
                                                            <thead>
                                                                <th>貸方</th>
                                                                <th>金額</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>文具用品</td>
                                                                    <td>1000</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> -->
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <label>借方</label>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <strong>文具用品</strong>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p>1000</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>貸方</label>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <strong>現金</strong>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p>800</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <strong>其他應付款</strong>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p>200</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>---</td>
                                            <td>

                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edittrans">編輯</button>

                                                <div class="modal fade" id="edittrans">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">編輯交易分錄</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- @include('component.modal.transaction') -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                                <button type="button" class="btn btn-primary">確定修改</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal end -->

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletetrans">刪除</button>

                                                <div class="modal fade" id="deletetrans">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">刪除交易分錄</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                確定要刪除此交易分錄嗎？
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                                <button type="button" class="btn btn-danger">確定刪除</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal end -->
                                            </td>
                                        </td>
                                    </tr>

                                </tbody>    
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <ul class="pagination pull-right"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>

                </div>
            </div> 

        </div>
    </div>
</div>
</div>
@endsection
