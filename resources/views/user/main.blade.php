@extends('component.layout', ['title' => '使用者管理'])

{{-- Custom css section --}}
@section('custom_css')
<link rel="stylesheet" href="assets/css/plugins/toastr/toastr.min.css">
@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="assets/js/plugins/toastr/toastr.min.js"></script>
<script src="assets/js/custom/modal_autoopen.js"></script>
<script src="assets/js/custom/modal_reset.js"></script>
@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
@parent
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
<h2>使用者管理</h2>
<li>
    <a href="{{route('index')}}">首頁</a>
</li>
<li>
    <a href="{{route('user::main')}}">使用者管理</a>
</li>

@endsection

{{-- Content section --}}
@section('content')
@if(Session::has('toast_message'))
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "progressBar": true,
            "preventDuplicates": false,
            "positionClass": "toast-top-full-width",
            "onclick": null,
            "showDuration": "4000",
            "hideDuration": "1000",
            "timeOut": "15000",
            "extendedTimeOut": "1000",
            "showEasing": "linear",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.success("{{Session::get('toast_message')}}");
    </script>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">

            <div class="ibox-title"> 
                <div class="row">

                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
                            ＋新增使用者
                        </button>

                        <div class="modal fade" id="adduser">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">新增使用者</h4>
                                    </div>
                                    
                                    <form class="form-horizontal" method="get" action="{{route('user::add')}}">
                                        <div class="modal-body">
                                            @if(Session::has('errors')) 
                                            @foreach(Session::get('errors')->all() as $error)
                                            <div class="alert alert-danger">
                                                {{$error}}
                                            </div>
                                            <!-- when it has error, reload the page will auto open the modal -->
                                            <script>
                                            modal_autoopen("#adduser");
                                            </script>
                                            @endforeach
                                            @endif
                                            <div class="row">
                                                @include("component.modal.userAdd")
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                            <a href="">
                                                <button type="submit" class="btn btn-primary">新增</button>
                                            </a>
                                        </div>
                                        <!-- cancel the modal will auto clean the inputed data  -->
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- modal end -->
                    </div>

                    <div class="col-md-3 pull-right">
                        <div class="input-group"><input type="text" placeholder="搜尋" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> 搜尋</button> </span></div>
                        </div>

                    </div> 
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th class="col-md-1">序號</th>
                                        <th class="col-md-2">帳號</th>
                                        <th class="">名稱</th>
                                        <th class="col-md-1">權限</th>
                                        <th class="col-md-1">狀態</th>
                                        <th class="col-md-2">操作</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($userList as $user)
                                        @if($user->status !== 'disable')
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->nickname}}</td>
                                            <td>{{$user->permission}}</td>
                                            <td>{{$user->status}}</td>
                                            <td>
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{'#edituser'.$user->id}}">預覽＆編輯</button>
                                                <div class="modal fade" id="{{'edituser'.$user->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">預覽＆編輯使用者</h4>
                                                            </div>
                                                            
                                                            <form class="form-horizontal" method="get" action="{{route('user::edit')}}">
                                                                <div class="modal-body">
                                                                    <!-- 'errors'.$user->id -->
                                                                    @if(Session::has(('errors'.$user->id)))
                                                                    @foreach(Session::get('errors'.$user->id)->all() as $error)
                                                                    <div class="alert alert-danger">
                                                                        {{$error}}
                                                                    </div>
                                                                    <!-- when it has error, reload the page will auto open the modal -->
                                                                    <script>
                                                                    modal_autoopen("{{'#edituser'.$user->id}}");
                                                                    </script>
                                                                    @endforeach
                                                                    @endif
                                                                    <div class="row">
                                                                        @include("component.modal.userEdit")
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                                    <a href="">
                                                                        <button type="submit" class="btn btn-primary">確定修改</button>
                                                                    </a>
                                                                </div>
                                                                <!-- cancel the modal will auto clean the inputed data  -->
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal end -->
                                                
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{'#deleteuser'.$user->id}}">刪除</button>

                                                <div class="modal fade" id="{{'deleteuser'.$user->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">刪除使用者</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                確定要刪除使用者「{{$user->username}}」嗎？
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="get" action="{{route('user::delete')}}">
                                                                    <input type="hidden" name="username" value="{{$user->username}}">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                                    <button type="submit" class="btn btn-danger">確定刪除</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal end -->

                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
    modal_reset(".modal");
    </script>
    @endsection
