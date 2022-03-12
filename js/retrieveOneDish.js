let form = "form[name='dishForm']"

$("document").ready(function(){
    const urlParams = new URLSearchParams(window.location.search);
    const url = '../src/retrieveDishData.php';
    const retrieveOneURL = url + '?retrieveOne&id='+urlParams.get('id');
    $.ajax({
        url:retrieveOneURL,
        dataType: 'json',
        success: function(result){
            $(form).find("input[name='name']").val(result[0]["dishName"]);
            $(form).find("textarea[name='description']").text(result[0]["dishDescription"]);
            $(form).find("select[name='category']").val(result[0]["dishCategoryID"]);
            if(result[0]["optionID"] != null){
                $.each(result, function(index){
                    addNewOption("edit",result[index]["optionID"],result[index]["optionName"],result[index]["optionPrice"]);
                })
            }
        }
    })
})