<?php

/**
 * log.php
 * The class is used for handling log object using setter and getter methods
 *
 * @author Teck Xun Tan W20003691
 */
class Log
{
    private $userName, $logDescription;

    /**
     * Default constructor to preset some of the variable of the object.
     */
    public function __construct($username, $logType, $dishID){
        $this->setUserName($username);
        $this->setLogDescription($logType, $dishID);
    }

    /**
     * setUserName
     * A setter function for setting the username variable
     */
    public function setUserName($userName){
        $this->userName = $userName;
    }

    /**
     * getUserName
     * A getter function for retrieving the username variable
     */
    public function getUserName(){
        return $this->userName;
    }

    /**
     * setUserName
     * A setter function for setting the description variable to an appropriate message depending on the log type
     * (e.g. add, edit, delete or availability)
     */
    public function setLogDescription($logType,$dishName){
        switch($logType){
            case "add":
                $this->logDescription = "New dish \"".$dishName."\" has been added";
                break;
            case "edit":
                $this->logDescription =  "Dish \"".$dishName."\" has been edited";
                break;
            case "delete":
                $this->logDescription = "Dish \"".$dishName."\" has been deleted";
                break;
            case "availability":
                $this->logDescription = "Dish \"".$dishName."\" availability has been changed";
                break;
        }
    }

    /**
     * getLogDescription
     * A setter function for retrieving the log description variable
     */
    public function getLogDescription(){
        return $this->logDescription;
    }
}