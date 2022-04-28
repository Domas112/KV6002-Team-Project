<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=401');
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="styles.css" rel="stylesheet">
  <link href="admin.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css'>
  <!-- Importing Scripts -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="logout.js"></script>
  <script src="search.js"></script>  
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
  <title>Reservation Managment</title>
</head>

<body>

  <?php require_once 'script.php'; ?>
  <?php
  ($mysqli = new mysqli(
    'localhost',
    'unn_w19030982',
    'qwerty81',
    'unn_w19030982'
  )) or die(mysqli_error($mysqli));
  ($result = $mysqli->query('SELECT * FROM reservation')) or
    die($mysqli->error);
  ?>


  <div class="container-sm-logo">
    <img src="assets/logo.png" alt="Amaysia Restaurant The Uniquely Asian" id="logo">
  </div>

  <!--Navigation Bar-->
  <div class="nav-container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item is-flex">
            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/adminindex.php">Admin Panel</a>
            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/payment/adminside.php">Payment</a>
            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/feedback/admin.php">Feedback</a>
            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/customer_menu/frontend/staff/index.php">Customer Food</a>
            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/foodmenumanagement/foodmenuadmin.php/view">Food Menu</a>

          </li>
        </ul>
        <div class="d-flex">
          <button class="btn btn-sm logout" onclick="logout()">Logout</button>
        </div>
      </div>
    </nav>
  </div>

  

  <div class="container is-fluid" id="header">
    <h1>Customer Reservations</h1>
    <p>Reservation Management Panel</p>

    <div class="input-group mb-3 is-pulled-right" style="width: fit-content;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">🔍 Search</span>
                </div>
                <input type="text" class="form-control" id="search" name="search" placeholder="Search anything here!" onkeyup="searchFunc()">
            </div>


  </div>


  <div class="table-container container is-fluid">
    <table class="" id="myTable">
      <thead>
        <tr>
          <th scope="col"> First Name </th>
          <th scope="col"> Last Name </th>
          <th scope="col"> Email Address</th>
          <th scope="col"> Phone Number</th>
          <th scope="col"> Date </th>
          <th scope="col"> ID </th>
          <th scope="col"> Time </th>
          <th scope="col"> Actions </th>

        </tr>
      </thead>

      <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
          <td scope="row" data-label="First Name"><?php echo $row['firstName']; ?></td>
          <td scope="row" data-label="Last Name"><?php echo $row['lastName']; ?></td>
          <td scope="row" data-label="Email Address"><?php echo $row['Email']; ?></td>
          <td scope="row" data-label="Phone Number"><?php echo $row['PhoneNumb']; ?></td>
          <td scope="row" data-label="Date"><?php echo $row['date']; ?></td>
          <td scope="row" data-label="ID"><?php echo $row['id']; ?></td>
          <td scope="row" data-label="ID"><?php echo $row['BookingTimee']; ?></td>
          <td scope="row" data-label="Actions">
            <div class="inline-disp">
            <form action="script.php" method="POST" style="display: inline-block">
              <input type="hidden" name="id-to-del" value="<?php echo $row['id']; ?>">
              <button type=submit value='Delete' name='delete' class="button is-danger customvals">
                <i class="fi fi-rr-cross">
                  DELETE
      
                </i>
              </button>
            </form>
            <button class="button is-link js-modal-trigger editbtn customvals" data-target="modal-js-example">
              <i class="fi fi-rr-pencil">

              EDIT
              </i>
            </button>
            </div>
          </td>


        </tr>
      <?php endwhile; ?>



    </table>




    <!--- MODAL HERE -->

    <div id="modal-js-example" class="modal container is-fluid">
      <div class="modal-background"></div>

      <div class="modal-content">
        <div class="box">
          <!-- UPDATE FORM IN HERE -->
          <div class="container is-fluid block">



            <form id="editForm" action="script.php" method="post">


              <div class="field">

                <label for="firstName" class="label">First Name:</label>
                <div class="control has-icons-left">
                  <input type="text" name="first_name" id="firstName" class="input">
                  <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
                  <p class="help is-danger" style="display: none;">This field cannot be left empty</p>
                </div>
              </div>

              <div class="field">
                <label for="lastName" class="label">Last Name:</label>
                <div class="control has-icons-left">
                  <input type="text" name="last_name" id="lastName" class="input" required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
                  <p class="help is-danger" style="display: none;">This field cannot be left empty</p>
                </div>
              </div>

              <div class="field">
                <label for="phone" class="label">Phone Number:</label>
                <div class="control has-icons-left">
                  <input type="text" name="phone" id="phoneno" class="input" required>
                  <span class="icon is-small is-left">
                    <i class="fas fa-phone"></i>
                  </span>
                  <p class="help is-danger" style="display: none;">This field cannot be left empty</p>
                </div>
              </div>


              <div class="field">
                <label for="email" class="label">Email Address:</label>
                <div class="control has-icons-left">
                  <input type="text" name="emaila" id="Email" class="input">
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                  <p class="help is-danger" style="display: none;">This field cannot be left empty</p>
                </div>
              </div>

              <div class="field">
                <label for="IDD" class="label">Id Address:</label>
                <div class="control has-icons-left">
                  <input type="text" name="userid" id="id" class="input">
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                  <p class="help is-danger" style="display: none;">This field cannot be left empty</p>
                </div>
              </div>


              <div class="field">
                <label for="Date" class="label">Date:</label>
                <div class="control">
                  <input type="date"  id="res_date" name="date" class="input">
                  <p class="help is-danger" style="display: none;">This field cannot be left empty</p>

                </div>
              </div>



              <div class="field">
                <label for="Date" class="label">Time:</label>
                <div class="control">
                  <input type="text"  id="time" name="time" class="timepicker input">
                  <p class="help is-danger" style="display: none;">This field cannot be left empty</p>

                </div>
              </div>
              <button class="button primary" name="updateData"> Update</button>

            </form>
          </div>






        </div>
      </div>

      <button class="modal-close is-large" aria-label="close"></button>
    </div>

  </div>



  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
  $('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 1,
    dynamic: false,
});
</script>
  <script>
    $(document).ready(function() {

      $('.editbtn').on('click', function() {

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {

          return $(this).text();
        }).get();




        $('#firstName').val(data[0]);
        $('#lastName').val(data[1]);
        $('#Email').val(data[2]);
        $('#phoneno').val(data[3]);
        $('#date').val(data[4]);
        $('#id').val(data[5]);
        $('#time').val(data[6]);
      });


    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Functions to open and close a modal
      function openModal($el) {
        $el.classList.add('is-active');
      }

      function closeModal($el) {
        $el.classList.remove('is-active');
      }

      function closeAllModals() {
        (document.querySelectorAll('.modal') || []).forEach(($modal) => {
          closeModal($modal);
        });
      }

      // Add a click event on buttons to open a specific modal
      (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
        const modal = $trigger.dataset.target;
        const $target = document.getElementById(modal);

        $trigger.addEventListener('click', () => {
          openModal($target);
        });
      });

      // Add a click event on various child elements to close the parent modal
      (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
        const $target = $close.closest('.modal');

        $close.addEventListener('click', () => {
          closeModal($target);
        });
      });

      // Add a keyboard event to close all modals
      document.addEventListener('keydown', (event) => {
        const e = event || window.event;

        if (e.keyCode === 27) { // Escape key
          closeAllModals();
        }
      });
    });
  </script>

  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="main.js"></script>

</body>

</html>