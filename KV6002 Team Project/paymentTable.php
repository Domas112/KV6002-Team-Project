<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="delete_script.js"></script>
<script  src="delete_action.php"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
<?php
//creates the table showing the payment - for admin side
class paymentTable extends Database
{
    function paymentTable(){  
            $database = new Database();
            ?>
            <table class="table table-striped table-bordered table-hover">
            <thead>
        <tr>        
            <th>Payment ID</th>
            <th>Card Details</th>
            <th>Name</th>
            <th>Price</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $query = "SELECT paymentID, cardDetails,customerName, price FROM payment";
            $result = $database->executeSQL($query);
            // output data of each row
            //checks to see if rows can be created - if not then error message shows
            if($result->rowCount() >0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                //rows created from table
                ?>            
             <tr pay_id="<?php echo $row['paymentID']; ?>" >                         
                    <td><?php echo $row['paymentID']; ?></td>
                    <td><?php echo "************".$row['cardDetails']; ?></td>
                    <td><?php echo $row['customerName']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><input type="checkbox" name="payment_id[]" class="delete_customer" value="<?php echo $row["paymentID"]; ?>" /></td>
                </tr> 
                <?php } }else{ ?>
                    <tr><td colspan="5">No records found.</td></tr>
                <?php } ?>
                </table> 
                <div class="row">
		<div class="col-md-2 well">
                    <button type="button" name="btn_delete" id="btn_delete" class="btn btn-success">Delete</button>
                </div>
		</div>
	</div>	
<?php
    }
}?>

