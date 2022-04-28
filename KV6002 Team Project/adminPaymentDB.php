<?php
class PaymentDB extends Database
{
    function addPayment(){
        require "PriceDB.php";
        require_once "processPayment.php";
        $name = $_POST['cardName'];
        $number = $_POST['cardNumber'];
        $four = substr($number,-4);
        $price = $_SESSION['price'];
        $database = new Database();
        $query = "INSERT INTO payment (price,cardDetails,customerName)
        VALUES ('$price','$four','$name')";
        $result = $database->executeSQL($query);

    }
}