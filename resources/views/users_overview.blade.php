@extends('component.layout', ['title' => '使用者管理'])

{{-- Custom css section --}}
@section('custom_css')
<link rel="stylesheet" href="assets/css/plugins/toastr/toastr.min.css">
@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="assets/js/plugins/toastr/toastr.min.js"></script>
@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
@parent
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
<h2>使用者管理</h2>
<li>
    <a href="{{url('/')}}">首頁</a>
</li>
<li>
    <a href="{{url('/user')}}">使用者管理</a>
</li>

@endsection

{{-- Content section --}}
@section('content')
@if(Session::has('message'))
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

        // var $toast = toastr["info"]("{{Session::get('message')}}");
        toastr.success("{{Session::get('message')}}");
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
                                            
                                            <form class="form-horizontal" method="get" action="{{url('/user/add')}}">
                                                <div class="modal-body">
                                                    @if(Session::has('errors')) 
                                                    @foreach(Session::get('errors')->all() as $error)
                                                    <div class="alert alert-danger">
                                                        {{$error}}
                                                    </div>
                                                    <script type="text/javascript">
                                                    $(window).load(function(){
                                                        $('#adduser').modal('show');
                                                    });
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
                                                <script>
                                                $('.modal').on('hidden.bs.modal', function(){
                                                    $(this).find('form')[0].reset();
                                                });
                                                </script>
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
                                                                
                                                                <form class="form-horizontal" method="get" action="{{url('/user/edit')}}">
                                                                    <div class="modal-body">
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
                                                                </form>

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
                                                    <!-- modal end -->
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endsection
