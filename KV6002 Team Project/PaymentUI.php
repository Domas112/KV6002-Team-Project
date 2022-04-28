<!DOCTYPE html>
<html lang="en-gb">
<head>
    <link rel="stylesheet" href="styles.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <title>Payment</title>
    <meta charset="utf-8">
    <?php 
    require_once "database.php";
    require_once "TablesDB.php";?>
</head>
<body>  
        <div class="logo-header">
            <img id="logo" src="Logo.png" alt="picture"/>
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
                            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/account/login.php">Employee Portal</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class = "header">
            <h2>Payment</h2>
        </div>
        <div class="middle">
        <div class="row">
        <div class="container">
        <div class="col-50">
            <div class = "table">
            <?php 
            $result = new TableDB();
            $result->getTable();
            ?>
            </div>
            </div>
            </div>
            </div>
            <br>
        </div>  
        <div class = "footer">
            <p>© Amaysia Restaurant | Payment </p>
        </div>
</body>
</html>