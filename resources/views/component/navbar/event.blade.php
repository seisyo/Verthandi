<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{Session::get('user')}}</strong>
                            </span>
                            <span class="text-muted text-xs block">財務組系統開發者<b class="caret"></b>
                            </span> 
                        </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{route('password::main')}}">修改密碼</a></li>
                        <li><a href="{{route('logout')}}">登出</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    S
                </div>
            </li>
            <li class="active">
                <a href="{{route('event::main')}}">
                    <i class="fa fa-paper-plane"></i>
                    <span class="nav-label">
                        <!-- <i class="fa fa-paper-plane"></i> -->
                        SITCON 2016
                    </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="">
                        <a href="{{route('event::diary')}}"><span class="nav-label"><i class="fa fa-book"></i>日記簿</span> </a>
                    </li>
                    <li class="">
                        <a href="{{route('event::ledger')}}"><span class="nav-label"><i class="fa fa-bookmark"></i>分類帳</span> </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>  
</nav>