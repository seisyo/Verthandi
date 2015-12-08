<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">Seisyo Hsu</strong>
                            </span>
                            <span class="text-muted text-xs block">
                                財務組系統開發者
                                <b class="caret"></b>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="/logout">登出</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    S
                </div>
            </li>
            <li class="">
                <a href="/event_manage"><i class="fa fa-futbol-o"></i> <span class="nav-label">活動帳簿管理</span> </a>
            </li>
            <li class="">
                <a href="/"><i class="fa fa-area-chart"></i> <span class="nav-label">報表輸出</span> </a>
            </li>
            <li class="">
                <a href="{{url('/account')}}"><i class="fa fa-database"></i> <span class="nav-label">會計科目管理</span> </a>
            </li>
            <li class="">
                <a href="{{url('/user')}}"><i class="fa fa-child"></i> <span class="nav-label">使用者管理</span> </a>
            </li>
        </ul>
    </div>  
</nav>