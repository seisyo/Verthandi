<div class="col-md-12">
    
    <div class="col-md-12">
        <div class="form-group">
            <label>活動名稱＊</label>
            <input type="text" class="form-control" name="name" value="{{$event->name}}">
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group" id="{{'event-date' . $event->id}}">
            <label>活動日期＊</label>
            <input type="text" class="form-control" name="event_at" value="{{date('m/d/Y', strtotime($event->event_at))}}"> 
            <script>
                $("{{'#' . 'event-date' . $event->id . ' input'}}").datepicker({});
            </script>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>活動負責人＊</label>
            <input type="text" class="form-control" name="principal" value="{{$event->principal}}">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>活動說明</label>
            <textarea class="form-control" name="explanation">{{$event->explanation}}</textarea>
        </div>
    </div>

    <input type="hidden" name="id" value="{{$event->id}}">

</div>

