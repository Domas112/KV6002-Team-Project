<?php

class LogDBHandler extends Database
{

    public function createLog($log){
        $query = "INSERT INTO logRecord (userID, logDescription)
                  VALUES (:userID, :description)";
        $parameter = ["userID" => $log->getUserID(),
                      "description" => $log->getLogDescription()];
        if($this->executeSQL($query, $parameter)){
            return true;
        }else{
            return false;
        }
    }

    public function createLogDetails($logID, $logChanges){
        foreach($logChanges as $changes){
            $query = "INSERT INTO logDetail (logID, logChanges) VALUES (:logID, :logChanges)";
            $parameter = ["logID" => $logID, "logChanges" => $changes];
            $result = $this->executeSQL($query,$parameter);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    public function retrieveLatestLogID($userID){
        $query = "SELECT logID FROM logRecord WHERE userID = 1 ORDER BY logID DESC LIMIT 1";
        $result = $this->executeSQL($query);
        foreach($result as $row){
            return $row['logID'];
        }
    }
}