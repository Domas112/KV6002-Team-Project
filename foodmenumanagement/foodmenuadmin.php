<?php
include "config/config.php";
require "foodmenusession.php";
$request = new Request("admin");
$errorPage = ERROR_BASEPATH;
switch($request->getPath()){
    case '':
    case 'view':
        $dishUI = new DishUIController("view");
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
    default:
        header('Location: '.$errorPage."/404/");
        break;
}


