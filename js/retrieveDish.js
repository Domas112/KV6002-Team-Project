let dishList = "#dishDataTable";
let searchInput = "input[name='search']";
let nextPageBtn = "input[name='next']";
let prevPageBtn = "input[name='previous']";
let currentPage = 1;
let result;

$("document").ready(function() {
    let url = '../src/retrieveDishData.php';
    let retrievingDish = url + '?retrieveAll';
    let searchingDish = url + '?searchData&search=';

    result = getDishData(retrievingDish);

    $(searchInput).on('keyup',function(e){
        currentPage = 1;
        if($(searchInput).val() === ""){
            result = getDishData(retrievingDish);
            displayDishData(result,currentPage)
        }else{
            result = getDishData(searchingDish + $(searchInput).val());
            displayDishData(result,currentPage);
        }
    })

    $(nextPageBtn).on('click',function(){
        navigatePage("next");
    })

    $(prevPageBtn).on('click',function(){
        navigatePage("previous");
    })

    displayDishData(result,currentPage);
})

function getDishData(url){
    let data;
    $.ajax({
        url: url,
        dataType: 'json',
        async:false,
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
        "<table>\n" +
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

/**
 * pagePagination
 *
 * To paginate a data, slicing data into several pages
 * depending on the number of dataPerPage set.
 *
 * Adapted from https://medium.com/geekculture/building-a-javascript-pagination-as-simple-as-possible-a9c32dbf4ac1
 * Author: Jordan P. Raychev
 * Retrieved on: 13 March 2022
 *
 * @param currentPage The current page the data is on (e.g. Page 1 will show the first page of data)
 * @param dataArray The data retrieved via the AJAX request above
 * @returns dataArray.slice() Return the sliced data for display purposed
 */
function pagePagination(currentPage,dataArray){
    const dataPerPage = 2;
    const trimStart = (currentPage-1)*dataPerPage;
    const trimEnd = trimStart + dataPerPage;
    return dataArray.slice(trimStart,trimEnd);
}

function navigatePage(command){
    if(command === "next"){
        currentPage++;
        displayDishData(result,currentPage);
    }else{
        if(currentPage !== 1){
            currentPage--;
            displayDishData(result,currentPage);
        }
    }
}

function interpretAvailability(availability){
    if(availability === 0){
        return "Not Available";
    }else{
        return "Available";
    }
}