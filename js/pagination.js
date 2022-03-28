const dataPerPage = 5;
let currentPage = 1;
let totalPage;
let nextPageBtn = "input[name='next']";
let prevPageBtn = "input[name='previous']";

function resetCurrentPage(){
    currentPage = 1;
}

/**
 * pagePagination
 *
 * To paginate a data, slicing data into several pages depending on the number of dataPerPage set.
 * (Currently set to 5 data per page)
 *
 * Adapted from https://medium.com/geekculture/building-a-javascript-pagination-as-simple-as-possible-a9c32dbf4ac1
 * Author: Jordan P. Raychev
 * Retrieved on: 13 March 2022
 *
 * @param currentPage The current page the data is on (e.g. Page 1 will show the first page of data)
 * @param dataArray The data retrieved via the AJAX request above
 * @returns dataArray.slice() Return the sliced data for display purposed
 */
function pagePagination(currentPage,dataArray){
    totalPage = Math.ceil(dataArray.length/dataPerPage);
    const trimStart = (currentPage-1) * dataPerPage;
    const trimEnd = trimStart + dataPerPage;

    $(pageNumber).html(currentPage+"/"+totalPage);

    return dataArray.slice(trimStart,trimEnd);
}

function navigatePage(command){
    if(command === "next"){
        if(currentPage < totalPage){
            currentPage++;
        }
    }else if(command === "previous"){
        if(currentPage !== 1){
            currentPage--;
        }
    }
}

$(nextPageBtn).on('click',function(){
    navigatePage("next");
    displayDishData(result,currentPage);
})

//Handle onClick event of Previous button
$(prevPageBtn).on('click',function(){
    navigatePage("previous");
    displayDishData(result,currentPage);
})
