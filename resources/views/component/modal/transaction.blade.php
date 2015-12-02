<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" id="sandbox-container">
                <label>日期</label>
                <input type="text" class="form-control"> 
                <!-- <input type="text" class="form-control"> -->
                <script>
                    $('#sandbox-container input').datepicker({});
                </script>
            </div>
            <div class="form-group">
                <label>交易內容</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>備註</label>
                <textarea class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            
            <label>借方</label>
            
            <div class="row">
                <div class="form-group col-md-8">
                    <input type="text" class="form-control" placeholder="會計科目1">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" placeholder="金額">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-8">
                    <input type="text" class="form-control" placeholder="會計科目2">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" placeholder="金額">
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline btn-default">
                        ＋
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label>貸方</label>
            <div class="row">
                <div class="form-group col-md-8">
                    <input type="text" class="form-control" placeholder="會計科目1">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" placeholder="金額">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-8">
                    <input type="text" class="form-control" placeholder="會計科目2">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" placeholder="金額">
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline btn-default">
                        ＋
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
