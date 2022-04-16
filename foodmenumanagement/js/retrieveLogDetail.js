/**
 * retrieveLogDetail.js
 * A script used to retrieve and displaying the log detail data
 *
 * @author Teck Xun Tan W20003691
 */
let logDetailList = "#logDetailTable";

function loadLogDetailData(button){
    const id = button.id;
    let url = '../foodmenuadmin.php/api/log';
    let retrievingLogDetail = url + '?retrieveLogDetail&id='+id;

    //Retrieve data using function in dataRetrieve.js
    result = retrieveData(retrievingLogDetail);

    //Render the data table onLoad
    displayLogDetailData(result);
}

/**
 * displayLogDetailData
 * The function is used to render and display the retrieved data into the pre-generated empty container generated using
 * generateDataTable in uielement.php
 */
function displayLogDetailData(data) {
    //Generate the data table
    let logDetailTable =
        "<div class='table-responsive'>" +
            "<table class='table table-striped'>\n" +
                "<thead>\n" +
                "</thead>" +
                "<tbody>";

    //For each data, generate a new data row
    $.each(data, function (index) {
        logDetailTable +=
            "<tr>\n" +
                "<td>" + (parseInt(index)+1) + "</td>\n" +
                "<td>" + data[index].logChanges + "</td>\n" +
            "</tr>";
    })

    //Generate the closing tag
    logDetailTable += "</tbody>" +
        "</table>" +
        "</div>"

    //Rewrite the HTML code in the empty container into the generated data table
    $(logDetailList).html(logDetailTable);
}