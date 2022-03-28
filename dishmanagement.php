<?php
include "config/config.php";
$request = new Request();

if(substr($request->getPath(),0,3) !== "api") {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>";
}else{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
}

switch($request->getPath()){
    case '':
    case 'view':
        $dishUI = new DishUIController("view");
        break;
    case 'add':
        $dishUI = new DishUIController("add");
        break;
    case 'edit':
        $dishUI = new DishUIController("edit");
        break;
    case 'delete':
        $dishUI = new DishUIController("delete");
        break;
    case 'availability':
        $dishUI = new DishUIController("availability");
        break;
    case 'log':
        $dishUI = new DishUIController("log");
        break;
    case 'api/dish':
        $dishAPI = new RetrieveDishAPI();
        break;
    case 'api/log':
        $logAPI = new RetrieveLogAPI();
        break;
}


