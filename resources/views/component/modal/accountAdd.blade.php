<div class="col-md-12">
    
    <div class="form-group">
        <label class="col-md-3 control-label">父科目編號</label>
        <div class="col-md-9">
            <select class="form-control aa" name="parent_id" id="parent-id">
                <option></option>
                @foreach ($parentList as $account)
                    <option value="{{$account->parentable_id}}">{{str_pad($account->parentable_id, 5, 0, STR_PAD_RIGHT) . '  ' . $account->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-3 control-label">科目編號</label>
        <div class="col-md-9">
            <h3 id="parentable-id"></h3>   
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-3 control-label">科目名稱</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="name">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-3 control-label">會計方向</label>
        <div class="col-md-9">
            <select class="input-sm form-control input-s-sm inline" name="direction">  
                <option value="1">借</option>
                <option value="0">貸</option>
            </select>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-3 control-label">備註</label>
        <div class="col-md-9">
            <textarea class="form-control" name="comment"></textarea>
        </div>
    </div>
</div>
