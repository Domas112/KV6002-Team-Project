<?php
    require_once('Database.php');   
    require_once('../models/Order.php');
    class OrdersRepository{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }

        public function insertOrder(array $order) : void{
            $sql = <<<SQLSTMT
                INSERT INTO activeorders
                (dishID, optionID, amount, tableID)
                VALUES
                (:dishID, :optionID, :amount, :tableID);
            SQLSTMT;
            $this->db->executeSQL($sql, $order);
        }

        public function selectAllOrders() : array{
            $sql = <<<SQLSTMT
                SELECT
                    ord.orderID, ord.tableID,
                    d.dishName,
                    opt.optionName,
                    ord.amount, ord.completed
                FROM
                    activeorders ord
                JOIN dish d ON d.dishID = ord.dishID
                JOIN dishoption opt on opt.optionID = ord.optionID
                ORDER BY ord.tableID;
            SQLSTMT;
            $result = $this->db->executeSQL($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, 'Order');
        }

        public function selectAllOrdersByTableId(int $tableID) : array|false{
            $sql = <<<SQLSTMT
                SELECT
                    ord.orderID, ord.tableID,
                    d.dishName,
                    opt.optionName, opt.optionPrice,
                    ord.amount, ord.completed
                FROM
                    activeorders ord
                JOIN dish d ON d.dishID = ord.dishID
                JOIN dishoption opt on opt.optionID = ord.optionID
                WHERE ord.tableID = :tableID
                ORDER BY ord.orderID;
            SQLSTMT;
            $result = $this->db->executeSQL($sql, array('tableID'=>$tableID));
            return $result->fetchAll(PDO::FETCH_CLASS, 'OrderCustomerView');
        }

        public function selectAllTableIds() : array{
            $sql = <<<SQLSTMT
                SELECT DISTINCT tableID FROM activeorders
            SQLSTMT;

            $results = $this->db->executeSQL($sql);
            $response = $results->fetchAll(PDO::FETCH_ASSOC);
            
            return $response;
        }

        public function completeOrder(int $orderID) : void {
            $sql = <<<SQLSTMT
                UPDATE activeorders
                SET
                    completed = 1
                WHERE
                    orderID = :orderID;
            SQLSTMT;
            $this->db->executeSQL($sql, array(
                'orderID'=>$orderID
            ));
        }
    }
?>