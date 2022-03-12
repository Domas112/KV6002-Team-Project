<?php

class DishOptionDBHandler extends Database
{
    public function uploadDishOption($dishID,$dishOption,$dishPrice){
        foreach($dishOption as $index => $optionName){
            $query = "INSERT INTO dishOption (dishID, optionName, optionPrice)
                      VALUES (:dishID, :optionName, :optionPrice)";
            $parameter = ["dishID" => $dishID, "optionName" => $optionName, "optionPrice" => $dishPrice[$index]];
            $this->executeSQL($query, $parameter);
        }
    }

    public function editDishOption($optionID,$optionName,$optionPrice){
        foreach($optionID as $index => $id){
            $query = "UPDATE dishOption SET optionName = :optionName,
                                            optionPrice = :optionPrice
                      WHERE optionID = :id";
            $parameter = ["id" => $id, "optionName" => $optionName[$index], "optionPrice" => $optionPrice[$index]];
            $this->executeSQL($query, $parameter);
        }
    }
}