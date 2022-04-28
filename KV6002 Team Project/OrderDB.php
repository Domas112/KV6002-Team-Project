<?php
class Order extends Database
{
    function getOrder(){
        $table = $_SESSION['table'];
        $database = new Database();
        $query = "SELECT dishOption.optionName, dish.dishName, dishOption.optionPrice, activeOrders.amount
        FROM activeOrders
        JOIN dish ON dish.dishID = activeOrders.dishID
        JOIN dishOption ON dishOption.optionID = activeOrders.optionID
        JOIN tables ON tables.tableID = activeOrders.tableID
        WHERE  tables.tableID = {$table} AND activeOrders.paid = 0";
        $result = $database->executeSQL($query,array('tableID'=>$table))->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $result): 
        echo $result['amount']," x ",$result['optionName']," ",$result['dishName']," ", $result['optionPrice'],"</br>"; 
            endforeach; 
            
}
}