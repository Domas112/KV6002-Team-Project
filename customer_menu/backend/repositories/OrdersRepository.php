<?php
    require_once('Database.php');   
    class OrdersRepository{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }

        public function insertOrder($orders){
            $sql = <<<SQLSTMT
                INSERT INTO activeorders
                (dishID, optionID, amount, tableID)
                VALUES
                (:dishID, :optionID, :amount, 1);
            SQLSTMT;
            $this->db->executeSQL($sql, $orders);
        }
    }
?>