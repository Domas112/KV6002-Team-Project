<?php

class LogDBHandler extends Database
{

    public function createLog($log){
        $query = "INSERT INTO logRecord (userID, logDescription)
                  VALUES (:userID, :description)";
        $parameter = ["userID" => $log->getUserID(),
                      "description" => $log->getLogDescription()];
        if(!$this->executeSQL($query, $parameter)){
            return false;
        }else{
            return true;
        }
    }

    public function createLogDetails($logID, $logChanges){
        foreach($logChanges as $changes){
            $query = "INSERT INTO logDetail (logID, logChanges) VALUES (:logID, :logChanges)";
            $parameter = ["logID" => $logID, "logChanges" => $changes];
            if(!$this->executeSQL($query,$parameter)){
                return false;
            }
        }
        return true;
    }

    public function retrieveLatestLogID($userID){
        $query = "SELECT logID FROM logRecord WHERE userID = :userID ORDER BY logID DESC LIMIT 1";
        $parameter = ["userID" => $userID];
        $result = $this->executeSQL($query,$parameter)->fetch();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }
}