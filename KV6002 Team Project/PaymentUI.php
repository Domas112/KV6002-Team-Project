<!DOCTYPE html>
<html lang="en-gb">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Payment</title>
    <meta charset="utf-8">
    <?php 
    require_once "database.php";
    require_once "TablesDB.php";?>
</head>
<body>  
    <div class = "container">
    <div class="header">
        <img id="logo" scr="../kv6002/payment/images/AmaysiaLogo.png"/>
    </div>
    <div class = "nav">
        <a href="#home">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
    </div>
    <div class="middle">
        <h2>Payment</h2>
        <?php 
        $result = new TableDB();
        $result->getTable();
        ?>
        <br>
    </div>  
    <div class = "footer">
        <p>footer</p>
    </div>
</div>
</body>
</html>