function add_transaction(addbtn_name, delbtn_name, account_type, input_place, count){
    
    var count = 1;

    $(addbtn_name).click(function(){
        
        $(input_place).append('<div class="row" id="' + account_type + '"><div class="form-group col-md-6"><input type="text" class="form-control" placeholder="會計科目"></div><div class="form-group col-md-4"><input type="text" class="form-control" placeholder="金額"></div><div class="col-md-2"><button type="button" class="btn btn-outline btn-danger" id="' + delbtn_name + '">-</button></div></div>');
        
        count = count + 1;

        $('#' + account_type).attr("id", account_type + count);
        $('#' + delbtn_name).attr("id", delbtn_name + count); 
    });

    return count;
}

// $('#debit_addbtn').click(function(){
//                 $('#account_row_debit').append('<div class="row" id="debit_account"><div class="form-group col-md-6"><input type="text" class="form-control" placeholder="會計科目"></div><div class="form-group col-md-4"><input type="text" class="form-control" placeholder="金額"></div><div class="col-md-2"><button type="button" class="btn btn-outline btn-danger" id="debit_delbtn">-</button></div></div>');
//                 debit_count = debit_count + 1;
//                 $('#debit_account').attr("id", "debit_account"+debit_count);
//                 $('#debit_delbtn').attr("id", "debit_account"+debit_count);
//             });