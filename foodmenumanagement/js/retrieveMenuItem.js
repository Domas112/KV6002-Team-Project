let foodMenu = "#foodMenu";
let url = '../foodmenuadmin.php/api/dish';
let retrievingMenu = url + '?retrieveDishMenu';

$("document").ready(function() {
    //Render the data table onLoad
    result = retrieveData(retrievingMenu);
    displayMenuData(result);
})

function displayMenuData(data){
    let foodMenuList = "";
    if(data !== undefined){
        $.each(data, function (index) {
            foodMenuList +=
                "<section class='dishItem'>" +
                "<div class='dishImage'>" +
                "<img src='data:image;base64," + data[index].dishImageData + "' class='dishThumbnail'/>" +
                "</div>" +
                "<div class='dishInfo'>" +
                "<h4>"+data[index].dishName+"</h4>" +
                "<p>"+data[index].dishDescription+"</p>" +
                "<br>" +
                "<h6>Option Available:</h6>"
            $.each(data[index].dishOption, function(optIndex){
                foodMenuList +=
                    "<p>"+data[index].dishOption[optIndex].optionName+" (£"+data[index].dishOption[optIndex].optionPrice+")</p>";
            })
            foodMenuList +=
                "</div>" +
                "</section>"
        })
    }else{
        foodMenuList +=
            "<div id='emptyMenuMessage'>\n" +
            "<p class='align-middle'>Sorry! No Dish Available at the moment. Please check again later :(</p>\n" +
            "</div>"
    }

    $(foodMenu).html(foodMenuList);
}

$("ul li a").on("click",function(){
    const id = this.id;
    if(id === "0"){
        result = retrieveData(retrievingMenu);
    }else{
        result = retrieveData(retrievingMenu+"&category="+id);
    }
    displayMenuData(result);
})
