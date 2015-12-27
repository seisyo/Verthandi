<div class="col-md-12">

    dd($user);
    <div class="form-group">
        <label class="col-md-2 control-label">暱稱</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="nickname" value="{{$user->nickname}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">真實姓名</label>
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="姓" name="last_name" value="{{$user->userDetail->last_name}}">
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="名" name="first_name" value="{{$user->userDetail->first_name}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">電話號碼</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="phone" value="{{$user->userDetail->phone}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">信箱</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="email" value="{{$user->userDetail->email}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">權限</label>
        <div class="col-md-10">
            <select class="input-md form-control" name="permission">
                <option id="{{$user->nickname.'1'}}" value="1">系統管理員</option>
                <option id="{{$user->nickname.'2'}}" value="2">會計人員</option>
                <option id="{{$user->nickname.'3'}}" value="3">出納人員</option>
                <option id="{{$user->nickname.'4'}}" value="4">一般使用者</option>
            </select>
        </div>
        <!-- use this js to be selected the user's permission-->
        <script>
            $("{{'#'.$user->nickname.$user->permission}}").attr("selected", "selected");
        </script>
    </div>
    <input type="hidden" name="id" value="{{$user->id}}">
    
</div>

