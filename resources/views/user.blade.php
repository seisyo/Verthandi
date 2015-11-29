<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SITCON財務系統 | 使用者管理</title>

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
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
                                    ＋新增使用者
                                </button>
                                <div class="modal fade" id="adduser">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">新增使用者</h4>
                                            </div>
                                            <div class="modal-body">
                                                @include("component.modal_content")
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
                                        <th class="col-sm-1">序號</th>
                                        <th class="col-sm-2">帳號</th>
                                        <th class="col-sm-2">名稱</th>
                                        <th class="col-sm-1">權限</th>
                                        <th class="col-sm-2">操作</th>
                                    </tr>
                                </thead>
                                @for($i = 0; $i < 10; $i++)
                                <tbody>
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>seisyo{{$i+1}}</td>
                                        <td>seisyo-{{$i+1}}號</td>
                                        <td>1</td>
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
                                                            @include("component.modal_content")
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
    @include('component.footer')
    </div>
</body>

</html>