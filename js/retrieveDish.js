dishList = "#dishDataTable";
searchInput = "input[name='search']";

$("document").ready(function() {
    let url = '../src/retrieveDishData.php';
    let retrieveAllDish = url + '?retrieveAll';

    displayDishData(retrieveAllDish);

    $(searchInput).on('input',function(e){
        if($(searchInput).val() === ""){
            displayDishData(retrieveAllDish);
        }else{
            let searchDish = url +'?searchData'
            searchDish += "&search="+$(searchInput).val()
            displayDishData(searchDish);
        }
    })
})

function displayDishData(url){
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (result) {
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

            $.each(result, function (index) {
                viewDishTable +=
                    "<tr>\n" +
                    "<td>" + result[index].dishID + "</td>\n" +
                    "<td>" + result[index].dishName + "</td>\n" +
                    "<td>" + result[index].dishDescription + "</td>\n" +
                    "<td>" + result[index].categoryName + "</td>\n" +
                    "<td>" + result[index].numberOfDishOption + "</td>\n" +
                    "<td><img width='350px' height='200px' src='data:image;base64," + result[index].imageData + "'/></td>\n" +
                    "<td>" + interpretAvailability(parseInt(result[index].dishAvailability)) + "</td>\n" +
                    "<td>\n" +
                    "<li><a href=\"/kv6002/dishmanagement.php/edit?id=" + result[index].dishID + "\">Edit</a></li>\n" +
                    "<li><a href=\"/kv6002/dishmanagement.php/delete?id=" + result[index].dishID + "\">Delete</a></li>\n" +
                    "<li><a href=\"/kv6002/dishmanagement.php/availability?id=" + result[index].dishID + "\">Change Availability</a></li>\n" +
                    "</td>\n" +
                    "</tr>\n";
            })
            $(dishList).html(viewDishTable);
        }
    })
}

function interpretAvailability(availability){
    if(availability === 0){
        return "Not Available";
    }else{
        return "Available";
    }
}