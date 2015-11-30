<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SITCON財務系統 | SITCON2016</title>

    <link href="css/all.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">  
    <!-- Mainly scripts -->
    <script src="js/all.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="js/plugins/pace/pace.min.js"></script>

</head>

<body class="pace-done">
    @include('component.event_left_navbar')
    <div id="page-wrapper" class="gray-bg">
        @include('component.top_navbar')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-md-12 pagination-centered">
                <ol class="breadcrumb">
                    <h2></h2>
                    <!-- 不知道怎讓上下至中＠＠ -->
                    <li>
                        <a href="index.html">首頁</a>
                    </li>
                    <li>
                        <a>活動帳簿</a>
                    </li>
                    <li>
                        <a>SITCON2016</a>
                    </li>
                    <li>
                        <a>日記簿</a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="">
                            <!-- ？？不知道為什麼有row和沒row邊際有差 -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
                                ＋新增交易分錄
                            </button>

                            <div class="modal fade" id="adduser">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">新增交易分錄</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                @include('component.modal_trans')
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                            <button type="button" class="btn btn-primary">新增</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-sm-1">日期</th>
                                    <th class="col-sm-2">交易內容</th>
                                    <th class="col-sm-1">金額</th>
                                    <th class="col-sm-2">備註</th>
                                    <th class="col-sm-2">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2015-11-29</td>
                                    <td>財務組買水</td>
                                    <td>100</td>
                                    <td>---</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewtrans">預覽</button>
                                        <div class="modal fade" id="viewtrans">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">預覽交易分錄</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary">確認</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edittrans">編輯</button>
                                        
                                        <div class="modal fade" id="edittrans">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">編輯交易分錄</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- @include("component.modal_account") -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                        <button type="button" class="btn btn-success">確定修改</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal end -->


                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletetrans">刪除</button>
                                        <div class="modal fade" id="deletetrans">
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
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>       
                </div>
            </div>
        </div>
        @include('component.footer')
    </div>
</body>
</html>