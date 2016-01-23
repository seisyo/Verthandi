@extends('component.layout', ['title' => '會計科目管理'])

{{-- Custom css section --}}
@section('custom_css')
<link rel="stylesheet" href="{{url('assets/css/plugins/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{url('assets/css/plugins/select2/select2.min.css')}}">
<link href="{{url('assets/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
@endsection

{{-- Custom js section --}}
@section('custom_js')
<script src="{{url('assets/js/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('assets/js/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{url('assets/js/custom/modal_autoopen.js')}}"></script>
<script src="{{url('assets/js/custom/modal_reset.js')}}"></script>
<script src="{{url('assets/js/plugins/footable/footable.all.min.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function(){
        
        $(".footable").footable();

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
            
            if($("#search-id").val() != ""){

                var url = "{{route('account::searchById')}}";
                setTimeout(function(){
                    DoAjax(url, {id: $("#search-id").val()},
                        function(data, textStatus, jqXHR){
                            var datas = data.content;
                            //hide all tr
                            $("tbody > tr").hide();
                            $.each(datas, function(key, value){
                                //show the selected tr
                                $("#" + value.id).show();
                            });
                        });
                });

            } else {
                $("tbody > tr").show();
            }
            
        });

        $("#parent-id").change(function(){
            $.ajax({type: 'GET',
                    url: "{{route('account::searchNextIdByParentId')}}", 
                    data: {
                        parent_id: $("#parent-id").val()
                    },
                    success: function(result){
                        $("#parentable-id").html($("#parent-id").val() + result.content);
                    }
                });
        });

        // $('#add-account').on('show.bs.modal', function () {
           
        //    $("#parent-id").select2({
        //         placeholder: "搜尋",
        //         allowClear: true
        //     });
        // });
            
    });

</script>
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
@include('component.toast')
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">

            <div class="ibox-title">
                <div class="row">

                    <div class="col-md-2">

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-account">
                            ＋新增會計科目
                        </button>

                        <div class="modal fade" id="add-account" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">新增會計科目</h4>
                                    </div>

                                    <form class="form-horizontal" method="post" action="{{route('account::add')}}">
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
                            @foreach ($accountList as $account)
                            <option value="{{$account->id}}">{{$account->id .'  '. $account->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>

                </div>          
            </div>

            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">

                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="1000">

                            <thead>
                                <tr>
                                    <th class="col-md-2">科目編號</th>
                                    <th class="">科目名稱</th>
                                    <th class="col-md-1">方向</th>
                                    <th>父科目</th>
                                    <th class="col-md-2">操作</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($accountList as $account)
                                <tr id="{{$account->parent_id . $account->id}}">
                                    
                                    @if ($account->id !== 0)
                                        <!-- print account id -->
                                        @if ($account->parent_id === 0)
                                        <td>{{(int)(str_pad($account->parent_id . $account->id, 6, '0', STR_PAD_RIGHT))}}</td>
                                        @else
                                        <td>{{(int)(str_pad($account->parent_id . $account->id, 5, '0', STR_PAD_RIGHT))}}</td>
                                        @endif
                                        <!-- print account name -->
                                        @if (strlen((int)($account->parent_id . $account->id)) === 1)
                                        <td>{{$account->name}}</td>
                                        @elseif (strlen((int)($account->parent_id . $account->id)) === 2)
                                        <td>{{'- - ' . $account->name}}</td>
                                        @elseif (strlen((int)($account->parent_id . $account->id)) === 3)
                                        <td>{{'- - - - ' . $account->name}}</td>
                                        @elseif (strlen((int)($account->parent_id . $account->id)) === 4)
                                        <td>{{'- - - - - - ' . $account->name}}</td>
                                        @elseif (strlen((int)($account->parent_id . $account->id)) === 5)
                                        <td>{{'- - - - - - - - ' . $account->name}}</td>
                                        @endif
                                        <!-- print account direction -->
                                        @if ($account->direction)
                                        <td>借</td>
                                        @else
                                        <td>貸</td>
                                        @endif
                                        <!-- print acccount's parent name -->
                                        <td>{{$account->parent_name}}</td>
                                        
                                        <td>
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{'#edit-account' . $account->parent_id . $account->id}}">
                                                編輯
                                            </button>

                                            <div class="modal fade" id="{{'edit-account' . $account->parent_id . $account->id}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h4 class="modal-title">編輯會計科目</h4>
                                                        </div>

                                                        <form class="form-horizontal" method="post" action="{{route('account::edit')}}">
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
                                                            <form method="post" action="{{route('account::delete')}}">
                                                                <input type="hidden" name="id" value="{{$account->id}}">
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
                                    @endif  
                                   
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
<script>
    modal_reset(".modal");
</script>
@endsection
