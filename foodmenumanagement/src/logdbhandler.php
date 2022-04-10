<?php

class LogDBHandler extends Database
{

    public function createLog($log){
        try {
            $query = "INSERT INTO logRecord (username, logDescription)
                  VALUES (:username, :description)";
            $parameter = ["username" => $log->getUserName(),
                "description" => $log->getLogDescription()];
            if (!$this->executeSQL($query, $parameter)) {
                return false;
            } else {
                return true;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function createLogDetails($logID, $logChanges){
        try {
            foreach ($logChanges as $changes) {
                $query = "INSERT INTO logDetail (logID, logChanges) VALUES (:logID, :logChanges)";
                $parameter = ["logID" => $logID, "logChanges" => $changes];
                if (!$this->executeSQL($query, $parameter)) {
                    return false;
                }
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function retrieveLatestLogID($username){
        try {
            $query = "SELECT logID FROM logRecord WHERE username = :username ORDER BY logID DESC LIMIT 1";
            $parameter = ["username" => $username];
            $result = $this->executeSQL($query, $parameter)->fetch();
            if (!empty($result)) {
                return $result[0];
            } else {
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
}