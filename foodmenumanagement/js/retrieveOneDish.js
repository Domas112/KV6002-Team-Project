let form = "form[name='dishForm']"

function retrieveOneDishData(editBtn){
    const id = editBtn.id;
    const url = '../foodmenuadmin.php/api/dish';
    const retrieveOneURL = url + '?retrieveOne&id='+id;
    $.ajax({
        url:retrieveOneURL,
        dataType: 'json',
        success: function(result){
            if(result.length !== 0){
                $(form).find("input[name='edit-id']").val(editBtn.id);
                $(form).find("input[name='edit-name']").val(result[0]["dishName"]);
                $(form).find("textarea[name='edit-description']").text(result[0]["dishDescription"]);
                $(form).find("select[name='edit-category']").val(result[0]["dishCategoryID"]);
                if(result[0]["optionID"] != null){
                    $.each(result, function(index){
                        addNewOption("edit",result[index]["optionID"],result[index]["optionName"],result[index]["optionPrice"]);
                    })
                }
            }else{
                $(form).remove();
            }
        }
    })
}