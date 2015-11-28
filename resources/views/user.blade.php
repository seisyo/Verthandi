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
                                <a onclick="fnClickAddRow();" href="javascript:void(0);" class="btn btn-primary ">新增使用者</a>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>序號</th>
                                        <th>帳號</th>
                                        <th>名稱</th>
                                        <th>權限</th>
                                        <th>操作</th>
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
                                                <button type="button" class="btn btn-w-m btn-default btn-sm">編輯</button>
                                                <button type="button" class="btn btn-w-m btn-danger btn-sm">刪除</button>
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