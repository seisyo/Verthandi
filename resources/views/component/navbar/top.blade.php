<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <!-- <form role="search" class="navbar-form-custom" method="post" action="#">
                <div class="form-group">
                    <input type="text" placeholder="搜尋" class="form-control" name="top-search" id="top-search">
                </div>
            </form> -->
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="{{route('index')}}">
                    <i class="fa fa-home"></i>首頁
                </a>
            </li>
            <li class="dropdown">
                    
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="true">
                        <i class="fa fa-paper-plane"></i>
                        活動列表
                    </a>
                    
                    <ul class="dropdown-menu dropdown-messages">
                        @foreach($eventList as $event)
                        <li>
                            <a href="{{route('event::main', ['id' => $event->id])}}">
                                <div class="text-center link-block">
                                    <strong>{{$event->name}}</strong>
                                </div>
                            </a>
                        </li>

                        <li class="divider"></li>
                        
                        @endforeach
                    </ul>
                </li>
            <li>
                <a href="{{route('logout')}}">
                    <i class="fa fa-sign-out"></i> 登出
                </a>
            </li>
        </ul>
    </nav>
</div>
