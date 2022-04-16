/**
 * pagination.js
 * A script used to handle the data pagination
 *
 * @author Teck Xun Tan W20003691
 */
const dataPerPage = 5;
let currentPage = 1;
let totalPage;

/**
 * resetCurrentPage
 * The function is used to reset the current page value back to 1
 */
function resetCurrentPage(){
    currentPage = 1;
}

/**
 * pagePagination
 * The function is used to paginate a data, slicing data into several pages depending on the number of dataPerPage set.
 * (Currently set to 5 data per page as seen in variable dataPerPage above)
 */
function pagePagination(currentPage,dataArray){
    //Calculating the total page
    totalPage = Math.ceil(dataArray.length/dataPerPage);

    //Getting the start and end value on where the data should be trimmed
    const trimStart = (currentPage-1) * dataPerPage;
    const trimEnd = trimStart + dataPerPage;

    //Return the sliced data
    return dataArray.slice(trimStart,trimEnd);
}

/**
 * navigatePage
 * The function is used to navigate through the paginated pages
 */
function navigatePage(button){
    if(button.name === "next"){
        //If the button name property is next
        if(currentPage < totalPage){
            //If the currentPage is not at the end of the page, increase currentPage by 1
            currentPage++;
        }
    }else if(button.name === "previous"){
        //If the button name property is previous
        if(currentPage !== 1){
            //If the currentPage is not at the first page, decrease currentPage by 1
            currentPage--;
        }
    }

    //Re-rendering the data (Function from retrieveMenuItem.js)
    displayMenuData(result,currentPage);
}
