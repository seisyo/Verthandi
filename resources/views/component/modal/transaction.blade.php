<div class="col-md-12">
    
    <div class="row">
        <div class="col-md-12">
            
            <div class="form-group" id="sandbox-container">
                <label>交易日期</label>
                <input type="text" class="form-control" name="trade_at"> 
                <script>
                    $('#sandbox-container input').datepicker({});
                </script>
            </div> 
            
            <div class="form-group">
                <label>交易內容</label>
                <input type="text" class="form-control" name="name">
            </div>
            
            <div class="form-group">
                <label>經手人</label>
                <input type="text" class="form-control" name="handler">
            </div>
            
            <div class="form-group">
                <label>備註</label>
                <textarea class="form-control" name="comment"></textarea>
            </div>
            
        </div>
    </div>
    
    <div class="row">

        <div class="col-md-6" id="account_row_debit">
            
            <label>借方</label>
            <div class="row">
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-outline btn-default" id="debit_addbtn">
                        ＋
                    </button>
                </div>
            </div>
            <div class="row" id="debit_account1">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control account" placeholder="會計科目">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control amount" placeholder="金額">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline btn-danger" id="debit_delbtn1">
                        -
                    </button>
                </div>
            </div>
            
            <script>
                add_transaction(debit_addbtn, 'debit_delbtn', 'debit_account', account_row_debit);
                delete_transaction(account_row_debit);
            </script>
           

        </div>
        
        <div class="col-md-6" id="account_row_credit">
            
            <label>貸方</label>
            <div class="row">
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-outline btn-default" id="credit_addbtn">
                        ＋
                    </button>
                </div>
            </div>
            <div class="row" id="credit_account1">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control account" placeholder="會計科目">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control amount" placeholder="金額">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline btn-danger" id="credit_delbtn1">
                        -
                    </button>
                </div>
            </div>
            
            <script>
                add_transaction(credit_addbtn, 'credit_delbtn', 'credit_account', account_row_credit);
                delete_transaction(account_row_credit);
            </script>

        </div>
    </div>
</div>


