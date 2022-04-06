<?php
include "config/config.php";
$request = new Request("error");
$err = new ErrorUIController($request->getPath());