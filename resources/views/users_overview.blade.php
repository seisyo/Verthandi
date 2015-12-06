@extends('component.layout', ['title' => '使用者管理'])

{{-- Custom css section --}}
@section('custom_css')
@parent
@endsection

{{-- Custom js section --}}
@section('custom_js')
@parent
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
    <a href="{{url('/account')}}">使用者管理</a>
</li>

@endsection

{{-- Content section --}}
@section('content')
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
                                    <form class="form-horizontal" method="get" action="{{url('/adduser')}}">
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
                                            @if(Session::has('message'))
                                                <div class="alert alert-danger">
                                                    <strong>{{Session::get('message')}}</strong>
                                                </div>
                                            @endif
                                            @include("component.modal.user")
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
                                @for($i = 0; $i < 10; $i++)
                                <tbody>
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>seisyo{{$i+1}}</td>
                                        <td>seisyo-{{$i+1}}號</td>
                                        <td>1</td>
                                        <td>已啟用</td>   
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
                                                            <button type="button" class="btn btn-primary">確定修改</button>
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
                                </tbody>
                                @endfor
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection
