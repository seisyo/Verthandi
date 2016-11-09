<div class="col-md-12">

    <div class="form-group">
        <label class="col-md-2 control-label">暱稱＊</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="nickname" value="{{$user->nickname}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">姓名＊</label>
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="姓" name="last_name" value="{{$user->userDetail->last_name}}">
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="名" name="first_name" value="{{$user->userDetail->first_name}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">電話＊</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="phone" value="{{$user->userDetail->phone}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">信箱＊</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="email" value="{{$user->userDetail->email}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">權限＊</label>
        <div class="col-md-10">
            <select class="input-md form-control" name="permission">
                <option id="{{$user->id . '1'}}" value="1">系統管理員</option>
                <option id="{{$user->id . '2'}}" value="2">會計人員</option>
                <option id="{{$user->id . '3'}}" value="3">出納人員</option>
                <option id="{{$user->id . '4'}}" value="4">一般使用者</option>
            </select>
        </div>
        <!-- use this js to be selected the user's permission-->
        <script>
            $("{{'#'.$user->id . $user->permission}}").attr("selected", "selected");
        </script>
    </div>
    <input type="hidden" name="id" value="{{$user->id}}">
    
</div>

