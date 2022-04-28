<?php
//php for deleteion of row on pyament table.
//used once called from payment button being pressed - admin side
$post_ids = $_POST['pay_id'];
 foreach($post_ids as $paymentID)
 {
    $database = new Database();
    $query = "DELETE FROM payment WHERE paymentID = '$paymentID'";
    mysqli_query($connect, $query);
    $result = $database->executeSQL($query);
    //header("delete_action.php");
 }
echo 1;
?>
