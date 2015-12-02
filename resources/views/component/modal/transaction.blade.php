<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">

            <div class="form-group" id="sandbox-container">
                <label>日期</label>
                <input type="text" class="form-control"> 
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
        <script>
            var debit_count = 1;
            var credit_count = 1;
        </script>

        <div class="col-md-6" id="account_row_debit">
            
            <label>借方</label>

            <div class="row">
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline btn-default" id="addbtn1">
                        ＋
                    </button>
                </div>
            </div>

            <div class="row" id="account1">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="會計科目">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" placeholder="金額">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline btn-danger" id="delbtn1">
                        -
                    </button>
                </div>
            </div>
            
            <script>
            $('#addbtn1').click(function(){
                $('#account_row_debit').append('<div class="row" id="account"><div class="form-group col-md-6"><input type="text" class="form-control" placeholder="會計科目"></div><div class="form-group col-md-4"><input type="text" class="form-control" placeholder="金額"></div><div class="col-md-2"><button type="button" class="btn btn-outline btn-danger" id="delbtn1">-</button></div></div>');
                debit_count = debit_count + 1;
                $('#account').attr("id", "account"+debit_count);
            });
            $('delbtn1').click(function(){
                $('.row').remove();
                debit_count = debit_count - 1;
            });
            </script>

        </div>
        <div class="col-md-6" id="account_row_credit">

            <label>貸方</label>
            
            <div class="row">
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline btn-default" id="addbtn2">
                        ＋
                    </button>
                </div>
            </div>
            
            <div class="row" id="account1">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="會計科目">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" placeholder="金額">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline btn-danger" id="delbtn2">
                        -
                    </button>
                </div>
            </div>
            
            <script>
            $('#addbtn2').click(function(){
                $('#account_row_credit').append('<div class="row" id="account"><div class="form-group col-md-6"><input type="text" class="form-control" placeholder="會計科目"></div><div class="form-group col-md-4"><input type="text" class="form-control" placeholder="金額"></div><div class="col-md-2"><button type="button" class="btn btn-outline btn-danger" id="delbtn2">-</button></div></div>');
                credit_count = credit_count + 1;
                $('#account').attr("id", "account"+credit_count);
            });
            $('delbtn2').click(function(){
                $(".row").remove();
            });
            </script>

        </div>
    </div>
</div>


