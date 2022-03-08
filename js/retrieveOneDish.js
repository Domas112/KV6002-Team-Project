window.addEventListener('load',function(){
    "use strict";

    const urlParams = new URLSearchParams(window.location.search);
    const url = '../src/retrieveDishData.php';
    const retrieveOneURL = url + '?retrieveOne&id='+urlParams.get('id');

    const retrieveOne = function(){
        fetch(retrieveOneURL)
            .then(
                function(response){
                    const contentType = response.headers.get('content-type');
                    if(contentType.includes('application/json')){
                        return response.json();
                    }
                    return response.text();
                }
            )
            .then(
                function(content){
                    document.getElementById("name").value = content[0]['dishName'];
                    document.getElementById("description").innerText = content[0]['dishDescription'];
                    document.getElementById("category").value = content[0]['dishCategoryID'];
                    document.getElementById("price").value = content[0]['dishPrice'];
                }
            )
            .catch(
                function(err){
                    console.log("Something went wrong!", err);
                }
            )
    }
    retrieveOne();
})