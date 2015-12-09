@extends('component.layout', ['title' => '會計科目管理'])

{{-- Custom css section --}}
@section('custom_css')

@endsection

{{-- Custom js section --}}
@section('custom_js')

@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
    @include('component.navbar.default')
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
<h2>會計科目管理</h2>
<li>
    <a href="{{route('index')}}">首頁</a>
</li>
<li>
    <a href="{{route('account::main')}}">會計科目管理</a>
</li>
@endsection

{{-- Content section --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            
            <div class="ibox-title">
                
                <div class="row">
                    
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
                            ＋新增會計科目
                        </button>
                        
                        <div class="modal fade" id="adduser">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">新增會計科目</h4>
                                    </div>
                                    <div class="modal-body">
                                        @include("component.modal.account")
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

                    <div class="col-md-3 pull-right">
                        <div class="input-group">
                            <input type="text" placeholder="搜尋" class="input-sm form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary"> 搜尋</button> 
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3 pull-right">
                        <select class="form-control">
                            <option value="資產">資產</option>
                            <option value="負債">負債</option>
                            <option value="餘絀">餘絀</option>
                            <option value="收益">收益</option>
                            <option value="費損">費損</option>
                        </select>
                    </div>
                
                </div>          
            
            </div>
            
            <div class="ibox-content">
                
                <div class="row">
                    
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-md-1">會計科目編號</th>
                                    <th class="col-md-2">會計要素</th>
                                    <th class="">科目名稱</th>
                                    <th class="col-md-1">方向</th>
                                    <th class="col-md-2">備註</th>
                                    <th class="col-md-2">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1001</td>
                                    <td>資產</td>
                                    <td>現金</td>
                                    <td>借</td>
                                    <td>---</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edituser">編輯</button>
                                        
                                        <div class="modal fade" id="edituser">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">編輯會計科目</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include("component.modal.account")
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                        <button type="button" class="btn btn-success">確定修改</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal end -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser">刪除</button>

                                        <div class="modal fade" id="deleteuser">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">刪除會計科目</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        確定要刪除此會計科目嗎？
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
