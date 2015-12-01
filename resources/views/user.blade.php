@extends('component.layout', ['title' => '使用者管理'])

{{-- Custom css section --}}
@section('custom_css')
@endsection

{{-- Custom js section --}}
@section('custom_js')

@endsection

{{-- Content section --}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
                                ＋新增使用者
                            </button>
                            <div class="modal fade" id="adduser">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">新增使用者</h4>
                                        </div>
                                        <div class="modal-body">
                                            @include("component.modal.user")
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                            <button type="button" class="btn btn-primary">新增</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-3">
                            <div class="input-group"><input type="text" placeholder="搜尋" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary"> 搜尋</button> </span></div>
                        </div> -->
                    </div>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-sm-1">序號</th>
                                <th class="col-sm-2">帳號</th>
                                <th class="col-sm-2">名稱</th>
                                <th class="col-sm-1">權限</th>
                                <th class="col-sm-2">操作</th>
                            </tr>
                        </thead>
                        @for($i = 0; $i < 10; $i++)
                        <tbody>
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>seisyo{{$i+1}}</td>
                                <td>seisyo-{{$i+1}}號</td>
                                <td>1</td>
                                <td>
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edituser">編輯</button>
                                    <div class="modal fade" id="edituser">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">編輯使用者</h4>
                                                </div>
                                                <div class="modal-body">
                                                    @include("component.modal.user")
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                    <button type="button" class="btn btn-success">確定修改</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser">刪除</button>
                                    
                                    <div class="modal fade" id="deleteuser">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">刪除使用者</h4>
                                                </div>
                                                <div class="modal-body">
                                                    確定要刪除此使用者嗎？
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                    <button type="button" class="btn btn-danger">確定刪除</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- modal end --}}
                                </td>
                            </tr>
                        </tbody>
                        @endfor
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
