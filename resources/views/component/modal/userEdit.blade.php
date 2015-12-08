<div class="col-md-12">
    
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
            <input type="text" class="form-control" placeholder="姓" name="last_name" value="{{$user->users_detail->last_name}}">
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="名" name="first_name" value="{{$user->users_detail->first_name}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">電話號碼</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="phone" value="{{$user->users_detail->phone}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">信箱</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="email" value="{{$user->users_detail->email}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">權限</label>
        <div class="col-md-10">
            <select class="input-md form-control" name="permission">
                <option id="{{$user->nickname.'1'}}" value="1">1</option>
                <option id="{{$user->nickname.'2'}}" value="2">2</option>
                <option id="{{$user->nickname.'3'}}" value="3">3</option>
                <option id="{{$user->nickname.'4'}}" value="4">4</option>
            </select>
        </div>
        <script>
            $("{{'#'.$user->nickname.$user->permission}}").attr("selected", "selected");
        </script>
    </div>
    
</div>

