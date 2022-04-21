<?php
    require_once('Database.php');   
    require_once('../models/Table.php');
    class TablesRepository{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }

        public function selectAllTables(){
            $sql = "
                SELECT
                    tableID, seatCount, VIP, active
                FROM tables;
            ";
            $result = $this->db->executeSQL($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, 'Table');
        }

        public function insertTable($table){
            $sql = "
                INSERT INTO tables
                    (seatCount, VIP)
                VALUES
                    (:seatCount, :VIP);
            ";
            $this->db->executeSQL($sql, $table);
        }

        public function deleteTable($id){
            $sql = "
                DELETE FROM 
                    tables
                WHERE tableID = :tableID;

                SET @m = (SELECT MAX(tableID) + 1 FROM tables);
                SET @s = CONCAT('ALTER TABLE tables AUTO_INCREMENT=', @m);
                PREPARE stmt1 FROM @s;
                EXECUTE stmt1;
                DEALLOCATE PREPARE stmt1;
            ";
            $this->db->executeSQL($sql, array("tableID"=>$id));
        }

        public function updateTable($updatedTable){
            $sql = "
                UPDATE tables
                SET 
                    seatCount = :seatCount,
                    VIP = :VIP
                WHERE tableID = :tableID
            ";
            $this->db->executeSQL($sql, $updatedTable);
        }

        public function selectAllTableIds(){
            $sql = "
                SELECT tableID FROM tables
            ";

            $results = $this->db->executeSQL($sql);
            $response = $results->fetchAll(PDO::FETCH_ASSOC);
            
            return $response;
        }

    }
?>