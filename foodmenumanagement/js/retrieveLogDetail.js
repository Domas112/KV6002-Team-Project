let logDetailList = "#logDetailTable";

function loadLogDetailData(button){
    const id = button.id;
    let url = '../foodmenuadmin.php/api/log';
    let retrievingLogDetail = url + '?retrieveLogDetail&id='+id;

    //Render the data table onLoad
    result = retrieveData(retrievingLogDetail);
    displayLogDetailData(result);
}

function displayLogDetailData(data) {
    let logDetailTable =
        "<div class='table-responsive'>" +
        "<table class='table table-striped'>\n" +
        "<thead>\n" +
        "</thead>" +
        "<tbody>";

    $.each(data, function (index) {
        logDetailTable +=
            "<tr>\n" +
            "<td>" + (parseInt(index)+1) + "</td>\n" +
            "<td>" + data[index].logChanges + "</td>\n" +
            "</tr>";
    })

    logDetailTable += "</tbody>" +
        "</table>" +
        "</div>"

    $(logDetailList).html(logDetailTable);
}