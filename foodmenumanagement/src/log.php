<?php

class Log
{
    private $userID, $logDescription;

    public function __construct($userID, $logType, $dishID){
        $this->setUserID($userID);
        $this->setLogDescription($logType, $dishID);
    }

    public function setUserID($userID){
        $this->userID = $userID;
    }

    public function getUserID(){
        return $this->userID;
    }

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
        }
    }

    public function getLogDescription(){
        return $this->logDescription;
    }
}