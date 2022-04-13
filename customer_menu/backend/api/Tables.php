<?php
    require_once('../controllers/TablesController.php');
    $tablesController = new TablesController();

    if(isset($_GET['get_tables'])){
    
        echo $tablesController->getAllTables();
    
    }elseif(isset($_GET['delete_table']) && isset($_GET['id'])){
    
        $tablesController->deleteTable($_GET['id']);

    }elseif(isset($_GET['post_table'])){
    
        $jsonData = file_get_contents('php://input');
        $tablesController->postTable($jsonData);
    
    }elseif(isset($_GET['update_table'])){
    
        $jsonData = file_get_contents('php://input');
        $tablesController->updateTable($jsonData);
    
    }elseif(isset($_GET['get_table_ids'])){
        echo $tablesController->getAllTableIds();
    }
?>