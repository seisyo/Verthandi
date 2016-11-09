<div class="col-md-12">
    
    <div class="col-md-12">
        <div class="form-group">
            <label>活動名稱＊</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group" id="event-date">
            <label>活動日期＊</label>
            <input type="text" class="form-control" name="event_at" value="{{old('event_at')}}"> 
            <script>
                $('#event-date input').datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    autoclose: true
                });
            </script>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>活動負責人＊</label>
            <input type="text" class="form-control" name="principal" value="{{old('principal')}}">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>活動說明</label>
            <textarea class="form-control" name="explanation">{{old('explanation')}}</textarea>
        </div>
    </div>

</div>
