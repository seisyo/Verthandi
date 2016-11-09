function modal_reset(target){
    $(target).on("hidden.bs.modal", function(){
        $(this).find("form")[0].reset();
    });
}