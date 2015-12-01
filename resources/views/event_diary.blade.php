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
<li>
    <a href="{{url('')}}">首頁</a>
</li>
<li>
    <a>活動帳簿</a>
</li>
<li>
    <a>SITCON2016</a>
</li>
<li>
    <a>日記簿</a>
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
                            <!-- ？？不知道為什麼有row和沒row邊際有差 -->
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
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">日期</th>
                                        <th>交易內容</th>
                                        <th class="col-sm-1">金額</th>
                                        <th class="col-sm-2">備註</th>
                                        <th class="col-sm-2">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2015-11-29</td>
                                        <td>財務組買水</td>
                                        <td>100</td>
                                        <td>---</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewtrans">預覽</button>
                                            <div class="modal fade" id="viewtrans">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">預覽交易分錄</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary">確認</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edittrans">編輯</button>
                                            
                                            <div class="modal fade" id="edittrans">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">編輯交易分錄</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                            <button type="button" class="btn btn-success">確定修改</button>
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
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>       
            </div>
        </div>
    </div>
@endsection
