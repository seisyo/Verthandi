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
            <li class="active">
                <a href="{{route('event::main')}}">
                    <i class="fa fa-paper-plane"></i>
                        <span class="nav-label">
                            {{$eventInfo->name}}
                        </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="">
                        <a href="{{route('event::diary', ['eventId' => $eventInfo->id])}}"><i class="fa fa-book"></i>日記簿</a>
                    </li>
                    <li class="">
                        <a href="{{route('event::ledger', ['eventId' => $eventInfo->id])}}"><i class="fa fa-bookmark"></i>分類帳</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>  
</nav>