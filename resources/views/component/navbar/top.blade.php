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
                <a href="/">
                    <i class="fa fa-home"></i>首頁
                </a>
            </li>
            <li class="dropdown">
                    
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="true">
                        <i class="fa fa-paper-plane"></i>
                        活動列表
                    </a>
                    
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box link-block">
                                <div class="media-body text-center">
                                    <a href="{{url('/event')}}">
                                        <strong>SITCON 2016</strong>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box link-block">
                                <div class="media-body text-center">
                                    <a href="{{url('/event')}}">
                                        <strong>hackgen 2015</strong>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box link-block">
                                <div class="media-body text-center">
                                    <a href="{{url('/event')}}">
                                        <strong>SITCON 2015</strong>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="{{url('/event_manage')}}">
                                    <i class="fa fa-paper-plane"></i> <strong>新增活動帳簿</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            <li>
                <a href="/login">
                    <i class="fa fa-sign-out"></i> 登出
                </a>
            </li>
        </ul>
    </nav>
</div>
