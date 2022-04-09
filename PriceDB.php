<?php
class Price extends Database
{
    function getPrice(){
        $database = new Database();
        //query which will get the sum of the price depending on the table 
        $query = "SELECT SUM(dishOption.OptionPrice)
        FROM ActiveOrders
        INNER JOIN dishOption ON dishOption.optionID = ActiveOrders.optionID
        INNER JOIN Tables ON Tables.ID = ActiveOrders.TableID
        WHERE Tables.Active = 1 AND Tables.ID = {$_SESSION['table']}";
        $result = $database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $result):
            //print the sum to the customer to pay
            echo $result["SUM(dishOption.OptionPrice)"];
        endforeach; ?>
    <?php
    }
}