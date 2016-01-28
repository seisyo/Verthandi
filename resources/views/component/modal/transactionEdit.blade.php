<div class="col-md-12">
    
    <div class="row">
        <div class="col-md-12">
            
            <div class="col-md-12">
                <div class="form-group" id="sandbox-container">
                    <label>交易日期</label>
                    <input type="text" class="form-control" name="trade_at" value="{{date('m/d/Y', strtotime($trade->trade_at))}}"> 
                    <script>
                        $('#sandbox-container input').datepicker({});
                    </script>
                </div> 
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>交易內容</label>
                    <input type="text" class="form-control" name="name" value="{{$trade->name}}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>經手人</label>
                    <input type="text" class="form-control" name="handler" value="{{$trade->handler}}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>備註</label>
                    <textarea class="form-control" name="comment">{{$trade->comment}}</textarea>
                </div>
            </div>
    
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            
            <div class="col-md-6" id="{{'edit_account_row_debit' . $trade->id}}">
                
                <div class="row">
                    <label>借方</label>
                </div>

                <div class="row">
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-outline btn-default" id="{{'debit_addbtn' . $trade->id}}">
                            ＋
                        </button>
                    </div>
                </div>

                <script>
                    var count = 1;
                </script>

                @foreach($trade->diary as $diary)
                @if($diary->direction === 1)
                
                <div class="row" id="debit_account">
                    <div class="form-group col-md-6">
                        <select class="form-control account">
                            <option></option>
                            
                        </select>
                        <script>
                            $.each(accountList, function(key, value){
                                $("{{'div#edit_account_row_debit' . $trade->id}} > div#debit_account > div.col-md-6 > select.account").append("<option value=" + value.full_id + " class=" + value.full_id + ">" + value.full_id + " " + value.name + "</option>");
                            });
                        </script>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control amount" placeholder="金額" value="{{$diary->amount}}">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline btn-danger" id="debit_delbtn">
                            -
                        </button>
                    </div>
                </div>

                <script>
                    $('#debit_account').attr("id", "debit_account" + count);
                    $('#debit_delbtn').attr("id", "debit_delbtn" + count);
                    $("{{'div#edit_account_row_debit' . $trade->id}} > div#debit_account" + count + " > div.col-md-6 > select.account > option.{{$diary->account->fullId}}").attr("selected", "selected");
                    count = count + 1;
                </script>
                @endif
                @endforeach
                
                <script>
                    add_transaction({{'debit_addbtn' . $trade->id}}, 'debit_delbtn', 'debit_account', {{'edit_account_row_debit' . $trade->id}}, count);
                    delete_transaction({{'edit_account_row_debit' . $trade->id}});
                </script>
            </div>
            
            <div class="col-md-6" id="{{'edit_account_row_credit' . $trade->id}}">
                
                <div class="row">
                    <label>貸方</label>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-outline btn-default" id="{{'credit_addbtn' . $trade->id}}">
                            ＋
                        </button>
                    </div>
                </div>

                <script>
                    var count = 1;
                </script>
                
                @foreach($trade->diary as $diary)
                @if($diary->direction === 0)

                <div class="row" id="credit_account">
                    <div class="form-group col-md-6">
                        <select class="form-control account">
                            <option></option>
                        </select>
                        <script>
                            $.each(accountList, function(key, value){
                                $("{{'div#edit_account_row_credit' . $trade->id}} > div#credit_account > div.col-md-6 > select.account").append("<option value=" + value.full_id + " class=" + value.full_id + ">" + value.full_id + " " + value.name + "</option>");
                            });
                        </script>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control amount" placeholder="金額" value="{{$diary->amount}}">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline btn-danger" id="credit_delbtn">
                            -
                        </button>
                    </div>
                </div>

                <script>
                    $('#credit_account').attr("id", "credit_account" + count);
                    $('#credit_delbtn').attr("id", "credit_delbtn" + count);
                    $("{{'div#edit_account_row_credit' . $trade->id}} > div#credit_account" + count + " > div.col-md-6 > select.account > option.{{$diary->account->fullId}}").attr("selected", "selected");
                    count = count + 1;
                </script>
                @endif
                @endforeach

                <script>
                    add_transaction({{'credit_addbtn' . $trade->id}}, 'credit_delbtn', 'credit_account', {{'edit_account_row_credit' . $trade->id}}, count);
                    delete_transaction({{'edit_account_row_credit' . $trade->id}});
                </script>
            </div>

        </div>

    </div>
</div>


