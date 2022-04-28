<?php 


	$mysqli  =  new mysqli('localhost', 'unn_w19030982', 'qwerty81', 'unn_w19030982') or die(mysqli_error($mysqli));
    


	if (isset($_POST['save'])) {
		$firstNname = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $phone_no = $_POST['phone'];
        $email = $_POST['emaila'];
        $date = $_POST['date'];
        $time = $_POST['time'];


        $mysqli->query("INSERT INTO reservation (firstName, lastName, Email, PhoneNumb, date, BookingTimee) VALUES ('$firstNname', 
        '$lastName','$email','$phone_no','$date', '$time')");


		$_SESSION['message'] = "Record saved"; 
		header('location: http://unn-w19030982.newnumyspace.co.uk/kv6002/');
		
	}


    if (isset($_POST['updateData'])) {
		$firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $phone = $_POST['phone'];
        $email = $_POST['emaila'];
        $date = $_POST['date'];
        $id = $_POST['userid'];
        $time = $_POST['time'];




        $mysqli->query("UPDATE reservation SET firstName = '".$firstName."', BookingTimee = '".$time."', lastName = '".$lastName."', Email = '".$email."', 
        PhoneNumb = '".$phone."' 
          WHERE id = '".$id."' ") or die(mysqli_error($mysqli));


		$_SESSION['message'] = "Record saved"; 

		header('location: view.php');
	}



    if (isset($_POST['delete'])) {

      $id_to_delete = $_POST['id-to-del'];
      
        
      $mysqli->query("DELETE from reservation where id = $id_to_delete") or die(mysqli_error($mysqli));


    $_SESSION['message'] = "Record delete"; 

    header('location: view.php');
        
        }


        
