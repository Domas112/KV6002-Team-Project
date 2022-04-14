<?php

class DishOptionDBHandler extends Database
{
    public function uploadDishOption($dishID,$dishOption,$dishPrice){
        try{
            foreach($dishOption as $index => $optionName){
                if($optionName == "" || $dishPrice[$index] == ""){
                    return false;
                }else{
                    $query = "INSERT INTO dishOption (dishID, optionName, optionPrice)
                      VALUES (:dishID, :optionName, :optionPrice)";
                    $parameter = ["dishID" => $dishID, "optionName" => $optionName, "optionPrice" => $dishPrice[$index]];
                    if(!$this->executeSQL($query, $parameter)){
                        return false;
                    }
                }

            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function editDishOption($optionID,$dishID,$optionName,$optionPrice){
        try {
            foreach ($optionID as $index => $id) {
                if($optionName[$index] == "" || $optionPrice[$index] == ""){
                    return false;
                }else {
                    $query = "UPDATE dishOption SET optionName = :optionName,
                                                optionPrice = :optionPrice
                          WHERE optionID = :id AND dishID = :dishID";
                    $parameter = ["id" => $id, "dishID" => $dishID, "optionName" => $optionName[$index], "optionPrice" => $optionPrice[$index]];
                    if (!$this->executeSQL($query, $parameter)) {
                        return false;
                    }
                }
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function deleteDishOption($dishID, $optionID){
        try{
            foreach(json_decode($optionID) as $id){
                $query = "DELETE FROM dishOption WHERE optionID = :id AND dishID = :dishID";
                $parameter = ["id" => $id, "dishID" => $dishID];
                if(!$this->executeSQL($query, $parameter)){
                    return false;
                }
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function retrieveDishOption($optionID){
        try {
            $query = "SELECT optionName, optionPrice FROM dishOption WHERE optionID = :id";
            $parameter = ["id" => $optionID];
            $result = $this->executeSQL($query, $parameter)->fetch();
            if (!empty($result)) {
                return $result;
            } else {
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
}