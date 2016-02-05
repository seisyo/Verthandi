@extends('component.layout', ['title' => $eventInfo->name])

{{-- Custom css section --}}
@section('custom_css')
<link href="{{url('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{url('assets/css/plugins/toastr/toastr.min.css')}}">
<link href="{{url('assets/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{url('assets/css/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{url('assets/css/plugins/dropzone/basic.css')}}">
<link rel="stylesheet" href="{{url('assets/css/plugins/dropzone/dropzone.css')}}">
<style>
    .modal.modal-wide .modal-dialog {
        width: 60%;
    }
    .select2-container {
        width: 100% !important;
        height:100%;
        padding: 0;
        z-index: 2098;
    }
    .select2-close-mask{
        z-index: 2099;
    }
    .select2-dropdown{
        z-index: 3051;
    }
    #search-div > .select2-container {
        z-index: 2;
    }
</style>
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
<script src="{{url('assets/js/plugins/dropzone/dropzone.js')}}"></script>
<script>
    
    var result = '{{$accountList}}';
    var accountList = $.parseJSON(result.replace(/&quot;/g, '"'));

    $(document).ready(function() {
        
        $(".footable").footable();

        $("#search-id").select2({
            placeholder: "搜尋",
            allowClear: true
        });

        $("#search-id").change(function() {
            if ($("#search-id").val() != "") {  
                // let all <tr> hide 
                $("tbody > tr").hide();
                // show the selected tr
                $("#" + $("#search-id").val()).show();
            } else {
                $("tbody > tr").show();
            }
        });

        $("#add-transaction").on('show.bs.modal', function(){
            
            $("select.account").select2({
                placeholder: "會計科目",
                allowClear: true
            });
            $("select.account").focus();
        });

        $("[id^=edit-transaction]").on('show.bs.modal', function(){

            $("select.account").select2({
                placeholder: "會計科目",
                allowClear: true
            });
            $("select.account").focus();
        });

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
    <a href="{{route('event::main', ['eventId' => $eventInfo->id])}}">{{$eventInfo->name}}</a>
</li>
<li>
    <a href="{{route('event::diary', ['eventId' => $eventInfo->id])}}">日記簿</a>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-transaction">
                            ＋新增交易分錄
                        </button>
                        <div class="modal fade modal-wide" id="add-transaction">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">新增交易分錄</h4>
                                    </div>
                                    
                                    <form class="form-horizontal" method="post" action="{{route('event::diary/add', ['id' => $eventInfo->id])}}" id="transaction-add-form" enctype="multipart/form-data">
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
                                                @include('component.modal.transactionAdd')
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
                                            $("#add_account_row_debit>div[id*='debit_account']").each(function(){
                                                debitJson[count] = {
                                                    "account" : $(this).find(".account").val(),
                                                    "amount" : $(this).find(".amount").val()
                                                };
                                                count++;
                                            });

                                            count = 0;
                                            $("#add_account_row_credit>div[id*='credit_account']").each(function(){
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

                    <div class="col-md-4 pull-right" id="search-div">
                        <select class="form-control" id="search-id">
                            <option></option>
                            @foreach($tradeList as $trade)
                                <option value="{{$trade->id}}">{{date("Y-m-d", strtotime($trade->trade_at)) . ' ' . $trade->name}}</option>
                            @endforeach
                        </select>
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
                                            <th data-toggle="true" class="col-md-2">交易日</th>
                                            <th>交易內容</th>
                                            <th class="col-md-1">經手人</th>
                                            <th class="col-md-1">記帳人</th>
                                            <th class="col-md-2">記帳日</th>
                                            <th class="col-md-2">操作</th>
                                            <th data-hide="all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tradeList as $trade)
                                        <tr id="{{$trade->id}}">
                                            <td>{{date("Y-m-d", strtotime($trade->trade_at))}}</td>
                                            <td>{{$trade->name}}</td>
                                            <td>{{$trade->handler}}</td>
                                            <td>{{$trade->user->userDetail->last_name . $trade->user->userDetail->first_name}}</td>
                                            <td>{{date("Y-m-d", strtotime($trade->created_at))}}</td>
                                            <td>

                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{'#edit-transaction' . $trade->id}}">
                                                    編輯
                                                </button>

                                                <div class="modal modal-wide fade" id="{{'edit-transaction' . $trade->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">編輯交易分錄</h4>
                                                            </div>

                                                            <form class="form-horizontal" method="post" action="{{route('event::diary/edit', ['id' => $eventInfo->id])}}" id="{{'transaction-edit-form' . $trade->id}}" enctype="multipart/form-data">
                                                                
                                                                <div class="modal-body">
                                                                    @if(Session::has(('errors' . $trade->id)))
                                                                    @foreach(Session::get('errors' . $trade->id)->all() as $error)
                                                                    <div class="alert alert-danger">
                                                                        {{$error}}
                                                                    </div>
                                                                    <!-- when it has error, reload the page will auto open the modal -->
                                                                    <script>
                                                                        modal_autoopen("{{'#edit-transaction' . $trade->id}}");
                                                                    </script>
                                                                    @endforeach
                                                                    @endif
                                                                    <div class="row">
                                                                        @include('component.modal.transactionEdit')
                                                                        <input type="hidden" id="{{'debit_array' . $trade->id}}" name="debit_array">
                                                                        <input type="hidden" id="{{'credit_array' . $trade->id}}" name="credit_array">
                                                                        <input type="hidden" name="trade_id" value="{{$trade->id}}">
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                                    <button type="button" class="btn btn-primary" id="{{'edit-button' . $trade->id}}">確定修改</button>
                                                                </div>

                                                            </form>
                                                            <script>
                                                                var debitJson = {};
                                                                var creditJson = {};
                                                                $("{{'#edit-button' . $trade->id}}").click(function(){
                                                                    
                                                                    var count = 0;
                                                                    $("{{'#edit_account_row_debit' . $trade->id}}>div[id*='debit_account']").each(function(){
                                                                        debitJson[count] = {
                                                                            "account" : $(this).find(".account").val(),
                                                                            "amount" : $(this).find(".amount").val()
                                                                        };
                                                                        count++;
                                                                    });

                                                                    count = 0;
                                                                    $("{{'#edit_account_row_credit' . $trade->id}}>div[id*='credit_account']").each(function(){
                                                                        creditJson[count] = {
                                                                            "account" : $(this).find(".account").val(),
                                                                            "amount" : $(this).find(".amount").val()
                                                                        };
                                                                        count++;
                                                                    });

                                                                    $("{{'#debit_array' . $trade->id}}").val(JSON.stringify(debitJson));
                                                                    $("{{'#credit_array' . $trade->id}}").val(JSON.stringify(creditJson));

                                                                    $("{{'#transaction-edit-form' . $trade->id}}").submit();
                                                                });
                                                            </script>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal end -->

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{'#delete-transaction' . $trade->id}}">
                                                    刪除
                                                </button>

                                                <div class="modal fade" id="{{'delete-transaction' . $trade->id}}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">刪除交易分錄</h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                確定要刪除交易分錄「{{$trade->name}}」嗎？
                                                            </div>

                                                            <div class="modal-footer">
                                                                
                                                                <form class="form-horizontal" method="post" action="{{route('event::diary/delete', ['id' => $eventInfo->id])}}">
                                                                    <input type="hidden" name="trade_id" value="{{$trade->id}}">
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
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    
                                                    <div class="col-md-4">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <th class="col-md-1">編號</th>
                                                                <th class="col-md-2">借方</th>
                                                                <th class="col-md-1">金額</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($trade->diary as $diary)
                                                                @if($diary->direction === "1" || $diary->direction === 1)
                                                                <tr>
                                                                    <td>{{$diary->account->fullId}}</td>
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
                                                                <th class="col-md-1">編號</th>
                                                                <th class="col-md-2">貸方</th>
                                                                <th class="col-md-1">金額</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($trade->diary as $diary)
                                                                @if($diary->direction === "0" || $diary->direction === 0)
                                                                <tr>
                                                                    <td>{{$diary->account->fullId}}</td>
                                                                    <td>{{$diary->account->name}}</td>
                                                                    <td>{{$diary->amount}}</td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <ul>
                                                            @foreach($fileLinkList as $fileLink)
                                                            @if($fileLink->trade_id === $trade->id)
                                                                <li>
                                                                    <a href="{{route('event::diary/file/downloader', ['fileName' => $fileLink->file_name])}}" target="_blank">
                                                                        {{$fileLink->file_name}}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        @endforeach
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
<script>
    modal_reset(".modal");
</script>
@endsection
