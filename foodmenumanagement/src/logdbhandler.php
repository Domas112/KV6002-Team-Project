<?php

/**
 * logdbhandler.php
 * The class will be used to handle the log database request such as creating/adding and retrieving.
 *
 * @author Teck Xun Tan W20003691
 */
class LogDBHandler extends Database
{
    /**
     * createLog
     * A function to handle creating new log into Log table in the database
     */
    public function createLog($log){
        try {
            //Preparing query and parameter
            $query = "INSERT INTO logRecord (username, logDescription)
                  VALUES (:username, :description)";
            $parameter = ["username" => $log->getUserName(),
                "description" => $log->getLogDescription()];

            //Execute the query
            if (!$this->executeSQL($query, $parameter)) {
                //Return false if SQL execution caught error and returned false
                return false;
            }

            //Return true if no error occurred
            return true;

        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }

    /**
     * createLogDetails
     * A function to handle creating new log details into the LogDetail table in the database
     */
    public function createLogDetails($logID, $logChanges){
        try {
            foreach ($logChanges as $changes) {
                //Preparing query and parameter
                $query = "INSERT INTO logDetail (logID, logChanges) VALUES (:logID, :logChanges)";
                $parameter = ["logID" => $logID, "logChanges" => $changes];

                //Execute the query
                if (!$this->executeSQL($query, $parameter)) {
                    //Return false if SQL execution caught error and returned false
                    return false;
                }
            }

            //Return true if no error occurred
            return true;

        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }

    /**
     * retrieveLatestLogID
     * A function to retrieve latest log's ID from the database
     */
    public function retrieveLatestLogID($username){
        try {
            //Preparing query and parameter
            $query = "SELECT logID FROM logRecord WHERE username = :username ORDER BY logID DESC LIMIT 1";
            $parameter = ["username" => $username];

            //Execute the query
            $result = $this->executeSQL($query, $parameter)->fetch();

            if (!empty($result)) {
                //Return the result if result is not empty
                return $result[0];
            } else {
                //Return false if the result is empty or caught error
                return false;
            }

        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }
}