<?php

require_once 'validateCard.php';
require_once 'TablesDB.php';
require_once 'adminPaymentDB.php';
?>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> 


<?php
//gets info from textboxes and saves them in variables
$name = $_POST['cardName'];
$number = $_POST['cardNumber'];
$cvc = $_POST['CVC'];
$month = $_POST['month'];
$year = $_POST['year'];
$postcode = $_POST['postcode'];
$validate = 0;

//check all textboxes have information in them
if ($name != '' && $number != '' && $cvc != '' && $month != '' && $year != '' && $postcode != ''){
    $validate = $validate+1;
}

//validates card details through validateCard function
if(validatecard($number) !== false){
    $validate = $validate+1;
}else{
    echo alert("Incorrect card format. Please check again");
}

//check to see if CVC is a three digit number
if(preg_match('/^[0-9]{3}$/', $cvc)){
    $validate = $validate+1;
}

//messages linking to whether the validations are all corrrect or not
if ($validate < 3){
    $message = "Incorrect Information";

   header("location:php://history.go(-1)");
   // echo alert("Incorrect Information");
    //echo "<script> php://history.go(-1) </script>";
}

if($validate == 3){
    $result = new TableDB();
    $result->updateTable();
    $result = new PaymentDB();
    $result->addPayment();
    echo alert("Payment Successful");
    echo "<script> window.location.href='PaymentUI.php' </script>";   
}   

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>