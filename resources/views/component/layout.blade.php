<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SITCON財務系統 | @yield('title')</title>

    <link href="{{url('assets/css/all.css')}}" rel="stylesheet">
    <link href="{{url('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    @yield('custom_css')

    <!-- Mainly scripts -->
    <script src="{{url('assets/js/all.js')}}"></script>
    <script src="{{url('assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/pace/pace.min.js')}}"></script>

    <!-- Custom and plugin javascript -->
    @yield('custom_js')

</head>

<body class="pace-done">
    @section('sidebar')
        @include('component.navbar.default')
    @show

    <div id="page-wrapper" class="gray-bg">
        @include('component.navbar.top')
        @include('component.footer')
    </div>
</body>


</html>