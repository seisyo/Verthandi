@extends('component.layout', ['title' => '修改密碼'])

{{-- Custom css section --}}
@section('custom_css')
    <link rel="stylesheet" href="assets/css/plugins/toastr/toastr.min.css">
@endsection

{{-- Custom js section --}}
@section('custom_js')
    <script src="assets/js/plugins/toastr/toastr.min.js"></script>
@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
    @include('component.navbar.default')
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
    <h2>
        修改密碼
    </h2>
    <li>
        <a href="{{route('index', ['username' => 'admin'])}}">首頁</a>
    </li>
    <li>
        <a href="{{route('password::main')}}">修改密碼</a>
    </li>
@endsection

{{-- Content section --}}
@section('content')
    @include('component.toast', ['type' => 'success'])
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-emargins">

                <div class="ibox-title">
                    @if(Session::has('errors')) 
                        @foreach(Session::get('errors')->all() as $error)
                            <div class="alert alert-danger">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif
                    @if(Session::has('message'))
                        <div class="alert alert-danger">
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <h3>請依序輸入舊密碼、新密碼、確認新密碼</h3>
                        </div>
                    </div>
                </div>
                
                <form class="form-horizontal" method="get" action="{{route('password::edit')}}">
                    
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="col-md-1 control-label">舊密碼</label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="old_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1 control-label">新密碼</label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" placeholder="須至少8碼" name="new_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1 control-label">請再輸入一次</label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" placeholder="須至少8碼" name="new_password_confirmation">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="ibox-footer">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="col-md-2 col-md-offset-4">
                                    <div class="form-group">
                                        <a href="{{route('index')}}">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                        </a>
                                        <a href="">
                                            <button type="submit" class="btn btn-primary">確定修改</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection