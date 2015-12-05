<!DOCTYPE html>
<html>
    <head>
        @include('component.head', ['title' => '登入'])
    </head>

    <body class='gray-bg'>
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <h2>SITCON財務系統</h2>
                
                <form class="m-t" role="form" method="post" action="{{url('/login')}}">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="帳號" name="username">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="密碼" name="password">
                    </div>

                    <a href="{{url('/')}}"}}>
                        <button type="submit" class="btn btn-primary full-width">登入</button>
                    </a>
                    <a href="#"><small>忘記密碼?</small></a>
                </form>
                {{-- <p class="m-t"> <small>Project Verthandi on Inspinia&copy; 2015</small> </p> --}}
            </div>
        </div>
        
    </body>

</html>