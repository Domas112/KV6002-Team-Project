<!-- Gokul Gampala @ Team 30 | w18031735 | Northumbria University | Team Project and Professionalism KV6002-->
<!doctype html>
<html lang="en">
<head>
    <!-- Name of the Website displayed on the browser tab -->
    <title>Customer Feedback</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Importing CSS -->
    <link href="admin.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Importing Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
    <!-- Displays the logo and name of the company ,Begin-->
    <div class="container col-sm col-md col-lg col-xl" id="logodiv">
        <img src="Images/logo.PNG" alt="Amaysia Restaurant The Uniquely Asian" id="logo">
    </div>
    <!-- Displays the logo and name of the company ,End-->
    <!-- Deleting of the Query(Delete button function) ,Begin-->
    <div id="deleted">
    <?php
    include 'database_conn.php';	  // makes db connection

    $feedbackID = $_GET["id"];
    $sql = ("DELETE FROM feedback WHERE feedbackID= '$feedbackID'");

    if ($dbConn->query($sql) === TRUE) {
        echo "<p>Record has been deleted successfully. Please go to Customer Feedback Page by clicking below.</p>"; echo "<a href='http://unn-w19030982.newnumyspace.co.uk/kv6002/feedback/admin.php'> Go back to the feedback page</a>";
    } else {
        echo "Error deleting record: " . $dbConn->error;
    }

    $dbConn->close();
    ?>
    </div>
    <!-- Deleting of the Query(Delete button function) ,End-->
    <!-- Footer content of the Website such as copyrights info, page name and developer name, Begin -->
    <footer class="container-fluid">
        <hr>
        <p>© Amaysia Restaurant | Customer Feedback | Developed by Team 30 </p>
    </footer>
    <!-- Footer content of the Website such as copyrights info, page name and developer name, End -->
</body>
</html>
