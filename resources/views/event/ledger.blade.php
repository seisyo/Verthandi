@extends('component.layout', ['title' => $eventInfo->name])

{{-- Custom css section --}}
@section('custom_css')
<link rel="stylesheet" href="{{url('assets/css/plugins/select2/select2.min.css')}}">
@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="{{url('assets/js/plugins/select2/select2.full.min.js')}}"></script>
<script>
    var result = '{{$accountList}}';
    var accountList = $.parseJSON(result.replace(/&quot;/g, '"'));

    $(document).ready(function() {

        $("select.account").select2({
            placeholder: "會計科目",
            allowClear: true
        });

        $("select.account").change(function() {
            $.ajax({
                type: 'GET',
                url: "{{route('event::ledger/account/record/search', ['eventId' => $eventInfo->id])}}",
                data: {
                    account_id: $("select.account").val()
                },
                success: function(result){
                    var datas = $.parseJSON(result.content);
                    //remove all tr data 
                    $("tbody > tr").remove();
                    // to record the amount
                    var debitTotal = 0;
                    var creditTotal = 0;
                    var balance = 0;
                    $.each(datas, function(key, value){
                        // account_direction -> diary_direction 
                        if (Number(value.account_direction)) {
                            (Number(value.direction)) ? (debitTotal = debitTotal + Number(value.debit_value)) : (creditTotal = creditTotal + Number(value.credit_value));
                            balance = debitTotal - creditTotal;
                            $("tbody").append("<tr><td>" + value.trade_at + "</td><td>" + value.trade_name + "</td><td>" + value.debit_value + "</td><td>" + value.credit_value + "</td><td>" + balance + "</td><td>" + value.trade_comment + '</td><td><a href="{{route("event::diary", ["eventId" => $eventInfo->id])}}"><button type="button" class="btn btn-default btn-sm">編輯</button></a></td></tr>');
                        } else {
                            (Number(value.direction)) ? (debitTotal = debitTotal + Number(value.debit_value)) : (creditTotal = creditTotal + Number(value.credit_value));
                            balance = creditTotal - debitTotal;
                            $("tbody").append("<tr><td>" + value.trade_at + "</td><td>" + value.trade_name + "</td><td>" + value.debit_value + "</td><td>" + value.credit_value + "</td><td>" + balance + "</td><td>" + value.trade_comment + '</td><td><a href="{{route("event::diary", ["eventId" => $eventInfo->id])}}"><button type="button" class="btn btn-default btn-sm">編輯</button></a></td></tr>');
                        };
                        
                    });
                }
            });
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
        {{$eventInfo->name}} 分類帳
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
        <a href="{{route('event::ledger', ['eventId' => $eventInfo->id])}}">分類帳</a>
    </li>
@endsection

{{-- Content section --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox flot-e-margins">
                
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-control account" name="ledger-account">
                                <option></option>
                            </select>
                            <script>
                                $.each(accountList, function(key, value){
                                    $('select.account').append("<option value=" + value.full_id + ">" + value.full_id + " " + value.name + "</option>")
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
                                        <th class="col-md-1">交易日期</th>
                                        <th class="col-md-2">交易名稱</th>
                                        <th class="col-md-1">借方</th>
                                        <th class="col-md-1">貸方</th>
                                        <th class="col-md-1">餘額</th>
                                        <th class="col-md-2">備註</th>
                                        <th class="col-md-1">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

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