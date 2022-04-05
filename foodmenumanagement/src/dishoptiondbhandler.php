<?php

class DishOptionDBHandler extends Database
{
    public function uploadDishOption($dishID,$dishOption,$dishPrice){
        foreach($dishOption as $index => $optionName){
            $query = "INSERT INTO dishOption (dishID, optionName, optionPrice)
                      VALUES (:dishID, :optionName, :optionPrice)";
            $parameter = ["dishID" => $dishID, "optionName" => $optionName, "optionPrice" => $dishPrice[$index]];
            $result = $this->executeSQL($query, $parameter);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    public function editDishOption($optionID,$dishID,$optionName,$optionPrice){
        foreach($optionID as $index => $id){
            $query = "UPDATE dishOption SET optionName = :optionName,
                                            optionPrice = :optionPrice
                      WHERE optionID = :id AND dishID = :dishID";
            $parameter = ["id" => $id, "dishID" => $dishID, "optionName" => $optionName[$index], "optionPrice" => $optionPrice[$index]];
            $result = $this->executeSQL($query, $parameter);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    public function deleteDishOption($dishID, $optionID){
        foreach(json_decode($optionID) as $id){
            $query = "DELETE FROM dishOption WHERE optionID = :id AND dishID = :dishID";
            $parameter = ["id" => $id, "dishID" => $dishID];
            $result = $this->executeSQL($query, $parameter);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    public function retrieveDishOptionName($optionID){
        $query = "SELECT optionName FROM dishOption WHERE optionID = :id";
        $parameter = ["id" => $optionID];
        $result = $this->executeSQL($query,$parameter);
        foreach($result as $row){
            return $row['optionName'];
        }
    }
}