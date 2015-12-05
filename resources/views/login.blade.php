<!DOCTYPE html>
<html>
    <head>
        @include('component.head', ['title' => '登入'])
    </head>

    <body class='gray-bg'>
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <h2>SITCON財務系統</h2>
                
                @if(Session::has('errors')) 
                    @foreach(Session::get('errors')->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif

                <form class="m-t" role="form" method="post" action="{{url('/login')}}">
                    <div class="form-group">
                        <input type="" class="form-control" placeholder="帳號" name="username">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="密碼" name="password">
                    </div>

                    <a href="{{url('/')}}">
                        <button type="submit" class="btn btn-primary full-width">登入</button>
                    </a>
                    <a href="#"><small>忘記密碼?</small></a>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

            </div>
        </div>
        
    </body>

</html>