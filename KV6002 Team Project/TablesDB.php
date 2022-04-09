<?php
session_start();
require_once "database.php";
class TableDB extends Database
{
    public function getTable(){
        $database = new Database();
        //sets query 
        $query = 'SELECT ID FROM Tables WHERE Active = 1';
        //able to know use the results from query
        $result = $database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!---form when submitted goes to payment screen--->
        <form action = "makePayment.php" method="POST">
            <label for = "table">What table are you seated at: </label><br>
            <select name="table" id = "table">
                <!---prints all results from query in a drop down option--->
                <?php foreach($result as $result): ?>
                <option value="<?= $result['ID']; ?>"><?= $result['ID']; ?></option>
                <?php 
            endforeach; ?>
            </select>
            <br><button type="submit" name = "selection">Next</button>
        </form>
            <?php
        }

    public function updateTable(){
        $database = new Database();
        //delete the active order as the customer has paid
        $query = "DELETE FROM ActiveOrders 
        WHERE TableID = {$_SESSION['table']}";
        $result = $database->executeSQL($query);
        return $result;
    }
}?>
