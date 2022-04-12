let foodMenu = "#foodMenu";
let url = 'http://unn-w19030982.newnumyspace.co.uk/kv6002/foodmenumanagement/foodmenuadmin.php/api/dish';
let retrievingMenu = url + '?retrieveDishMenu';

$("document").ready(function() {
    //Render the data table onLoad
    result = retrieveData(retrievingMenu);
    displayMenuData(result);
})

function displayMenuData(data){
    let foodMenuList = "";
    if(data !== undefined){
        let paginatedData = pagePagination(currentPage,data);
        $.each(paginatedData, function (index) {
            foodMenuList +=
                "<section class='dishItem'>" +
                "<div class='dishImage'>" +
                "<img src='data:image;base64," + paginatedData[index].dishImageData + "' class='dishThumbnail'/>" +
                "</div>" +
                "<div class='dishInfo'>" +
                "<h4>"+paginatedData[index].dishName+"</h4>" +
                "<p>"+paginatedData[index].dishDescription+"</p>" +
                "<br>" +
                "<h6>Option Available:</h6>"
            $.each(paginatedData[index].dishOption, function(optIndex){
                foodMenuList +=
                    "<p>"+paginatedData[index].dishOption[optIndex].optionName+" (£"+paginatedData[index].dishOption[optIndex].optionPrice+")</p>";
            })
            foodMenuList +=
                "</div>" +
                "</section>"
        })
        foodMenuList +=
            "<div class='d-flex justify-content-center' id='page-navigator'>" +
            "<input type='button' class='btn btn-sm previous' value='Previous' name='previous' onclick='navigatePage(this)'>" +
            "<input type='button' class='btn btn-sm next' value='Next' name='next' onclick='navigatePage(this)'>" +
            "</div>"
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
    resetCurrentPage();
    displayMenuData(result);
})
