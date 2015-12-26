@extends('component.layout', ['title' => '使用者管理'])

{{-- Custom css section --}}
@section('custom_css')
<link rel="stylesheet" href="assets/css/plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="assets/css/plugins/select2/select2.min.css">
@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="assets/js/plugins/toastr/toastr.min.js"></script>
<script src="assets/js/plugins/select2/select2.full.min.js"></script>
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
@include('component.toast')
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">

            <div class="ibox-title"> 
                <div class="row">

                    <div class="col-md-2">
                        
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-user">
                            ＋新增使用者
                        </button>

                        <div class="modal fade" id="add-user">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">新增使用者</h4>
                                    </div>
                                    
                                    <form class="form-horizontal" method="post" action="{{route('user::add')}}">
                                        <div class="modal-body">
                                            @if(Session::has(('errors')))
                                                @foreach(Session::get('errors')->all() as $error)
                                                    <div class="alert alert-danger">
                                                        {{$error}}
                                                    </div>
                                                    <script>
                                                        modal_autoopen("#add-user");
                                                    </script>
                                                @endforeach
                                            @endif
                                            <div class="row">
                                                @include('component.modal.userAdd')
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                            <a href="">
                                                <button type="submit" class="btn btn-primary">新增</button>
                                            </a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- modal end -->
                    </div>

                    <div class="col-md-3 pull-right">

                        <select class="form-control" id="search-id">
                            <option></option>
                            @foreach ($userList as $user)
                            <option value="{{$user->id}}">{{$user->username}}</option>
                            @endforeach
                        </select>

                        <script type="text/javascript">
                        $(document).ready(function(){
                            
                            var DoAjax = function(url, parametors, sHandler, eHandler, pageNotFoundHandler){
                                $.ajax({
                                    type: "GET",
                                    url: url,
                                    data: parametors,
                                    success: sHandler,
                                    error: eHandler,
                                    statusCode:{
                                        404: pageNotFoundHandler
                                    }
                                });
                            };
                            $("#search-id").select2({
                                placeholder: "搜尋",
                                allowClear: true
                            });
                            
                            $("#search-id").change(function(){
                                var url = "{{route('user::searchById')}}";

                                setTimeout(function(){
                                    DoAjax(url, {id: $("#search-id").val()},
                                        function(data, textStatus, jqXHR){
                                            //hide all tr
                                            $("tbody > tr").hide();
                                            //show the selected tr
                                            $("#" + data.content.id).show();
                                        });
                                });
                            }); 
                        })
                        </script>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>啟用使用者</h2>
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th class="col-md-2">帳號</th>
                                        <th class="">名稱</th>
                                        <th class="col-md-2">權限</th>
                                        <th class="col-md-1">狀態</th>
                                        <th class="col-md-3">操作</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($userList as $user)
                                        @if ($user->status !== 'disable')
                                        <tr id="{{$user->id}}">
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->nickname}}</td>
                                            <td>@include('component.permission', ['from' => $user->permission])</td>
                                            <td>{{$user->status}}</td>
                                            <td>
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{'#edit-user'.$user->id}}">
                                                    編輯
                                                </button>
                                                <div class="modal fade" id="{{'edit-user'.$user->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title">預覽＆編輯使用者</h4>
                                                            </div>
                                                            
                                                            <form class="form-horizontal" method="post" action="{{route('user::edit')}}">
                                                                <div class="modal-body">
                                                                    @if(Session::has(('errors'.$user->id)))
                                                                        @foreach(Session::get('errors'.$user->id)->all() as $error)
                                                                            <div class="alert alert-danger">
                                                                                {{$error}}
                                                                            </div>
                                                                            <script>
                                                                                modal_autoopen("{{'#edit-user'.$user->id}}");
                                                                            </script>
                                                                        @endforeach
                                                                    @endif
                                                                    <div class="row">
                                                                        @include("component.modal.userEdit")
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                                
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{'#disable-user'.$user->id}}">
                                                    停用
                                                </button>

                                                <div class="modal fade" id="{{'disable-user'.$user->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title">停用使用者</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                確定要停用使用者「{{$user->username}}」嗎？
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="post" action="{{route('user::disable')}}">
                                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                            <h2>停用使用者</h2>
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th class="col-md-2">帳號</th>
                                        <th class="">名稱</th>
                                        <th class="col-md-2">權限</th>
                                        <th class="col-md-1">狀態</th>
                                        <th class="col-md-3">操作</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($userList as $user)
                                        @if ($user->status === 'disable')
                                        <tr id="{{$user->id}}">
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->nickname}}</td>
                                            <td>@include('component.permission', ['from' => $user->permission])</td>
                                            <td>{{$user->status}}</td>
                                            <td>
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{'#edit-user'.$user->id}}">
                                                    編輯
                                                </button>
                                                <div class="modal fade" id="{{'edit-user'.$user->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title">預覽＆編輯使用者</h4>
                                                            </div>
                                                            
                                                            <form class="form-horizontal" method="post" action="{{route('user::edit')}}">
                                                                <div class="modal-body">
                                                                    @if(Session::has(('errors'.$user->id)))
                                                                        @foreach(Session::get('errors'.$user->id)->all() as $error)
                                                                            <div class="alert alert-danger">
                                                                                {{$error}}
                                                                            </div>
                                                                            <script>
                                                                                modal_autoopen("{{'#edit-user'.$user->id}}");
                                                                            </script>
                                                                        @endforeach
                                                                    @endif
                                                                    <div class="row">
                                                                        @include("component.modal.userEdit")
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                                
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="{{'#activate-user'.$user->id}}">
                                                    啟用
                                                </button>

                                                <div class="modal fade" id="{{'activate-user'.$user->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title">啟用使用者</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                確定要啟用使用者「{{$user->username}}」嗎？
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="post" action="{{route('user::activate')}}">
                                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                                    <button type="submit" class="btn btn-primary">確定啟用</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal end -->
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{'#delete-user'.$user->id}}">
                                                    刪除
                                                </button>

                                                <div class="modal fade" id="{{'delete-user'.$user->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title">刪除使用者</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                確定要刪除使用者「{{$user->username}}」嗎？
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="post" action="{{route('user::delete')}}">
                                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
