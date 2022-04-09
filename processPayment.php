<?php

require_once 'validateCard.php';
require_once 'TablesDB.php';
require_once 'removeActive.php';

//gets info from textboxes and saves them in variables
$name = $_POST['cardName'];
$number = $_POST['cardNumber'];
$cvc = $_POST['CVC'];
$expiry = $_POST['expiry'];
$postcode = $_POST['postcode'];
$validate = 0;

//check all textboxes have information in them
if ($name != '' && $number != '' && $cvc != '' && $expiry != '' && $postcode != ''){
    $validate = $validate+1;
}

//validates card details through validateCard function
if(validatecard($number) !== false){
    $validate = $validate+1;
}

//check to see if CVC is a three digit number
if(preg_match('/^[0-9]{3}$/', $cvc)){
    $validate = $validate+1;
}

//messages linking to whether the validations are all corrrect or not
if ($validate < 3){
    alert ("incorrect information entered");
    header("location:php://history.go(-1)");
}

if($validate == 3){
    $result = new TableDB();
    $result->updateTable();
    $result = new removeActive();
    $result->removeActive();
    header('Location:PaymentUI.php');
    alert('Payment Processed');
    
}

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>