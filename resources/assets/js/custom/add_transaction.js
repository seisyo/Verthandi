function add_transaction(addbtn_name, delbtn_name, account_type, input_place, count){
    
    //var count = 1;

    $(addbtn_name).click(function(){

        $(input_place).append('<div class="row" id="' + account_type + count +'"><div class="form-group col-md-6"><select class="form-control account"><option></option></select><script>$.each(accountList, function(key, value){$("div#' + account_type + count + '> div.col-md-6 > select.account").append("<option value=" + value.full_id + ">" + value.name + "</option>")});</script></div><div class="form-group col-md-5"><input type="text" class="form-control amount" placeholder="金額"></div><div class="col-md-1"><button type="button" class="btn btn-outline btn-danger" id="' + delbtn_name + count + '">-</button></div></div>');

        $('#' + account_type).attr("id", account_type + count);
        $('#' + delbtn_name).attr("id", delbtn_name + count);

        count = count + 1; 
    });

    return count;
}

// $('#debit_addbtn').click(function(){
//                 $('#account_row_debit').append('<div class="row" id="debit_account"><div class="form-group col-md-6"><input type="text" class="form-control" placeholder="會計科目"></div><div class="form-group col-md-4"><input type="text" class="form-control" placeholder="金額"></div><div class="col-md-2"><button type="button" class="btn btn-outline btn-danger" id="debit_delbtn">-</button></div></div>');
//                 debit_count = debit_count + 1;
//                 $('#debit_account').attr("id", "debit_account"+debit_count);
//                 $('#debit_delbtn').attr("id", "debit_account"+debit_count);
//             });