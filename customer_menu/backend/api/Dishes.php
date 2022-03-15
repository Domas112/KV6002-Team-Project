<?php
    require_once("../controllers/DishesController.php");
    // header("Content-Type: Content-Type: application/json");

    $controller = new DishesController();

    if(isset($_GET['category']) && isset($_GET['dishes'])){

        if($_GET['dishes'] == 1){
            echo $controller->getDishesByCategory($_GET['category']);
        }else{
            echo $controller->getCategories();
        }
        
    }elseif(isset($_GET['dishId']) && isset($_GET['image'])) {
        
        if($_GET['image']==1){
            echo $controller->getImageByDishId($_GET['dishId']); 
        }

    }elseif(isset($_GET['dishId']) && isset($_GET['options'])){

        if($_GET['options']==1){
            echo $controller->getAllDishOptions($_GET['dishId']);
        }

    }
    else{
        echo $controller->getAllDishes();
    }

?>