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