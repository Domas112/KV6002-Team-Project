<?php

/**
 * foodmenucustomer.php
 * The PHP script will be used to retrieve the request path and display the appropriate webpage or response by using
 * ManagementUIController class.
 *
 * @author Teck Xun Tan W20003691
 */

include "config/config.php";
$errorPage = ERROR_BASEPATH;

//Initialise the Request class
$request = new Request("customer");

//Display the appropriate webpage or response
switch($request->getPath()) {
    case '':
    case 'menu':
        $menuUI = new CustomerUIController("menu");
        break;
    default:
        header('Location: '.$errorPage."?error=404");
        break;
}