let addAddButton = "#add-addOption";
let editAddButton = "#edit-addOption";
let removeButton = "#removeOption";
let divEditOption = "div.edit-option";
let deletedOption = [];

// $("form[name='dishForm']").submit(function(e){E
//     e.preventDefault();
// })

$("document").ready(function(){
    $(addAddButton).click(function(){
        addNewOption("add",null,null);
    })

    $(editAddButton).click(function(){
        addNewOption("edit",null,null);
    })

    $(divEditOption).on('click','#removeOption',function(){
        $(this).closest('#edit-newOption').remove();
    });

    $(divEditOption).on('click','#removeRetrievedOption',function(){
        deletedOption.push($(this).parent().parent().find("input[type='hidden']").val());
        let result = JSON.stringify(deletedOption);
        $("input[id='deletedOption']").val(result);
        $(this).parent().parent().remove();
    });
})

function addNewOption(mode,optionID,optionName,optionPrice){
    let newOption =
        "<div class='"+mode+"-newOption'>" +
        "   <input type='hidden' "+changeInputHiddenID(optionID)+insertValue(optionID)+">" +
        "   <div class='form-group'>" +
            "   <label>Option Title:</label>\n" +
            "   <input class='form-control' type='text' "+changeInputName(mode,optionID)+insertValue(optionName)+" required>" +
        "   </div>" +
        "   <div class='form-group'>" +
            "   <label>Price:</label>\n" +
            "   <input class='form-control' type='text' "+changeInputPriceName(mode,optionID)+insertValue(optionPrice)+" required>" +
        "   </div>" +
        "   <div class='d-flex align-items-end flex-column'>" +
                generateOptionButton(mode)+
        "   </div>" +
        "</div>";

    $("div."+mode+"-option").append(newOption);
}

function generateOptionButton(mode){
    let newButton = "<input class='btn btn-sm p-2' type='button' id=";
    if(mode === "add"){
        newButton += "'removeOption'";
    }else if(mode === "edit"){
        newButton += "'removeRetrievedOption'";
    }
    newButton += " value='- Remove'>";

    return newButton;
}

function insertValue(value){
    if(value != null){
        return "value='"+value+"'";
    }else{
        return "";
    }
}

function changeInputHiddenID(value){
    if(value != null){
        return "name='retrievedID[]'";
    }else{
        return "";
    }
}

function changeInputName(mode,value){
    if(value != null){
        return "name='retrievedName[]'";
    }else{
        return "name='"+mode+"-optionName[]'";
    }
}

function changeInputPriceName(mode,value){
    if(value != null){
        return "name='retrievedPrice[]'";
    }else{
        return "name='"+mode+"-optionPrice[]'";
    }
}

function test(value){
    alert(value);
}