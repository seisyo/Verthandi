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
                    <button type="button" class="btn btn-outline btn-default" id="debit_addbtn">
                        ＋
                    </button>
                </div>
            </div>

            <div class="row" id="debit_account1">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="會計科目">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" placeholder="金額">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline btn-danger" id="debit_delbtn1">
                        -
                    </button>
                </div>
            </div>
            
            <script>
            $('#debit_addbtn').click(function(){
                $('#account_row_debit').append('<div class="row" id="debit_account"><div class="form-group col-md-6"><input type="text" class="form-control" placeholder="會計科目"></div><div class="form-group col-md-4"><input type="text" class="form-control" placeholder="金額"></div><div class="col-md-2"><button type="button" class="btn btn-outline btn-danger" id="debit_delbtn">-</button></div></div>');
                debit_count = debit_count + 1;
                $('#debit_account').attr("id", "debit_account"+debit_count);
                $('#debit_delbtn').attr("id", "debit_account"+debit_count);
            });
            $('[id^=debit_delbtn]').on("click", function(){
              $(this).parent().parent().remove();
              credit_count = credit_count - 1;
            });
            </script>

        </div>
        <div class="col-md-6" id="account_row_credit">

            <label>貸方</label>
            
            <div class="row">
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline btn-default" id="credit_addbtn">
                        ＋
                    </button>
                </div>
            </div>
            
            <div class="row" id="credit_account1">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="會計科目">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" placeholder="金額">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline btn-danger" id="credit_delbtn1">
                        -
                    </button>
                </div>
            </div>
            
            <script>
            $('#credit_addbtn').click(function(){
                $('#account_row_credit').append('<div class="row"><div class="form-group col-md-6"><input type="text" class="form-control" placeholder="會計科目"></div><div class="form-group col-md-4"><input type="text" class="form-control" placeholder="金額"></div><div class="col-md-2"><button type="button" class="btn btn-outline btn-danger" id="credit_delbtn">-</button></div></div>');
                credit_count = credit_count + 1;
                $('#credit_account').attr("id", "credit_account"+credit_count);
                $('#credit_delbtn').attr("id", "credit_delbtn"+credit_count);
            });
            $('[id^=credit_delbtn]').on("click",function(){
                $(this).parent().parent().remove();
                credit_count = credit_count - 1;
            });
            $(this)
            </script>

        </div>
    </div>
</div>


