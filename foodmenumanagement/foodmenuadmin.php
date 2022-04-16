<?php

/**
 * foodmenuadmin.php
 *
 * The PHP script will be used to retrieve the request path and display the appropriate webpage or response by using
 * ManagementUIController class.
 *
 * @author Teck Xun Tan W20003691
 */

include "config/config.php";
$errorPage = ERROR_BASEPATH;

//Initialise the Request class
$request = new Request("admin");

//Display the appropriate webpage or response
switch($request->getPath()){
    case '':
    case 'view':
        $dishUI = new ManagementUIController("view");
        break;
    case 'log':
        $dishUI = new ManagementUIController("log");
        break;
    case 'api/dish':
        $dishAPI = new RetrieveDishAPI();
        break;
    case 'api/log':
        $logAPI = new RetrieveLogAPI();
        break;
    default:
        header('Location: '.$errorPage."?error=404");
        break;
}


