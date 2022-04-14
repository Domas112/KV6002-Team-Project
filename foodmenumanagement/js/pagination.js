const dataPerPage = 5;
let currentPage = 1;
let totalPage;

function resetCurrentPage(){
    currentPage = 1;
}

/**
 * pagePagination
 *
 * To paginate a data, slicing data into several pages depending on the number of dataPerPage set.
 * (Currently set to 5 data per page)

 * @param currentPage The current page the data is on (e.g. Page 1 will show the first page of data)
 * @param dataArray The data retrieved via the AJAX request above
 * @returns dataArray.slice() Return the sliced data for display purposed
 */
function pagePagination(currentPage,dataArray){
    totalPage = Math.ceil(dataArray.length/dataPerPage);
    const trimStart = (currentPage-1) * dataPerPage;
    const trimEnd = trimStart + dataPerPage;

    return dataArray.slice(trimStart,trimEnd);
}

function navigatePage(button){
    if(button.name === "next"){
        if(currentPage < totalPage){
            currentPage++;
        }
    }else if(button.name === "previous"){
        if(currentPage !== 1){
            currentPage--;
        }
    }
    displayMenuData(result,currentPage);
}
