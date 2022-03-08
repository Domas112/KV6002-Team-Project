<?php

    class Database
    {
        private $connection;

        public function __construct(){
            $this->setConnection();
        }

        public function setConnection(){
            try{
                $this->connection = new PDO("mysql:host=localhost;dbname=team_project", "root", "");
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Database Connection Error: " . $e->getMessage();
                exit();
            }
        }

        public function executeSQL($sql, $params=[]){
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }
    }


?>