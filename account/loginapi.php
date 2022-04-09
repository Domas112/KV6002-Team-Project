<?php
include "config/config.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$authentication = new AuthenticationAPI();