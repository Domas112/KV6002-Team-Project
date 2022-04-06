<?php
include "config/config.php";
$request = new Request("customer");
$errorPage = ERROR_BASEPATH;
switch($request->getPath()) {
    case '':
    case 'menu':
        $menuUI = new CustomerUIController("menu");
        break;
    default:
        header('Location: '.$errorPage."/404/");
        break;
}