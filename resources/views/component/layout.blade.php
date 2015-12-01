<!DOCTYPE html>
<html>

<head>
    @include('component.head', ['title' => $title])
</head>

<body class="pace-done">
    @section('sidebar')
        @include('component.navbar.default')
    @show

    <div id="page-wrapper" class="gray-bg">
        @include('component.navbar.top')
        
        <div class="wrapper wrapper-content animated fadeInRight">
            @yield('content')    
        </div>
        
        @include('component.footer')
    </div>
</body>


</html>