let logList = "#logDataTable";
let pageNumber = "#pageNumber";
let searchInput = "input[name='search']";
let sorted = "select[name='sort']"
let result;
let selectedURL;

$("document").ready(function() {
    let url = '../dishmanagement.php/api/log';
    let retrievingLog = url + '?retrieveAll';
    let searchingLog = url + '?searchData&search=';

    //Render the data table onLoad
    selectedURL = retrievingLog;
    result = getDishData(selectedURL+"&sort="+$(sorted).val());
    displayDishData(result,currentPage);

    //Start searching process upon keyUp action in Search bar
    $(searchInput).on('keyup',function(){

        //Set CurrentPage back to 1 upon Search
        resetCurrentPage();

        if($(searchInput).val() === ""){
            //If search bar is empty, set url to retrieve full data
            selectedURL = retrievingLog;
        }else{
            //If Search bar is not empty, set url to search data
            selectedURL = searchingLog + $(searchInput).val();
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

    let viewLogTable =
        "<br>" +
        "<table>\n" +
        "<tbody>\n" +
        "<tr>\n" +
        "<th>ID</th>\n" +
        "<th>Timestamp</th>\n" +
        "<th>User ID</th>\n" +
        "<th>Log Description</th>\n" +
        "</tr>";

    $.each(paginateResult, function (index) {
        viewLogTable +=
            "<tr>\n" +
            "<td>" + paginateResult[index].logID + "</td>\n" +
            "<td>" + paginateResult[index].logTimestamp + "</td>\n" +
            "<td>" + paginateResult[index].userID + "</td>\n" +
            "<td>" + paginateResult[index].logDescription + "</td>\n" +
            "</td>\n" +
            "</tr>\n";
    })

    $(logList).html(viewLogTable);
}