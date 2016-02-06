<div class="col-md-12">
    
    <div class="form-group">
        <label>活動名稱＊</label>
        <input type="text" class="form-control" name="name" value="{{$event->name}}">
    </div>

    <div class="form-group" id="sandbox-container">
        <label>活動日期＊</label>
        <input type="text" class="form-control" name="event_at" value="{{date('m/d/Y', strtotime($event->event_at))}}"> 
        <script>
            $('#sandbox-container input').datepicker({});
        </script>
    </div>

    <input type="hidden" name="id" value="{{$event->id}}">

</div>

