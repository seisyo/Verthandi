function delete_transaction(delete_place_parent, count){
    
    $(delete_place_parent).on('click', '.btn-danger', function(){
        
        $(this).parent().parent().remove();
    });
}

// $('#account_row_debit').on('click', '.btn-danger',function(){
//               $(this).parent().parent().remove();
//               credit_count = credit_count - 1;
//             });