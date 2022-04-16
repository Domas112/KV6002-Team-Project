/**
 * dataRetrieve.js
 * A script used to retrieve data using AJAX method
 *
 * @author Teck Xun Tan W20003691
 */

/**
 * retrieveData
 * The function is used to retrieve and return the data using AJAX method using the provided URL
 */
function retrieveData(url){
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