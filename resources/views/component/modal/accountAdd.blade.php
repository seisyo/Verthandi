<div class="col-md-12">
    
    <div class="form-group">
        <label class="col-md-3 control-label">父科目編號</label>
        <div class="col-md-9">
            <select class="form-control aa" name="parent_id" id="parent-id">
                <option></option>
                @foreach ($accountList as $account)
                    @if ($parentList->contains('parent_id', $account->parent_id.$account->id)))
                    <option value="{{$account->parent_id . $account->id}}">{{(int)($account->parent_id . $account->id).'  '. $account->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-3 control-label">科目編號</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="id">
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
