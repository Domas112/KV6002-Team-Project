<?php
class Price extends Database
{
    //
    function getPrice(){
        $database = new Database();
        //query which will get the sum of the price depending on the table 
        $query = "SELECT SUM(dishOption.optionPrice*activeOrders.amount)
        FROM activeOrders
        INNER JOIN dishOption ON dishOption.optionID = activeOrders.optionID
        INNER JOIN tables ON tables.tableID = activeOrders.tableID
        WHERE  tables.tableID = {$_SESSION['table']} AND activeOrders.paid = 0";
        $result = $database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $result):
            //print the sum to the customer to pay
            $price = $result['SUM(dishOption.optionPrice*activeOrders.amount)'];
            $_SESSION['price']=$price;
            echo $_SESSION['price'];
        endforeach; ?>
    <?php
    }
}