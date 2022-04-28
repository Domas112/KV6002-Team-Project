<!DOCTYPE html>
<html lang="en-gb">
<head>
<link rel="stylesheet" href="styles.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Make Payment</title>
        <meta charset="utf-8">
</head>
<body>   
        <div class="logo-header">
            <img id="logo" src="Logo.png"/>
        </div>
        <div class="nav-container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Home</a>
                        </li>
                        <li>
                            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/foodmenumanagement/foodmenucustomer.php">Our Menu</a>
                        </li>
                        <li>
                            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/reservsys/index.php">Make a Reservation</a>
                        </li>
                        <li>
                            <a class="nav-link"  href="http://unn-w19030982.newnumyspace.co.uk/kv6002/feedback/admin.php">Give Us a Feedback</a>
                        </li>
                        <li>
                            <a class="nav-link" class="active" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/payment/PaymentUI.php">Pay Online</a>
                        </li>
                        <li>
                            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/account/login.php">Employee Portal</a>
                        </li>
                                    </ul>
                </div>
            </nav>
        </div>
        <div class = "header">
            <h2>Order Summary</h2>
            <p>Any queries regarding the order summary or price then please speak to a member of staff</p>
        </div>
    <div class = "middle">
    <?php
    require "database.php";
    require_once "OrderDB.php";
    require_once "PriceDB.php";
    require_once "TablesDB.php";
    //table number saved to be used in session - as used throughout process
    $_SESSION['table'] = $_POST['table'];
    //used to call function to show order summary
    ?> <div class="order"><?php
    $result = new Order();
    $result->getOrder();
    ?>
    </div>
    <div class = "price">
    <p><br>Amount Due</p>
    <?php
    //used to call function to show price
    $result = new Price();
    $result->getPrice();
    //form for payment details - linking to validation check once submitted
    ?>
    </div>
    <br>
    <div class="row">
    <div class="container">
    <div class="col-50">
            <br><h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
    </div>
    <form action = "processPayment.php" id ="paymentForm" method="post">
    <label for="cname">Name on Card</label>
    <input type="text"  name="cardName" placeholder="Name on Card" minlength ="3" required><br> 
    <label for="ccnum">Credit card number</label>
    <input  type="integer" name="cardNumber" placeholder="Card Number" minlength = 16 maxlength = 16 required><br>
    <label for="cvc">CVC</label>
    <input type="integer"  name="CVC" placeholder="CVC" required minlength = 3 maxlength = 3><br> 
    <label for="Expiry Date">Expiry Date: </label>
    <select name="month" id="month">
        <?php
        for($i=1; $i<=12; $i++){
            ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php
            }
            ?>
    </select>
    <select name="year" id="year">
        <?php
        for($i=2022; $i<=2032; $i++){
            ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php
            }
            ?>
    </select>
    <br>
    <label for="postcode">Postcode</label>
    <input type="text" id="postcode" name="postcode" placeholder="Postcode" required><br> 
    <input type="submit" value="Confirm" class="btn">
</form>
        </div>
        </div>
        </div>
        </div>
<footer class="footer">
    <p>© Amaysia Restaurant | Order Summary </p>
        </footer>

    </html>