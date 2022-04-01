let logList = "#logDataTable";
let pageNumber = "#pageNumber";
let searchInput = "input[name='search']";
let result;

$("document").ready(function() {
    let url = '../dishmanagement.php/api/log';
    let retrievingLog = url + '?retrieveAll';

    //Render the data table onLoad
    result = getDishData(retrievingLog);
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

function displayDishData(data) {

    let viewLogTable =
        "<div class='table-responsive'>" +
        "<table class='table table-striped' id='sortTable'>\n" +
        "<thead>\n" +
        "<tr>\n" +
        "<th>ID</th>\n" +
        "<th>Timestamp</th>\n" +
        "<th>User ID</th>\n" +
        "<th>Log Description</th>\n" +
        "</tr" +
        "</thead>" +
        "<tbody>";

    $.each(data, function (index) {
        viewLogTable +=
            "<tr>\n" +
            "<td style='width:50px;'>" + data[index].logID + "</td>\n" +
            "<td style='width:300px;'>" + data[index].logTimestamp + "</td>\n" +
            "<td style='width:100px;'>" + data[index].userID + "</td>\n" +
            "<td>" + data[index].logDescription + "</td>\n" +
            "</tr>\n";
    })

    viewLogTable += "</tbody>" +
        "</table>" +
        "</div>" +
        "</div>"

    $(logList).html(viewLogTable);

    oTable = $("#sortTable").DataTable({
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

    $('a[class="previous"]').addClass("btn-sm");

    $(searchInput).on('keyup', function () {
        oTable.search($(this).val()).draw();
    })
}