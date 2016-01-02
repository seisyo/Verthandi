@extends('component.layout', ['title' => $eventInfo->name])

{{-- Custom css section --}}
@section('custom_css')
<link href="{{url('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{url('assets/css/plugins/toastr/toastr.min.css')}}">
<link href="{{url('assets/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{url('assets/css/plugins/select2/select2.min.css')}}">

@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="{{url('assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{url('assets/js/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('assets/js/plugins/footable/footable.all.min.js')}}"></script>
<script src="{{url('assets/js/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{url('assets/js/custom/add_transaction.js')}}"></script>
<script src="{{url('assets/js/custom/delete_transaction.js')}}"></script>
<script src="{{url('assets/js/custom/modal_autoopen.js')}}"></script>
<script src="{{url('assets/js/custom/modal_reset.js')}}"></script>
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
    {{$eventInfo->name}} 日記簿
</h2>
<li>
    <a href="{{route('index')}}">首頁</a>
</li>
<li>
    <a href="{{route('event::manage')}}">活動帳簿管理</a>
</li>
<li>
    <a href="{{route('event::main', ['id' => $eventInfo->id])}}">{{$eventInfo->name}}</a>
</li>
<li>
    <a href="{{route('event::diary', ['id' => $eventInfo->id])}}">日記簿</a>
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
                    <div class="col-md-12">

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-transaction">
                            ＋新增交易分錄
                        </button>

                        <div class="modal fade" id="add-transaction">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">新增交易分錄</h4>
                                    </div>
                                    
                                    <form class="form-horizontal" method="post" action="{{url('event/' . $eventInfo->id . '/diary/add')}}" id="transaction-add-form">
                                        <div class="modal-body">
                                            @if(Session::has(('errors')))
                                            @foreach(Session::get('errors')->all() as $error)
                                            <div class="alert alert-danger">
                                                {{$error}}
                                            </div>
                                            <!-- when it has error, reload the page will auto open the modal -->
                                            <script>
                                                modal_autoopen("#add-transaction");
                                            </script>
                                            @endforeach
                                            @endif

                                            <div class="row">
                                                @include('component.modal.transaction')
                                                <input type="hidden" id="debit_array" name="debit_array">
                                                <input type="hidden" id="credit_array" name="credit_array">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                            <button type="button" class="btn btn-primary" id="add-button">新增</button>
                                        </div>
                                    </form>
                                    <script>
                                        var debitJson = {};
                                        var creditJson = {};
                                        $("#add-button").click(function(){
                                            
                                            var count = 0;
                                            $("div[id*='debit_account']").each(function(){
                                                debitJson[count] = {
                                                    "account" : $(this).find(".account").val(),
                                                    "amount" : $(this).find(".amount").val()
                                                };
                                                count++;
                                            });

                                            count = 0;
                                            $("div[id*='credit_account']").each(function(){
                                                creditJson[count] = {
                                                    "account" : $(this).find(".account").val(),
                                                    "amount" : $(this).find(".amount").val()
                                                };
                                                count++;
                                            });

                                            $("#debit_array").val(JSON.stringify(debitJson));
                                            $("#credit_array").val(JSON.stringify(creditJson));

                                            $("#transaction-add-form").submit();
                                        });
                                    </script>

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

                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="9">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">交易日期</th>
                                            <th>記帳日</th>
                                            <th>交易內容</th>
                                            <th class="col-md-1">經手人</th>
                                            <th class="col-md-1">記帳人</th>   
                                            <th data-hide="all"></th>
                                            <th>備註</th>
                                            <th class="col-md-2">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tradeList as $trade)
                                        <tr>
                                            <td>{{date("Y-m-d", strtotime($trade->trade_at))}}</td>
                                            <td>{{date("Y-m-d", strtotime($trade->created_at))}}</td>
                                            <td>{{$trade->name}}</td>
                                            <td>{{$trade->handler}}</td>
                                            <td>{{$trade->user->userDetail->last_name . $trade->user->userDetail->first_name}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        
                                                        <div class="col-md-4">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <th class="">借方</th>
                                                                    <th class="col-md-1">金額</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($trade->diary as $diary)
                                                                    @if($diary->direction === 1)
                                                                    <tr>
                                                                        <td>{{$diary->account->name}}</td>
                                                                        <td>{{$diary->amount}}</td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <th class="">貸方</th>
                                                                    <th class="col-md-1">金額</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($trade->diary as $diary)
                                                                    @if($diary->direction === 0)
                                                                    <tr>
                                                                        <td>{{$diary->account->name}}</td>
                                                                        <td>{{$diary->amount}}</td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$trade->comment}}</td>
                                            <td>

                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-transaction">編輯</button>

                                                <div class="modal fade" id="edit-transaction">
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

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-transaction">刪除</button>

                                                <div class="modal fade" id="delete-transaction">
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
                                    @endforeach
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
