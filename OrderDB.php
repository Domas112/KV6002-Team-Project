<?php
class Order extends Database
{
    function getOrder(){
        $table = $_POST['table'];
        $database = new Database();
        $query = "SELECT dishOption.optionName
        FROM ActiveOrders
        INNER JOIN dishOption ON dishOption.optionID = ActiveOrders.optionID
        INNER JOIN Tables ON Tables.ID = ActiveOrders.TableID
        WHERE Tables.Active = 1 AND Tables.ID = {$table}";
        $result = $database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $result): 
        echo $result['optionName'],"</br>"; 
            endforeach; 
            
}
}