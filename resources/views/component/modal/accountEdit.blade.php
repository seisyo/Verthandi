<div class="col-md-12">

    <div class="form-group">
        <label class="col-md-2 control-label">會計要素</label>
        <div class="col-md-10">
            <select class="input-sm form-control input-s-sm inline" name="group">  
                <option id="{{$account->id.'資產'}}" value="資產">資產</option>
                <option id="{{$account->id.'負債'}}" value="負債">負債</option>
                <option id="{{$account->id.'餘絀'}}" value="餘絀">餘絀</option>
                <option id="{{$account->id.'收益'}}" value="收益">收益</option>
                <option id="{{$account->id.'費損'}}" value="費損">費損</option>
            </select>
            <script>
                $("{{'#'.$account->id.$account->group}}").attr("selected", "selected");
            </script>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">會計科目編號</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="id" value="{{$account->id}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">科目名稱</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="name" value="{{$account->name}}">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">會計方向</label>
        <div class="col-md-10">
            <select class="input-sm form-control input-s-sm inline" name="direction">  
                <option id="{{$account->id.'借'}}" value="借">借</option>
                <option id="{{$account->id.'貸'}}" value="貸">貸</option>
            </select>
            <script>
                $("{{'#'.$account->id.$account->direction}}").attr("selected", "selected");
            </script>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">備註</label>
        <div class="col-md-10">
            <textarea class="form-control" name="comment">{{$account->comment}}</textarea>
        </div>
    </div>
</div>
