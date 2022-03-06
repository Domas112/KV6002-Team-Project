<?php
try{
    require_once('../src/database.php');

    if(isset($_REQUEST['retrieveAll'])){
        echo retrieveAllDish();
    }
}
catch (Exception $e){
    throw new Exception("Error" . $e->getMessage(), 0, $e);
}

function retrieveAllDish(){
    $database = new Database();
    try{
        $result = $database->executeSQL("SELECT * FROM dish")->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json; charset=UTF-8");
        return json_encode($result);
    }
    catch (Exception $e){
        return "Error: " . $e->getMessage();
    }
}