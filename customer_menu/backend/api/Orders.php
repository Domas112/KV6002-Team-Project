<?php
    require_once('../controllers/OrdersController.php');
    $ordersController = new OrdersController();

    if(isset($_GET['get_orders'])){
        echo $ordersController->getAllOrders();
    }elseif(isset($_GET['get_orders_by_table_id']) && isset($_GET['id'])){
        echo $ordersController->getAllOrdersByTableId($_GET['id']);
    }elseif(isset($_GET['complete_order']) && isset($_GET['id'])){
        $ordersController->completeOrder($_GET['id']);
    }elseif(isset($_GET['get_tables'])){
        echo $ordersController->getAllTables();
    }elseif(isset($_GET['delete_table']) && isset($_GET['id'])){
        $ordersController->deleteTable($_GET['id']);
    }elseif(isset($_GET['post_order'])){
        $jsonData = file_get_contents('php://input');
        $ordersController->postOrder($jsonData);
        echo "something";
    }
?>