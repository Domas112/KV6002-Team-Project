<?php

class LogDBHandler extends Database
{
    public function createLog($log){
        $query = "INSERT INTO logRecord (userID, logDescription)
                  VALUES (:userID, :description)";
        $parameter = ["userID" => $log->getUserID(),
                      "description" => $log->getLogDescription()];
        $this->executeSQL($query, $parameter);
    }
}