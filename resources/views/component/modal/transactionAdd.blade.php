<div class="col-md-12">
    
    <div class="row">
        <div class="col-md-12">
            
            <div class="col-md-12">
                <div class="form-group" id="sandbox-container">
                    <label>交易日期＊</label>
                    <input type="text" class="form-control" name="trade_at" value="{{old('trade_at')}}"> 
                    <script>
                        $('#sandbox-container input').datepicker({
                            format: 'yyyy-mm-dd',
                            todayHighlight: true,
                            autoclose: true
                        });
                    </script>
                </div> 
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>交易內容＊</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>經手人員</label>
                    <input type="text" class="form-control" name="handler" value="{{old('handler')}}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>備註</label>
                    <textarea class="form-control" name="comment">{{old('comment')}}</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>新增檔案（jpeg, png, jpg, pdf）</label>
                    <input type="file" name="diary_attached_files[]" id="diary_attached_files" multiple>
                </div>
            </div>
    
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            
            <div class="col-md-6" id="add_account_row_debit">
                <div class="row">
                    <label>借方＊</label>
                </div>
                <div class="row">
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-outline btn-default" id="debit_addbtn">
                            ＋
                        </button>
                    </div>
                </div>

                <div class="row" id="debit_account1">
                    <div class="form-group col-md-6">
                        <select class="form-control account">
                            <option></option>
                        </select>
                        <script>
                            $.each(accountList, function(key, value){
                                $('div#debit_account1 > div.col-md-6 > select.account').append("<option value=" + value.full_id + ">" + value.full_id + " " + value.name + "</option>")
                            });
                        </script>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control amount" placeholder="金額">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline btn-danger" id="debit_delbtn1">
                            -
                        </button>
                    </div>
                </div>
                <script>
                    var debitCount = 2;
                    debitCount =  add_transaction(debit_addbtn, 'debit_delbtn', 'debit_account', add_account_row_debit, debitCount);
                    delete_transaction(add_account_row_debit);
                </script>
            </div>
            
            <div class="col-md-6" id="add_account_row_credit"> 
                <div class="row">
                    <label>貸方＊</label>
                </div>
                <div class="row">
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-outline btn-default" id="credit_addbtn">
                            ＋
                        </button>
                    </div>
                </div>
                <div class="row" id="credit_account1">
                    <div class="form-group col-md-6">
                        <select class="form-control account">
                            <option></option>
                        </select>
                        <script>
                            $.each(accountList, function(key, value){
                                $('div#credit_account1 > div.col-md-6 > select.account').append("<option value=" + value.full_id + ">" + value.full_id + " " + value.name + "</option>");
                            });
                        </script>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control amount" placeholder="金額">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline btn-danger" id="credit_delbtn1">
                            -
                        </button>
                    </div>
                </div>
                <script>
                    var creditCount = 2;
                    creditCount = add_transaction(credit_addbtn, 'credit_delbtn', 'credit_account', add_account_row_credit, creditCount);
                    delete_transaction(add_account_row_credit);
                </script>
            </div>

        </div>

    </div>
</div>


