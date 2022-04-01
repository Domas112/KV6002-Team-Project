let dishList = "#dishDataTable";
let pageNumber = "#pageNumber";
let searchInput = "input[name='search']";
let result;

$("document").ready(function() {
    let url = '../dishmanagement.php/api/dish';
    let retrievingDish = url + '?retrieveAll';

    //Render the data table onLoad
    result = getDishData(retrievingDish);
    displayDishData(result);
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

function displayDishData(data){
    let viewDishTable =
        "<div class='table-responsive'>" +
        "<table class='table' id='sortTable'>\n" +
        "<thead>\n" +
        "<tr>\n" +
        "<th>ID</th>\n" +
        "<th>Name</th>\n" +
        "<th>Description</th>\n" +
        "<th>Category</th>\n" +
        "<th>Option Available</th>\n" +
        "<th>Image</th>\n" +
        "<th>Availability</th>\n" +
        "<th>Management</th>\n" +
        "</tr>" +
        "</thead>" +
        "<tbody>";

    $.each(data, function (index) {
        viewDishTable +=
            "<tr>\n" +
            "<td>" + data[index].dishID + "</td>\n" +
            "<td>" + data[index].dishName + "</td>\n" +
            "<td style='width:25%'>" + data[index].dishDescription + "</td>\n" +
            "<td>" + data[index].categoryName + "</td>\n" +
            "<td style='width:10%'>" + data[index].numberOfDishOption + "</td>\n" +
            "<td style='width:auto'><img src='data:image;base64," + data[index].imageData + "'/></td>\n" +
            "<td>" + interpretAvailability(parseInt(data[index].dishAvailability)) + "</td>\n" +
            "<td>\n" +
            "<div class='btn-group-vertical' id='manage-button'>" +
            "<a href=\"/kv6002/foodmenumanagement/dishmanagement.php/edit?id=" + data[index].dishID + "\"><input class='btn btn-sm' type='button' value='Edit'></a>\n" +
            "<a href=\"/kv6002/foodmenumanagement/dishmanagement.php/delete?id=" + data[index].dishID + "\"><input class='btn btn-sm' type='button' value='Delete'></a>\n" +
            "<a href=\"/kv6002/foodmenumanagement/dishmanagement.php/availability?id=" + data[index].dishID + "\"><input class='btn btn-sm' type='button' value='Change Availability'></a>\n" +
            "</div>\n" +
            "</td>\n" +
            "</tr>\n";
    })

    viewDishTable += "</tbody>" +
        "</table>" +
        "</div>"

    $(dishList).html(viewDishTable);

    oTable = $("#sortTable").DataTable({
        "columnDefs": [{
            "targets": [5,7],
            "orderable": false
        }],
        "lengthMenu":[[5,10,15],[5,10,15]],
        "pagingType": "simple",
        language:{
            paginate:{
                next: '<input type="button" class="btn btn-sm" name="next" id="next" value="Next">',
                previous: '<input type="button" class="btn btn-sm" name="previous" id="previous" value="Previous">'
            },
            "info":"Page _PAGE_ of _PAGES_"
        },
        initComplete: (settings, json)=>{
            $('.dataTables_length').appendTo("#page-entries");
            $('.dataTables_paginate').appendTo("#pagination");
            $('.dataTables_info').appendTo('#pageNumber');
        }
    });

    $(searchInput).on('keyup',function(){
        oTable.search($(this).val()).draw();
    })
}

function interpretAvailability(availability){
    if(availability === 0){
        return "Not Available";
    }else{
        return "Available";
    }
}