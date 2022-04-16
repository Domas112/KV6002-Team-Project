/**
 * retrieveLog.js
 * A script used to retrieve and displaying the log data
 *
 * @author Teck Xun Tan W20003691
 */
let logList = "#logDataTable";
let searchInput = "input[name='search']";
let result;

$("document").ready(function() {
    let url = '../foodmenuadmin.php/api/log';
    let retrievingLog = url + '?retrieveAll';

    //Retrieve data using function in dataRetrieve.js
    result = retrieveData(retrievingLog);

    //Render the data table onLoad
    displayLogData(result);
})

/**
 * displayLogData
 * The function is used to render and display the retrieved data into the pre-generated empty container generated using
 * generateDataTable in uielement.php
 */
function displayLogData(data) {
    //Generate the data table
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

    //For each data, generate a new data row
    $.each(data, function (index) {
        viewLogTable +=
            "<tr>\n" +
                "<td data-title='Log ID'>" + data[index].logID + "</td>\n" +
                "<td data-title='Timestamp'>" + data[index].logTimestamp + "</td>\n" +
                "<td data-title='User ID'>" + data[index].username + "</td>\n" +
                "<td data-title='Description'>" + data[index].logDescription + "</td>\n";

        if(data[index].logDescription.includes("edit")){
            //If the log description contains text such as "edit", generate the view log button
            viewLogTable +=
                "<td data-title='Action' class='viewBtn'>" +
                    "<div class='btn-group-vertical' id='viewlog-button'>" +
                        "<button type='button' class='btn btn-primary logDetail' data-bs-toggle='modal' data-bs-target='#logModal' id='"+data[index].logID+"' onclick='loadLogDetailData(this)'>" +
                            "<i class='fi fi-rr-eye'></i> View Log" +
                        "</button>" +
                    "</div>" +
                "</td>";
        }else{
            //If the log description does not contain "edit", generate text "No action available"
            viewLogTable += "<td data-title='Action'>No action available</td>";
        }

        //Generate the closing tag
        viewLogTable += "</tr>"
    })

    //Generate rest of the closing tag
    viewLogTable += "</tbody>" +
        "</table>" +
        "</div>"

    //Rewrite the HTML code in the empty container into the generated data table
    $(logList).html(viewLogTable);

    //Enable DataTable plugin (Available at: https://datatables.net/)
    let oTable = $("#sortTable").DataTable({

        //Change the properties of the datatable
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

        //Move datatable generated paginate and info to other container to enable more customisation
        initComplete: (settings, json)=>{
            $('.dataTables_paginate').appendTo("#pagination");
            $('.dataTables_info').appendTo('#pageNumber');
        }
    });

    $(searchInput).on('keyup', function () {
        //When text is entered into the custom search bar, copy the text into the datatable generated search bar and perform filter on table
        oTable.search($(this).val()).draw();
    })
}