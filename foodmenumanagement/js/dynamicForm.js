/**
 * dynamicForm.js
 * A script used to handle the form changes dynamically
 *
 * @author Teck Xun Tan W20003691
 */
let addAddButton = "#add-addOption";
let editAddButton = "#edit-addOption";
let divEditOption = "div.edit-option";
let divAddOption = "div.add-option";
let deletedOption = [];

$("document").ready(function(){

    $(addAddButton).click(function(){
        //Call the addNewOption function onClick
        addNewOption("add",null,null,null,"add");
    })

    $(editAddButton).click(function(){
        //Call the addNewOption function onClick
        addNewOption("edit",null,null,null,"edit");
    })

    $(divAddOption).on('click','#removeOption',function(){
        //Remove the parent of the element onClick
        $(this).parent().parent().remove();
    })

    $(divEditOption).on('click','#removeOption',function(){
        //Remove the parent of the element onClick
        $(this).parent().parent().remove();
    })

    /**
     * The following block of cods is used to handle the deletion of a existing dish option. Whenever the user
     * clicked on deleting a dish option, the dish option ID is retrieved and placed in a hidden input element for
     * later use.
     */
    $(divEditOption).on('click','#removeRetrievedOption',function(){
        //Push the value of the parent element into the deletedOption array onClick
        deletedOption.push($(this).parent().parent().find("input[type='hidden']").val());

        //Stringify the array
        let result = JSON.stringify(deletedOption);

        //Change the element value into the stringified array
        $("input[id='deletedOption']").val(result);

        //Remove the parent of the element
        $(this).parent().parent().remove();
    });
})

/**
 * addNewOption
 * The function is used for creating a new option panel into the existing option container. The function will create a
 * option panel where user may type in the option title and price.
 */
function addNewOption(mode,optionID,optionName,optionPrice,buttonMode){
    //Generating a new option
    let newOption =
        "<div class='"+mode+"-newOption'>" +
        "   <input type='hidden' "+changeInputHiddenID(optionID)+insertValue(optionID)+">" +
        "   <div class='mb-3'>" +
            "   <label>Option Title:</label>\n" +
            "   <input class='form-control' type='text' "+changeInputName(mode,optionID)+insertValue(optionName)+" required>" +
        "   </div>" +
        "   <div class='mb-3'>" +
            "   <label>Price:</label>\n" +
            "   <input class='form-control' type='number' min='0.00' max='10000.00' step='0.01'"+changeInputPriceName(mode,optionID)+insertValue(optionPrice)+" required>" +
        "   </div>" +
        "   <div class='d-flex align-items-end flex-column'>" +
            "   <input class='btn btn-sm p-2' type='button' "+generateOptionButton(buttonMode)+" value='- Remove'>"+
        "   </div>" +
        "</div>";

    //Append the new option container into the existing container
    $("div."+mode+"-option").append(newOption);
}

/**
 * generateOptionButton
 * The function is used to change the id property of the remove button in the option panel above depending on the
 * mode provided (e.g. add, edit or retrieved)
 */
function generateOptionButton(mode){
    if(mode === "add" || mode === "edit"){
        return "id='removeOption'";
    }else if(mode === "retrieved"){
        return "id='removeRetrievedOption'";
    }
}

/**
 * insertValue
 * The function is to add value property into the input element in the option panel created
 */
function insertValue(value){
    if(value != null){
        return "value='"+value+"'";
    }else{
        return "";
    }
}

/**
 * changeInputHiddenID
 * The function is to change the name property of the hidden input element in the option panel
 */
function changeInputHiddenID(value){
    if(value != null){
        return "name='retrievedID[]'";
    }else{
        return "";
    }
}

/**
 * changeInputName
 * The function is to change the name property of any input element in the option panel
 */
function changeInputName(mode,value){
    if(value != null){
        return "name='retrievedName[]'";
    }else{
        return "name='"+mode+"-optionName[]'";
    }
}

/**
 * changeInputPriceName
 * The function is to change the name property of option price input element in the option panel
 */
function changeInputPriceName(mode,value){
    if(value != null){
        return "name='retrievedPrice[]'";
    }else{
        return "name='"+mode+"-optionPrice[]'";
    }
}