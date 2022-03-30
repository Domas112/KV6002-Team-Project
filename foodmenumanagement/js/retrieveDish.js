let dishList = "#dishDataTable";
let pageNumber = "#pageNumber";
let searchInput = "input[name='search']";
let sorted = "select[name='sort']"
let result;
let selectedURL;

$("document").ready(function() {
    let url = '../dishmanagement.php/api/dish';
    let retrievingDish = url + '?retrieveAll';
    let searchingDish = url + '?searchData&search=';

    //Render the data table onLoad
    selectedURL = retrievingDish;
    result = getDishData(selectedURL+"&sort="+$(sorted).val());
    displayDishData(result,currentPage);

    //Start searching process upon keyUp action in Search bar
    $(searchInput).on('keyup',function(){

        //Set CurrentPage back to 1 upon Search
        resetCurrentPage();

        if($(searchInput).val() === ""){
            //If search bar is empty, set url to retrieve full data
            selectedURL = retrievingDish;
        }else{
            //If Search bar is not empty, set url to search data
            selectedURL = searchingDish + $(searchInput).val();
        }

        //Re-render the data table
        result = getDishData(selectedURL+"&sort="+$(sorted).val());
        displayDishData(result,currentPage);
    })

    //Handle onChange event of Sort dropdown bar
    $(sorted).on('change',function(){
        //Set CurrentPage back to 1 upon changing sort
        resetCurrentPage();

        //Re-render the data table
        result = getDishData(selectedURL+"&sort="+$(sorted).val());
        displayDishData(result,currentPage);
    })
})

function getDishData(url){
    let data;
    $.ajax({
        url: url,
        dataType: 'json',
        async: false,
        success: function (result){
            data = result;
        }
    })

    return data;
}

function displayDishData(data,page){
    let paginateResult = pagePagination(page,data);

    let viewDishTable =
        "<br>" +
        "<table class='table table-striped'>\n" +
        "<tbody>\n" +
        "<tr>\n" +
        "<th>ID</th>\n" +
        "<th>Name</th>\n" +
        "<th>Description</th>\n" +
        "<th>Category</th>\n" +
        "<th>Option Available</th>\n" +
        "<th>Image</th>\n" +
        "<th>Availability</th>\n" +
        "<th>Management</th>\n" +
        "</tr>";

    $.each(paginateResult, function (index) {
        viewDishTable +=
            "<tr>\n" +
            "<td>" + paginateResult[index].dishID + "</td>\n" +
            "<td>" + paginateResult[index].dishName + "</td>\n" +
            "<td>" + paginateResult[index].dishDescription + "</td>\n" +
            "<td>" + paginateResult[index].categoryName + "</td>\n" +
            "<td>" + paginateResult[index].numberOfDishOption + "</td>\n" +
            "<td><img width='350px' height='200px' src='data:image;base64," + paginateResult[index].imageData + "'/></td>\n" +
            "<td>" + interpretAvailability(parseInt(paginateResult[index].dishAvailability)) + "</td>\n" +
            "<td>\n" +
            "<li><a href=\"/kv6002/dishmanagement.php/edit?id=" + paginateResult[index].dishID + "\">Edit</a></li>\n" +
            "<li><a href=\"/kv6002/dishmanagement.php/delete?id=" + paginateResult[index].dishID + "\">Delete</a></li>\n" +
            "<li><a href=\"/kv6002/dishmanagement.php/availability?id=" + paginateResult[index].dishID + "\">Change Availability</a></li>\n" +
            "</td>\n" +
            "</tr>\n";
    })
    $(dishList).html(viewDishTable);
}

function interpretAvailability(availability){
    if(availability === 0){
        return "Not Available";
    }else{
        return "Available";
    }
}