@extends('component.layout', ['title' => '會計科目管理'])

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
@include('component.toast', ['type' => 'success'])
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">

            <div class="ibox-title">
                <div class="row">

                    <div class="col-md-2">

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-account">
                            ＋新增會計科目
                        </button>

                        <div class="modal fade" id="add-account">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">新增會計科目</h4>
                                    </div>

                                    <form class="form-horizontal" method="get" action="{{route('account::add')}}">
                                        <div class="modal-body">
                                            @if(Session::has(('errors')))
                                            @foreach(Session::get('errors')->all() as $error)
                                            <div class="alert alert-danger">
                                                {{$error}}
                                            </div>
                                            <!-- when it has error, reload the page will auto open the modal -->
                                            <script>
                                            modal_autoopen("#add-account");
                                            </script>
                                            @endforeach
                                            @endif
                                            <div class="row">
                                                @include('component.modal.accountAdd')
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
                        <select class="select2_demo_3 form-control">
                            <option></option>
                            @foreach ($accountList as $account)
                            <option value="{{$account->id}}">{{$account->id .'  '. $account->name}}</option>
                            @endforeach
                        </select>
                        
                        <script>
                        $(".select2_demo_3").select2({
                            placeholder: "搜尋",
                            allowClear: true
                        });
                        </script>
                    </div>

                </div>          
            </div>

            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th class="col-md-1">科目編號</th>
                                    <th class="">科目名稱</th>
                                    <th class="col-md-1">方向</th>
                                    <th class="col-md-1">父科目</th>
                                    <th class="col-md-2">備註</th>
                                    <th class="col-md-2">操作</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($accountList as $account)
                                <tr>
                                    <td>{{$account->id}}</td>
                                    <td>{{$account->name}}</td>
                                    @if ($account->direction)
                                    <td>借</td>
                                    @else
                                    <td>貸</td>
                                    @endif
                                    <td>{{$account->parent_id}}</td>   
                                    <td>{{$account->comment}}</td>
                                    <td>

                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{'#edit-account'.$account->id}}">
                                            編輯
                                        </button>

                                        <div class="modal fade" id="{{'edit-account'.$account->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title">編輯會計科目</h4>
                                                    </div>

                                                    <form class="form-horizontal" method="get" action="{{route('account::edit')}}">
                                                        <div class="modal-body">
                                                            @if(Session::has(('errors'.$account->id)))
                                                            @foreach(Session::get('errors'.$account->id)->all() as $error)
                                                            <div class="alert alert-danger">
                                                                {{$error}}
                                                            </div>
                                                            <script>
                                                            modal_autoopen("{{'#edit-account'.$account->id}}");
                                                            </script>
                                                            @endforeach
                                                            @endif
                                                            <div class="row">
                                                                @include("component.modal.accountEdit")
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

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{'#delete-account'.$account->id}}">
                                            刪除
                                        </button>

                                        <div class="modal fade" id="{{'delete-account'.$account->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title">刪除會計科目</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        確定要刪除會計科目「{{$account->name}}」嗎？
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="get" action="{{route('account::delete')}}">
                                                            <!-- <p>{{$account->id}}</p> -->
                                                            <input type="hidden" name="id" value="{{$account->id}}">
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
