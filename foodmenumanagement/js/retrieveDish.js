let dishList = "#dishDataTable";
let searchInput = "input[name='search']";
let result;

$("document").ready(function() {
    let url = '../foodmenuadmin.php/api/dish';
    let retrievingDish = url + '?retrieveAll';

    //Render the data table onLoad
    result = retrieveData(retrievingDish);
    displayDishData(result);
})

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
            "<td data-title='Dish ID'>" + data[index].dishID + "</td>\n" +
            "<td data-title='Dish Name'>" + data[index].dishName + "</td>\n" +
            "<td data-title='Dish Description'>" + data[index].dishDescription + "</td>\n" +
            "<td data-title='Category'>" + data[index].categoryName + "</td>\n" +
            "<td data-title='Number of Option'>" + data[index].numberOfDishOption + "</td>\n" +
            "<td data-title='Image'><img src='data:image;base64," + data[index].imageData + "'/></td>\n" +
            "<td data-title='Availability'>" + interpretAvailability(parseInt(data[index].dishAvailability)) + "</td>\n" +
            "<td data-title='Action'>\n" +
            "<div class='btn-group-vertical' id='manage-button'>" +
            "<button type='button' class='btn btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' id='"+data[index].dishID+"' onclick='retrieveOneDishData(this);'>Edit</button>\n" +
            "<button type='button' class='btn btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal' id='"+data[index].dishID+"' name='"+data[index].dishName+"' onclick='deleteModal(this);'>Delete</button>\n" +
            "<button type='button' class='btn btn-sm' data-bs-toggle='modal' data-bs-target='#availabilityModal' id='"+data[index].dishID+"' name='"+data[index].dishName+"' onclick='availableModal(this);'>Change Availability</button>\n" +
            "</div>\n" +
            "</td>\n" +
            "</tr>\n";
    })

    viewDishTable += "</tbody>" +
        "</table>" +
        "</div>"

    $(dishList).html(viewDishTable);

    let oTable = $("#sortTable").DataTable({
        "columnDefs": [
            {"targets": [5,7], "orderable": false}
        ],
        "bLengthChange": false,
        "pageLength": 5,
        "pagingType": "simple",
        language:{
            paginate:{
                next: '<input type="button" class="btn btn-sm" name="next" id="next" value="Next">',
                previous: '<input type="button" class="btn btn-sm" name="previous" id="previous" value="Previous">'
            }
        },
        initComplete: (settings, json)=>{
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