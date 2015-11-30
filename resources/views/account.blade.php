<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SITCON財務系統 | 會計科目管理</title>

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
    @include('component.left_navbar')
    <div id="page-wrapper" class="gray-bg">
        @include('component.top_navbar')
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="input-sm form-control input-s-sm inline">
                                        <option value="資產">資產</option>
                                        <option value="負債">負債</option>
                                        <option value="餘絀">餘絀</option>
                                        <option value="收益">收益</option>
                                        <option value="費損">費損</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group"><input type="text" placeholder="搜尋" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜尋</button> </span></div>
                                </div>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
                                    ＋新增會計科目
                                </button>
                                <div class="modal fade" id="adduser">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">新增會計科目</h4>
                                            </div>
                                            <div class="modal-body">
                                                @include("component.modal_account")
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
                                        <th class="col-sm-1">會計科目編號</th>
                                        <th class="col-sm-2">會計要素</th>
                                        <th class="col-sm-2">科目名稱</th>
                                        <th class="col-sm-1">方向</th>
                                        <th class="col-sm-2">備註</th>
                                        <th class="col-sm-2">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1001</td>
                                        <td>資產</td>
                                        <td>現金</td>
                                        <td>借</td>
                                        <td>---</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edituser">編輯</button>
                                            <div class="modal fade" id="edituser">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">編輯會計科目</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            @include("component.modal_account")
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                            <button type="button" class="btn btn-success">確定修改</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser">刪除</button>
                                            <div class="modal fade" id="deleteuser">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">刪除會計科目</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            確定要刪除此會計科目嗎？
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
        </div>
        @include('component.footer')
    </div>
</body>

</html>