<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=401');
    }
    
    if (!isset($_SESSION['accountType'])) {
        header('Location: http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=403');       
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Staff site</title>
    <link rel='stylesheet' href='./styles/staff_styles.css'>
    <link rel='stylesheet' href='../shared.css'>
    <script src="https://kit.fontawesome.com/d45f07fbca.js" crossorigin="anonymous"></script>

</head>
<body>
    <header class='sticky-top'>
        <div class='container-sm-logo'>
                <img id="logo" src="../../resources/images/Logo.png" alt="Amaysia logo" />
        </div>

        <div class="nav-container">
            <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../../../adminindex.php">Admin Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Customer Food Ordering</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../feedback/admin.php">Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../foodmenumanagement/foodmenuadmin.php/view">Food Menu Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../payment/adminside.php">Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../reservsys/view.php">Reservation Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../tablemanagement">Table Management</a>
                        </li>
                    </ul>
                    <div class="form-inline">
                        <button class="btn btn-sm logout">Logout</button>
                    </div>
                </div>
            </nav>
        </div>

	</header>
    <main class="container mt-2">
            <h1>Orders Management System</h1>
            <p>Here you can view and manage the incoming orders of each active table</p>
        
        <div class='pt-2'>
            <tables-lists-component/>
        </div>
    </main>
    <footer class='container-fluid'>
        <hr>
        <p>© Amaysia Restaurant | Orders Management | Developed by Team 30 </p>
    </footer>
    <script src="js/main.js" type="module"></script>

</body>
</html>