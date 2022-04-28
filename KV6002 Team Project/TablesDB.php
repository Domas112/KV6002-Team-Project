<?php
session_start();
require_once "database.php";
class TableDB extends Database
{
    public function getTable(){
        $database = new Database();
        //sets query 
        $query = 'SELECT DISTINCT(tables.tableID)
        FROM activeOrders
        INNER JOIN tables ON tables.tableID = activeOrders.tableID
        WHERE paid = 0';
        //able to know use the results from query
        $result = $database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)){
        ?>
        <!---creates form and goes to makePayment page once submitted-->
        <form action = "makePayment.php" method="POST">
            <p>Card Payments Only. For cash payments and queries please speak to a member of staff</p>
            <label for = "table">What table are you seated at: </label><br>
            <select name="table" id = "table">
                <!---shows all active tables in a drop down option--->
                <?php foreach($result as $result): ?>
                <option value="<?= $result['tableID']; ?>"><?= $result['tableID']; ?></option>
                <?php 
            endforeach; ?>
            </select>
            <br><br><input type="submit" value="Confirm" class="btn">
        </form>
            <?php
        }
        else{
            echo "no tables active - please speak to a member of staff";
        }
        }

        //used once payment has been made
    public function updateTable(){
        $database = new Database();
        //delete the active order as the customer has paid
        $query = "UPDATE activeOrders 
        SET paid = 1
        WHERE tableID = {$_SESSION['table']}";
        $result = $database->executeSQL($query);
        return $result;
    }
}?>
