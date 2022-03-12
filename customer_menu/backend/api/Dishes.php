<?php
    require_once("../controllers/DishesController.php");
    // header("Content-Type: Content-Type: application/json");

    $controller = new DishesController();

    if(isset($_GET['category'])){
        echo $controller->getDishesByCategory($_GET['category']);
    }elseif(isset($_GET['id']) && isset($_GET['image'])) {
        if($_GET['image']==1){
            print_r($controller->getImageByDishId($_GET['id'])); 
        }
    }
    else{
        echo $controller->getAllDishes();
    }

?>