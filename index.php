<!DOCTYPE html>
<html>

<head>
  <title>Book A Reservation</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="styles.css" rel="stylesheet">
  <link href="admin.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" integrity="sha512-LT9fy1J8pE4Cy6ijbg96UkExgOjCqcxAC7xsnv+mLJxSvftGVmmc236jlPTZXPcBRQcVOWoK1IJhb1dAjtb4lQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css" integrity="sha512-GgUcFJ5lgRdt/8m5A0d0qEnsoi8cDoF0d6q+RirBPtL423Qsj5cI9OxQ5hWvPi5jjvTLM/YhaaFuIeWCLi6lyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Importing Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/2ec1e6a122.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

  <script src="formfuncs.js"></script>
  <script>
  $( function() {
    $( "#res_date" ).datepicker({ minDate: 0, dateFormat: 'yy-mm-dd'});
  } );
  </script>



</head>

<body>
  <?php require_once 'script.php'; ?>
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
                        <li class="nav-item">
                            <a class="nav-link" href="foodmenumanagement/foodmenucustomer.php">Our Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link is-bold" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/reservsys/index.php" style="background: #5b3928; color: #fff;">Make a Reservation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/feedback/feedbackform.php">Give Us a Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/payment/PaymentUI.php">Pay Online</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/account/login.php">Employee Portal</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

  <section class="section custom">
    <h1 class="title">Reservation Page</h1>
    <h3 class="subtitle">
      Please use the following form to book your future reservations with us.
    </h3>
  </section>




  <div class="container is-fluid">

    <form id="resBook" action="script.php" method="post">
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
          <input type="email" name="emaila" id="emailA" required id="email" class="input">
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
          <p class="help is-danger email" style="display: none;" id="errormsg">This field cannot be left empty</p>
        </div>
      </div>


      <div class="field">
        <label for="Date" class="label">Date:</label>
        <div class="control">
          <input type="input" id="res_date" name="date" class="input" required>
          <p class="help is-danger" style="display: none;">This field cannot be left empty</p>

        </div>
      </div>





<input class="timepicker text-center input" name="time">

<div class="sbt-div">
      <input type="submit" value="Submit" name="save" id="button" onclick="validateFields()" class="btn-btn-large"></div>

    </form>
  </div>




  <footer class="container-fluid">
        <hr>
        <p>© Amaysia Restaurant | Homepage | Developed by Team 30 </p>
    </footer>


  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
  $('.timepicker').timepicker({
    timeFormat: 'h:mm',
    interval: 10,
    defaultTime: '12',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
</script>
  <script>
    function validateFields() {

      var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      var numberrs = /^[0-9]+$/;
      var first_name = document.getElementById('firstName').value;
      var last_name = document.getElementById('lastName').value;
      var phone_no = document.getElementById('phoneno');
      var email = document.getElementById('emailA').value;
      var error_message = document.getElementById('errormsg');

      if(isNaN(phone_no.value)) {
        Toastify({
          text: "Please provide a valid phone number - ",
          duration: 1000,
          close: true,
          gravity: "top", // `top` or `bottom`
          position: "right", // `left`, `center` or `right`
          stopOnFocus: true,
          style: {
            background: "red",
          },
        }).showToast();
      }

      if (!email.match(validRegex)) {
        Toastify({
          text: "Please enter a valid email address",
          duration: 3000,
          close: true,
          gravity: "top", // `top` or `bottom`
          position: "right", // `left`, `center` or `right`
          stopOnFocus: true,
          style: {
            background: "red",
          },
        }).showToast();
      }
       if (first_name.length === 0 && last_name.length === 0) {
        Toastify({
          text: "Please provide a first & last name.",
          duration: 3000,
          close: true,
          gravity: "top", // `top` or `bottom`
          position: "right", // `left`, `center` or `right`
          stopOnFocus: true,
          style: {
            background: "red",
          },
        }).showToast();
      }

      

 
    }

    

  </script>
</body>

</html>