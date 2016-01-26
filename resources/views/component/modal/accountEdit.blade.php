<div class="col-md-12">

    <div class="form-group">
        <label class="col-md-2 control-label">科目名稱</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="name" value="{{$account->name}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">備註</label>
        <div class="col-md-10">
            <textarea class="form-control" name="comment">{{$account->comment}}</textarea>
        </div>
    </div>

    <input type="hidden" class="form-control" name="id" value="{{$account->id}}">
    <input type="hidden" class="form-control" name="parent_id" value="{{$account->parent_id}}">

</div>
