@extends('component.layout', ['title' => $eventInfo->name])

{{-- Custom css section --}}
@section('custom_css')
@endsection

{{-- Custom js section --}}
@section('custom_js')

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
        <a href="{{url('event/' . $eventInfo->id . '/ledger')}}">{{$eventInfo->name}}</a>
    </li>
    <li>
        <a href="{{url('event/' . $eventInfo->id . '/ledger')}}">分類帳</a>
    </li>
@endsection

{{-- Content section --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox flot-e-margins">
                
                <div class="ibox-title">
                    <div class="row">
                        
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="資產">資產</option>
                                <option value="負債">負債</option>
                                <option value="餘絀">餘絀</option>
                                <option value="收益">收益</option>
                                <option value="費損">費損</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="現金">現金</option>
                                <option value="文具用品">文具用品</option>
                                <option value="手續費">手續費</option>
                                <option value="其他應付款">其他應付款</option>
                                <option value="短期借款">短期借款</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" placeholder="搜尋" class="input-sm form-control">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary"> 搜尋</button> 
                                </span>
                            </div>
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
                                        <th class="col-md-1">方向</th>
                                        <th class="col-md-1">餘額</th>
                                        <th class="col-md-2">備註</th>
                                        <th class="col-md-1">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2015-11-29</td>
                                        <td>行銷組購買文具</td>
                                        <td>0</td>
                                        <td>800</td>
                                        <td>貸</td>
                                        <td>800</td>
                                        <td>---</td>
                                        <td>
                                            
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edituser">
                                                編輯
                                            </button>
                                            
                                            <div class="modal fade" id="edituser">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">編輯交易分錄</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                @include("component.modal.transaction")
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                            <button type="button" class="btn btn-success">確定修改</button>
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