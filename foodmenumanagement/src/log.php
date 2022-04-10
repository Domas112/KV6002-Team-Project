<?php

class Log
{
    private $userName, $logDescription;

    public function __construct($username, $logType, $dishID){
        $this->setUserName($username);
        $this->setLogDescription($logType, $dishID);
    }

    public function setUserName($userName){
        $this->userName = $userName;
    }

    public function getUserName(){
        return $this->userName;
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
            case "availability":
                $this->logDescription = "Dish \"".$dishName."\" availability has been changed";
                break;
        }
    }

    public function getLogDescription(){
        return $this->logDescription;
    }
}