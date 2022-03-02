<?php
include "config/config.php";

echo <<<EOT
<ul>
    <li><a href="?function=view">View</a></li>
    <li><a href="?function=add">Add</a></li>
</ul>
EOT;

if(isset($_GET["function"])){
    $dishUI = new DishUIController($_GET["function"]);
}

//if($_GET["function"] == "view"){
//   echo "<h1>View</h1>";
//}
//else if($_GET["function"] == "add"){
//    echo <<<EOT
//    <h1>Add</h1>
//    <form method="post">
//        <label>Value:</label>
//        <input type="text" name="value" id="value">
//        <input type="submit" value="Submit">
//    </form>
//EOT;
//
//    if(isset($_POST['value'])){
//        $dish = new Dish();
//        $dish->setDishName($_POST['value']);
//        $manageDish->addDish($dish);
//    }
//}
