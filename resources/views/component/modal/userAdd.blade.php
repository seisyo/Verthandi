<div class="col-md-12">

    <div class="form-group">
        <label class="col-md-2 control-label">帳號＊</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="username" value="{{old('username')}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">暱稱＊</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="nickname" value="{{old('nickname')}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">姓名＊</label>
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="姓" name="last_name" value="{{old('last_name')}}">
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="名" name="first_name" value="{{old('first_name')}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">電話＊</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">信箱＊</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="email" value="{{old('email')}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">權限＊</label>
        <div class="col-md-10">
            <select class="input-md form-control" name="permission">
                <option value="1">系統管理員</option>
                <option value="2">會計人員</option>
                <option value="3">出納人員</option>
                <option value="4">一般使用者</option>
            </select>
        </div>
    </div>
    
</div>

