let logList = "#logDataTable";
let searchInput = "input[name='search']";
let result;

$("document").ready(function() {
    let url = '../foodmenuadmin.php/api/log';
    let retrievingLog = url + '?retrieveAll';

    //Render the data table onLoad
    result = retrieveData(retrievingLog);
    displayLogData(result);
})

function displayLogData(data) {
    let viewLogTable =
        "<div class='table-div'>" +
        "<table class='table' id='sortTable'>\n" +
        "<thead>\n" +
        "<tr>\n" +
        "<th>ID</th>\n" +
        "<th>Timestamp</th>\n" +
        "<th>User ID</th>\n" +
        "<th>Log Description</th>\n" +
        "<th>View Log Detail</th>\n" +
        "</tr>\n" +
        "</thead>" +
        "<tbody>";

    $.each(data, function (index) {
        viewLogTable +=
            "<tr>\n" +
            "<td data-title='Log ID'>" + data[index].logID + "</td>\n" +
            "<td data-title='Timestamp'>" + data[index].logTimestamp + "</td>\n" +
            "<td data-title='User ID'>" + data[index].username + "</td>\n" +
            "<td data-title='Description'>" + data[index].logDescription + "</td>\n";

        if(data[index].logDescription.includes("edit")){
            viewLogTable +=
                "<td data-title='Action' class='viewBtn'>" +
                "   <div class='btn-group-vertical' id='viewlog-button'>" +
                "       <button type='button' class='btn btn-sm logDetail' data-bs-toggle='modal' data-bs-target='#logModal' id='"+data[index].logID+"' onclick='loadLogDetailData(this)'>View Log</button></td>\n" +
                "   </div>" +
                "</td>";
        }else{
            viewLogTable += "<td data-title='Action'>No action available</td>";
        }

        viewLogTable += "</tr>"
    })

    viewLogTable += "</tbody>" +
        "</table>" +
        "</div>"

    $(logList).html(viewLogTable);

    let oTable = $("#sortTable").DataTable({
        "columnDefs": [
            {"targets": [4], "orderable": false}
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

    $('a[class="previous"]').addClass("btn-sm");

    $(searchInput).on('keyup', function () {
        oTable.search($(this).val()).draw();
    })
}