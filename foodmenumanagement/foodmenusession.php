<?php
session_start();
$errorPage = ERROR_BASEPATH;
if(!isset($_SESSION['username'])){
    header('Location: '.$errorPage."/401/");
}else{
    if($_SESSION['accountType'] != 1){
        header('Location: '.$errorPage."/403/");
    }else{
        $isAuthenticated = true;
    }
}