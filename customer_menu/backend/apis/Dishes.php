<?php
    // require_once(dirname(__DIR__)."/controllers/DishesController.php");
    require_once("../controllers/DishesController.php");

    $controller = new DishesController();

    if(isset($_GET['category'])){
        echo $controller->getDishesByCategory($_GET['category']);
    }elseif(isset($_GET['id']) && isset($_GET['image'])) {
        if($_GET['image']==1){
            echo $controller->getImageByDishId($_GET['id']); 
        }
    }
    else{
        echo $controller->getAllDishes();
    }

?>