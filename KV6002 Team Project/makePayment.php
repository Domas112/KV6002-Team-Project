<!DOCTYPE html>
<html lang="en-gb">
<head>
    <link rel="stylesheet" href="styles.css">
        <title>Make Payment</title>
        <meta charset="utf-8">
</head>
<body> 
    <div class = "container">   
    <div class="header">
        <img scr="./kv6002/payment/images/AmaysiaLogo.png"/>
    </div>
    <div class = "nav">
        <a href="#home">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
    </div>
    <div class ="middle">
    <h2>Order Summary</h2>

    <?php
    require "database.php";
    require_once "OrderDB.php";
    require_once "PriceDB.php";
    require_once "TablesDB.php";
    //table number saved to be used in session - as used throughout process
    $_SESSION['table'] = $_POST['table'];
    //used to call function to show order summary
    $result = new Order();
    $result->getOrder();
    ?>
    <p>Amount Due</p>
    <?php
    //used to call function to show price
    $result = new Price();
    $result->getPrice();
    //form for payment details - linking to validation check once submitted
    ?>
    <p>Payment Details</p>
    <form action = "processPayment.php" method="post">
    <input type="text" id="cardName" name="cardName" placeholder="Name on Card"><br><br> 
    <input type="integer" id="cardNumber" name="cardNumber" placeholder="Card Number"><br><br> 
    <input type="integer" id="CVC" name="CVC" placeholder="CVC"><br><br> 
    <input type ="date" id="expiry" name="expiry" placeholder="expiry date"><br><br>
    <input type="char" id="postcode" name="postcode" placeholder="Postcode"><br><br> 
    <input type="submit">
</form>
</body>
</div>
<div class = "footer">
    <p>footer</p>
</div>
</div>
    </html>