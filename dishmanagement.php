<?php
    include "config/config.php";
?>
<!DOCTYPE html>
<html lang="en-gb">
    <head>
        <title>Dish Management</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>  
        <ul>
            <li><a href="/kv6002/dishmanagement.php/view">View</a></li>
            <li><a href="/kv6002/dishmanagement.php/add">Add</a></li>
        </ul>
<?php
    $dishUI = new DishUIController();
?>
    </body>
</html>
