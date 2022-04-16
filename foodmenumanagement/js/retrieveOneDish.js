/**
 * retrieveMenuItem.js
 * A script used to retrieve and displaying one dish data (This only applied to when the user clicked on Edit Dish)
 *
 * @author Teck Xun Tan W20003691
 */
let form = "form[name='dishForm']"

/**
 * retrieveOneDishData
 * The function is used to retrieve only one specific dish from the database
 */
function retrieveOneDishData(editBtn){
    const id = editBtn.id;
    const url = '../foodmenuadmin.php/api/dish';
    const retrieveOneURL = url + '?retrieveOne&id='+id;

    //Retrieve data using AJAX
    $.ajax({
        url:retrieveOneURL,
        dataType: 'json',
        success: function(result){
            if(result.length !== 0){
                //If the result is not empty, fill the form in the Edit Modal with the retrieved data
                $(form).find("input[name='edit-id']").val(editBtn.id);
                $(form).find("input[name='edit-name']").val(result[0]["dishName"]);
                $(form).find("textarea[name='edit-description']").text(result[0]["dishDescription"]);
                $(form).find("select[name='edit-category']").val(result[0]["dishCategoryID"]);

                if(result[0]["optionID"] != null){
                    //For each optionID retrieved, create a new option panel and fill the panel with data retrieved using addNewOption function (refer to dynamicModal.js)
                    $.each(result, function(index){
                        addNewOption("edit",result[index]["optionID"],result[index]["optionName"],result[index]["optionPrice"],"retrieved");
                    })
                }
            }else{
                //If the result is empty, redirect to error page
                window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php";
            }
        }
    })
}