<?php
    require_once('Database.php');   
    require_once('../models/Order.php');
    class OrdersRepository{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }

        public function insertOrder($order){
            $sql = "
                INSERT INTO activeOrders
                    (dishID, optionID, amount, tableID)
                VALUES
                    (:dishID, :optionID, :amount, :tableID);
            ";
            $this->db->executeSQL($sql, $order);
        }

        public function selectAllOrders(){
            $sql = "
                SELECT
                    ord.orderID, ord.tableID,
                    d.dishName,
                    opt.optionName,
                    ord.amount, ord.completed, ord.viewed
                FROM
                    activeOrders ord
                JOIN dish d ON d.dishID = ord.dishID
                JOIN dishOption opt on opt.optionID = ord.optionID
                ORDER BY ord.tableID;
            ";
            $result = $this->db->executeSQL($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, 'Order');
        }

        public function selectAllOrdersByTableId($tableID){
            $sql = "
                SELECT
                    ord.orderID, ord.tableID,
                    d.dishName,
                    opt.optionName, opt.optionPrice,
                    ord.amount, ord.completed, ord.viewed
                FROM
                    activeOrders ord
                JOIN dish d ON d.dishID = ord.dishID
                JOIN dishOption opt on opt.optionID = ord.optionID
                WHERE ord.tableID = :tableID AND ord.paid = 1
                ORDER BY ord.orderID;
            ";
            $result = $this->db->executeSQL($sql, array('tableID'=>$tableID));
            return $result->fetchAll(PDO::FETCH_CLASS, 'OrderCustomerView');
        }

        public function selectAllTables(){
            $sql = "
                SELECT DISTINCT ao.tableID, t.VIP
                FROM activeOrders ao
                JOIN tables t on t.tableID = ao.tableID;
            ";

            $results = $this->db->executeSQL($sql);
            $response = $results->fetchAll(PDO::FETCH_ASSOC);
            
            return $response;
        }

        public function completeOrder($orderID) {
            $sql = "
                UPDATE activeOrders
                SET completed = 1
                WHERE orderID = :orderID;
            ";
            $this->db->executeSQL($sql, array(
                'orderID'=>$orderID
            ));
        }

        public function deleteTable($tableID){
            $sql = "
                DELETE FROM activeOrders
                WHERE tableID = :tableID;
            ";
            $this->db->executeSQL($sql, array(
                'tableID' => $tableID
            ));
        }

        
        public function viewOrder($tableID){
            $sql = "
                UPDATE activeOrders
                SET viewed = 1
                WHERE tableID = :tableID;
            ";

            $this->db->executeSQL($sql, array(
                'tableID' => $tableID
            ));
        }

        
        public function deleteOrder($orderID){
            $sql = "
                DELETE FROM activeOrders
                WHERE orderID = :orderID;
            ";

            $this->db->executeSQL($sql, array(
                'orderID' => $orderID
            ));
        }
    }
?>