<?php
include "config/config.php";
$request = new Request();

switch($request->getPath()) {
    case '':
    case 'menu':
        break;
}