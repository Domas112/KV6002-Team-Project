window.addEventListener('load',function(){
    "use strict";

    const url = '../src/retrieveDishData.php';
    const retrieveAllDish = url + '?retrieveAll';

    const retrieveAll = function(){
        fetch(retrieveAllDish)
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
                function(json){
                    let $viewDishTable =
                        "<table>\n" +
                        "<tbody>\n" +
                        "<tr>\n" +
                        "<th>ID</th>\n" +
                        "<th>Name</th>\n" +
                        "<th>Description</th>\n" +
                        "<th>Category</th>\n" +
                        "<th>Price</th>\n" +
                        "<th>Image</th>\n" +
                        "<th>Availability</th>\n" +
                        "<th>Management</th>\n" +
                        "</tr>";
                    for(var x in json){
                        $viewDishTable += "<tr>\n" +
                            "<td>"+json[x].dishID+"</td>\n" +
                            "<td>"+json[x].dishName+"</td>\n" +
                            "<td>"+json[x].dishDescription+"</td>\n" +
                            "<td>"+json[x].dishCategoryID+"</td>\n" +
                            "<td>"+json[x].dishPrice+"</td>\n" +
                            "<td><img width='350px' height='200px' src='data:image;base64,"+json[x].imageData+"'/></td>\n" +
                            "<td>"+interpretAvailability(parseInt(json[x].dishAvailability))+"</td>\n" +
                            "<td>\n" +
                            "<li><a href=\"/kv6002/dishmanagement.php/edit?id="+json[x].dishID+"\">Edit</a></li>\n" +
                            "<li><a href=\"/kv6002/dishmanagement.php/delete?id="+json[x].dishID+"&imgID="+json[x].dishImg+"\">Delete</a></li>\n" +
                            "<li><a href=\"/kv6002/dishmanagement.php/availability?id="+json[x].dishID+"\">Change Availability</a></li>\n" +
                            "</td>" +
                            "</tr>\n";
                    }
                    $viewDishTable +=
                        "</tbody>\n" +
                        "</table>";
                    document.getElementById("dishDataTable").innerHTML = $viewDishTable;
                }
            )
            .catch(
                function(err){
                    console.log("Something went wrong!", err);
                }
            )
    }

    retrieveAll();
})
//
// function generateImage(imgData){
//     if(imgData != null){
//         return "<img width='350px' height='200px' src='data:image;base64,"+imgData+"'/>";
//     }else{
//         return "<img width='350px' height='200px' src='../assets/not-available.jpg'/>";
//     }
// }

function interpretAvailability(availability){
    if(availability === 0){
        return "Not Available";
    }else{
        return "Available";
    }
}