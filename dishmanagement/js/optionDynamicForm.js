let addButton = "#addOption";
let removeButton = "#removeOption";
let divOption = "div.option";
let deletedOption = [];

$("document").ready(function(){
    $(addButton).click(function(){
        addNewOption("add",null,null);
    })

    $(divOption).on('click','#removeOption',function(){
        $(this).closest('#newOption').remove();
    });

    $("div.option").on('click','#removeRetrievedOption',function(){
        deletedOption.push($(this).closest('#newOption').find("input[type='hidden']").val());
        let result = JSON.stringify(deletedOption);
        $(divOption).find("input[id='deletedOption']").val(result);
        $(this).closest('#newOption').remove();
    });
})

function addNewOption($mode,$optionID,$optionName,$optionPrice){
    let newOption = "" +
        "<div id='newOption'>" +
        "   <input type='hidden' "+changeInputHiddenID($optionID)+insertValue($optionID)+">" +
        "   <label>Option:</label>\n" +
        "   <input type='text' "+changeInputName($optionID)+insertValue($optionName)+" required><br>" +
        "   <label>Price:</label>\n" +
        "   <input type='text' "+changeInputPriceName($optionID)+insertValue($optionPrice)+" required>";

    if($mode === "add"){
        newOption += "<input type='button' id='removeOption' value='Remove'>";
    }else if($mode === "edit"){
        newOption += "<input type='button' id='removeRetrievedOption' value='Remove'>";
    }

    newOption += "</div>";
    $("div.option").append(newOption);
}

function insertValue(value){
    if(value != null){
        console.log(value);
        return "value='"+value+"'";
    }else{
        return "";
    }
}

function changeInputHiddenID(value){
    if(value != null){
        return "name='retrievedID[]'";
    }else{
        return "name='optionID[]'";
    }
}

function changeInputName(value){
    if(value != null){
        return "name='retrievedName[]'";
    }else{
        return "name='optionName[]'";
    }
}

function changeInputPriceName(value){
    if(value != null){
        return "name='retrievedPrice[]'";
    }else{
        return "name='price[]'";
    }
}