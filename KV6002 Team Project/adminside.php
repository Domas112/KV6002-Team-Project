<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=401');
    }
    
    if (isset($_SESSION['accountType'])) {
        if($_SESSION['accountType'] != 1){
            header('Location: http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=403');       
        }
    }    
?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
<link rel="stylesheet" href="styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Payment - Admin</title>
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
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../adminindex.php">Back</a>
                        </li>
                    </ul>
                    <div class="form-inline">
                        <input type = "button" onclick="location='logout.php'" value="Logout"/>
                    </div>
                </div>
            </nav>
        </div>
        <div class = "header">
            <h2>Payment - Admin</h2>
        </div>
    <div class = "middle">
        <?php
        require_once "database.php";
            require_once "paymentTable.php";
            $result = new paymentTable();
        ?>
</div>
<footer class="footer">
    <p>© Amaysia Restaurant | Order Summary </p>
</div>
        </body>
    </html>