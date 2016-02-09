@extends('component.layout', ['title' => '管理活動帳簿'])

{{-- Custom css section --}}
@section('custom_css')
<link rel="stylesheet" href="{{url('assets/css/plugins/datapicker/datepicker3.css')}}">
<link rel="stylesheet" href="{{url('assets/css/plugins/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{url('assets/css/plugins/select2/select2.min.css')}}">
@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="{{url('assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{url('assets/js/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('assets/js/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{url('assets/js/custom/modal_autoopen.js')}}"></script>
<script src="{{url('assets/js/custom/modal_reset.js')}}"></script>
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
            var url = "{{route('event::manage::searchById')}}";

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
@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
    @parent
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
<h2>管理帳簿</h2>
<li>
    <a href="{{route('index')}}">首頁</a>
</li>
<li>
    <a href="{{route('event::manage::main')}}">活動帳簿管理</a>
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

                    <div class="col-md-1">

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-event">
                            ＋新增活動帳簿
                        </button>

                        <div class="modal fade" id="add-event">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">新增帳簿</h4>
                                    </div>
                                    
                                    <form class="form-horizontal" method="post" action="{{route('event::manage::add')}}">
                                        
                                        <div class="modal-body">
                                            @if(Session::has(('errors')))
                                                @foreach(Session::get('errors')->all() as $error)
                                                    <div class="alert alert-danger">
                                                        {{$error}}
                                                    </div>
                                                    <script>
                                                        modal_autoopen("#add-event");
                                                    </script>
                                                @endforeach
                                            @endif
                                            <div class="row">
                                                @include("component.modal.eventAdd")
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                            <button type="submit" class="btn btn-primary">新增</button>
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
                            @foreach ($eventList as $event)
                            <option value="{{$event->id}}">{{$event->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>

                </div>
            </div>

            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="">活動名稱</th>
                                    <th class="col-md-2">創建日期</th>
                                    <th class="col-md-2">活動日期</th>
                                    <th class="col-md-2">活動負責人</th>
                                    <th class="col-md-2">操作</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($eventList as $event)
                                <tr id="{{$event->id}}">
                                    <!-- connect to the event main page -->
                                    <td><a href="{{url('event/' . $event->id . '/main')}}">{{$event->name}}</a></td>
                                    <td>{{date("Y-m-d", strtotime($event->created_at))}}</td>
                                    <td>{{$event->event_at}}</td>
                                    <td>{{$event->principal}}</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{'#edit-event'.$event->id}}">
                                            編輯
                                        </button>

                                        <div class="modal fade" id="{{'edit-event'.$event->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">編輯帳簿</h4>
                                                    </div>

                                                    <form class="form-horizontal" method="post" action="{{route('event::manage::edit')}}">
                                                        
                                                        <div class="modal-body">
                                                            @if(Session::has(('errors'.$event->id)))
                                                                @foreach(Session::get('errors'.$event->id)->all() as $error)
                                                                    <div class="alert alert-danger">
                                                                        {{$error}}
                                                                    </div>
                                                                    <script>
                                                                        modal_autoopen("{{'#edit-event'.$event->id}}");
                                                                    </script>
                                                                @endforeach
                                                            @endif
                                                            <div class="row">
                                                                @include("component.modal.eventEdit")
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                            <button type="submit" class="btn btn-primary">確定修改</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal end -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{'#delete-event'.$event->id}}">
                                            刪除
                                        </button>

                                        <div class="modal fade" id="{{'delete-event'.$event->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">刪除帳簿</h4>
                                                    </div>
                                                     
                                                    <div class="modal-body">
                                                        確定要刪除此活動帳簿嗎？
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <form class="form-horizontal" method="post" action="{{route('event::manage::delete')}}">
                                                            <input type="hidden" name="id" value="{{$event->id}}">
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
