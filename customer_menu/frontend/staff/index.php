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
        <div class='px-2 py-4'>
                <img id="logo" src="../../resources/images/Logo.png" alt="Amaysia logo" />
        </div>

        <div class="px-4 nav-container">
            <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../../../adminindex.php">Back to Admin Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../tablemanagement">Table management system</a>
                        </li>
                    </ul>
                    <div class="form-inline">
                        <button class="btn btn-sm logout">Logout</button>
                    </div>
                </div>
            </nav>
        </div>
    
	</header>
    <main class="container">
        <div class='pt-2'>
            <tables-lists-component/>
        </div>
    </main>
    <footer>

    </footer>
    <script src="js/main.js" type="module"></script>

</body>
</html>