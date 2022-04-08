<?php

class Test extends Database
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->getLogID()){
            echo "null";
        }else{
            echo $this->getLogID();
        }
    }

    public function getLogID(){
        $query = "SELECT logID FROM logRecord WHERE userID = :userID ORDER BY logID DESC LIMIT 1";
        $parameter = ["userID" => 1];
        $result = $this->executeSQL($query,$parameter)->fetch();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }
}