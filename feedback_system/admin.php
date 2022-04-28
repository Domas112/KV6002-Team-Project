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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Importing Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="jquery.dataTables.js"></script>
    <script type="text/javascript" src="dataTables.scrollingPagination.js"></script>
    <!-- Importing icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Displays the logo and name of the company ,Begin-->
    <div class="container col-sm col-md col-lg col-xl" id="logodiv">
        <img src="Images/logo.PNG" alt="Amaysia Restaurant The Uniquely Asian" id="logo">
    </div>
    <!-- Displays the logo and name of the company ,End-->
    <!-- Black with white text -->
    <nav class="navbar navbar-expand-lg" >
            <ul>
                <li>
                    <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/adminindex.php">Admin Panel</a>
                </li>
                <li>
                    <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/customer_menu/frontend/staff/index.php">Customer Food Ordering</a>
                </li>
                <li>
                    <a class="active" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/feedback/admin.php">Feedback</a>
                </li>
                <li>
                    <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/foodmenumanagement/foodmenuadmin.php/view">Food Menu Management</a>
                </li>
                <li>
                    <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/payment/adminside.php">Payment</a>
                </li>
                <li>
                    <a href="http://unn-w19030982.newnumyspace.co.uk/kv6002/reservsys/view.php">Reservation Management</a>
                </li>
                <li>
                <a id="logout" href=http://unn-w19030982.newnumyspace.co.uk/kv6002/account/login.php">Logout</a>

                </li>
            </ul>
    </nav>
    <!-- Top navigation for the website, End-->
    <!-- Header Image and heading of the page, Begin-->
    <div class="container col-sm col-md col-lg col-xl" id="header">
        <img src="Images/feedbackadmin.png" alt="Customer Feedback" id="custfeedbackimg">
        <h1>Customer Feedback</h1>
        <p>Customer feedback collected through feedback form</p>
    </div>
    <!-- Header Image and heading of the page, End-->
    <!-- Customer Feedback Table showing data from the feedback collected from customer, Begin-->
    <div class="container col-sm col-md col-lg col-xl" id="header">
        <table class="table table-bordered table-hover" id="myList">
            <thead id="tablehead">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Image</th>
                    <th>Suggestion</th>
                    <th>Net Promoter Score</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="table-warning" id="myList">

                <?php
                include 'database_conn.php';	  // makes db connection

                $sql = "SELECT feedbackID, name, email, rating, review, image, suggestion, nps
                        FROM feedback 
                        ORDER BY feedbackID Desc";
                $queryResult = $dbConn->query($sql);

                // Check for and handle query failure
                if($queryResult === false) {
                    echo "<p>Query failed: ".$dbConn->error."</p>\n";
                    exit;
                }

                // Otherwise fetch all the rows returned by the query one by one
                else {
                    if ($queryResult->num_rows > 0) {
                        while ($rowObj = $queryResult->fetch_object()) {
                            echo "<tr>
                                      <td>{$rowObj->feedbackID}</td>
                                      <td>{$rowObj->name}</td>
                                      <td>{$rowObj->email}</td>
                                      <td>{$rowObj->rating}</td>
                                      <td>{$rowObj->review}</td>
                                      <td><img width='426px' height='240px' src='data:image;base64,{$rowObj->image}'/></td>
                                      <td>{$rowObj->suggestion}</td>
                                      <td>{$rowObj->nps}</td>
                                      <td>
                                      <a class='btn btn-danger' href=delete.php?id={$rowObj->feedbackID} style='vertical-align:middle' id='delete'>
                                      <i class='fa fa-trash'></i> Delete</a>  
                                      </td>
                                  </tr>
                
                              ";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Customer Feedback Table showing data from the feedback collected from customer, Begin-->
    <!-- Script for styling, search fucntion nad pagination of the table , Begin-->
    <script>
    $(document).ready( function () {
        $('#myList').dataTable({});
    } );
    </script>
    <!-- Script for styling, search fucntion nad pagination of the table , End-->
    <!-- Footer content of the Website such as copyrights info, page name and developer name, Begin -->
    <footer class="container-fluid">
        <hr>
        <p>© Amaysia Restaurant | Customer Feedback | Developed by Team 30 </p>
    </footer>
    <!-- Footer content of the Website such as copyrights info, page name and developer name, End -->
</body>
</html>
