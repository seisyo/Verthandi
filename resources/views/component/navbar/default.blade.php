<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{Session::get('user')->username}}</strong>
                            </span>
                            <span class="text-muted">
                                @include('component.permission', ['from' => Session::get('user')->permission])
                                <b class="caret"></b>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{route('index')}}">編輯帳號</a></li>
                        <li><a href="{{route('password::main')}}">修改密碼</a></li>
                        <li><a href="{{route('logout')}}">登出</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    S
                </div>
            </li>
            <li class="">
                <a href="{{route('event::manage')}}"><i class="fa fa-futbol-o"></i> <span class="nav-label">活動帳簿管理</span> </a>
            </li>
            <li class="">
                <a href="{{route('index')}}"><i class="fa fa-area-chart"></i> <span class="nav-label">報表輸出</span> </a>
            </li>
            <li class="">
                <a href="{{route('account::main')}}"><i class="fa fa-database"></i> <span class="nav-label">會計科目管理</span> </a>
            </li>
            <li class="">
                <a href="{{route('user::main')}}"><i class="fa fa-child"></i> <span class="nav-label">使用者管理</span> </a>
            </li>
        </ul>
    </div>  
</nav>