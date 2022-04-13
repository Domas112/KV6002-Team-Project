<?php
    require_once("../controllers/DishesController.php");
    // header("Content-Type: Content-Type: application/json");

    $controller = new DishesController();

    if(isset($_GET['category']) && isset($_GET['dishes'])){

        echo $controller->getDishesByCategory($_GET['category']);
        
    }elseif(isset($_GET['category'])){

        echo $controller->getCategories();

    }elseif(isset($_GET['dishId']) && isset($_GET['image'])) {
        
        echo $controller->getImageByDishId($_GET['dishId']); 

    }elseif(isset($_GET['dishId']) && isset($_GET['options'])){

        echo $controller->getAllDishOptions($_GET['dishId']);

    }
    else{
        echo $controller->getAllDishes();
    }

?>