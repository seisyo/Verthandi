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

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Title</h2>
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        
        <div class="wrapper wrapper-content animated fadeInRight">
            @yield('content')    
        </div>
        
        @include('component.footer')
    </div>
</body>


</html>