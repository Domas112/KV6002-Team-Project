<?php
    require_once('../controllers/OrdersController.php');
    $ordersController = new OrdersController();

    $jsonData = file_get_contents('php://input');

    $ordersController->postOrder($jsonData);
    // Converts it into a PHP object
    // echo uniqid();

?>