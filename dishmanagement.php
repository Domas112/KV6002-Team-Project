<?php
    include "config/config.php";
?>
<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <title>Dish Management</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>  
        <ul>
            <li><a href="?function=view">View</a></li>
            <li><a href="?function=add">Add</a></li>
        </ul>
<?php
    if(isset($_GET["function"])){
        $dishUI = new DishUIController($_GET["function"]);
    }
?>
    </body>
</html>
