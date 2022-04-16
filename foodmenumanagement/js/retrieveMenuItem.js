/**
 * retrieveMenuItem.js
 * A script used to retrieve and displaying the log detail data
 *
 * @author Teck Xun Tan W20003691
 */
let foodMenu = "#foodMenu";
let url = 'http://unn-w19030982.newnumyspace.co.uk/kv6002/foodmenumanagement/foodmenuadmin.php/api/dish';
let retrievingMenu = url + '?retrieveDishMenu';

$("document").ready(function() {
    //Retrieve data using function in dataRetrieve.js
    result = retrieveData(retrievingMenu);

    //Render the data table onLoad
    displayMenuData(result);
})

$("ul li a").on("click",function(){
    //When a navigation bar item has been clicked, retrieve the element ID property
    const id = this.id;

    if(id === "0"){
        //If the ID is 0, retrieve all item from the menu
        result = retrieveData(retrievingMenu);
    }else{
        //If the ID is not 0, retrieve the item with the specified category ID
        result = retrieveData(retrievingMenu+"&category="+id);
    }

    //Reset the page number (refer to pagination.js)
    resetCurrentPage();

    //Re-render the data
    displayMenuData(result);
})

/**
 * displayMenuData
 * The function is used to render and display the retrieved data into the pre-generated empty container generated using
 * generateMenuItem in customeruielement.php
 */
function displayMenuData(data){
    //Initialise empty variable
    let foodMenuList = "";

    if(data !== undefined){
        //If the data is not empty, paginate the data using pagePagination function (refer to pagination.js)
        let paginatedData = pagePagination(currentPage,data);

        //For each data, generate a new section
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

            //For each dish option, generate a paragraph
            $.each(paginatedData[index].dishOption, function(optIndex){
                foodMenuList +=
                    "<p>"+paginatedData[index].dishOption[optIndex].optionName+" (£"+paginatedData[index].dishOption[optIndex].optionPrice+")</p>";
            })

            //Generate the closing tag
            foodMenuList +=
                    "</div>" +
                "</section>"

        })

        //Generate the page navigation button
        foodMenuList +=
            "<div class='d-flex justify-content-center' id='page-navigator'>" +
                "<input type='button' class='btn btn-sm previous' value='Previous' name='previous' onclick='navigatePage(this)'>" +
                "<input type='button' class='btn btn-sm next' value='Next' name='next' onclick='navigatePage(this)'>" +
            "</div>"

    }else{
        //If data is empty, generate "No Dish Available" message
        foodMenuList +=
            "<div id='emptyMenuMessage'>\n" +
                "<p class='align-middle'>Sorry! No Dish Available at the moment. Please check again later :(</p>\n" +
            "</div>"

    }

    //Rewrite the HTML code in the empty container into the generated sections
    $(foodMenu).html(foodMenuList);
}
