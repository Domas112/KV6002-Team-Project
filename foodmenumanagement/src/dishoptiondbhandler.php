<?php

/**
 * dishoptiondbhandler.php
 * The class will be used to handle the dish options database request such as adding, editing, deleting, and retrieving.
 *
 * @author Teck Xun Tan W20003691
 */
class DishOptionDBHandler extends Database
{
    /**
     * uploadDishOption
     * A function to handle uploading new dish option into the Option table of the database
     */
    public function uploadDishOption($dishID,$dishOption,$dishPrice){
        try{
            foreach($dishOption as $index => $optionName){
                //Check if optionName or dishPrice is empty
                if($optionName == "" || $dishPrice[$index] == ""){
                    //Return false if any of the variable is empty
                    return false;

                }else{
                    //Preparing query and parameter
                    $query = "INSERT INTO dishOption (dishID, optionName, optionPrice)
                      VALUES (:dishID, :optionName, :optionPrice)";
                    $parameter = ["dishID" => $dishID, "optionName" => $optionName, "optionPrice" => $dishPrice[$index]];

                    //Execute the query
                    if(!$this->executeSQL($query, $parameter)){
                        //Return false if SQL execution caught error and returned false
                        return false;
                    }
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
     * editDishOption
     * A function to handle editing dish option that are stored in the database
     */
    public function editDishOption($optionID,$dishID,$optionName,$optionPrice){
        try {
            foreach ($optionID as $index => $id) {
                //Check if optionName or dishPrice is empty
                if($optionName[$index] == "" || $optionPrice[$index] == ""){
                    //Return false if any of the variable is empty
                    return false;

                }else {
                    //Preparing query and parameter
                    $query = "UPDATE dishOption SET optionName = :optionName,
                                                optionPrice = :optionPrice
                          WHERE optionID = :id AND dishID = :dishID";
                    $parameter = ["id" => $id, "dishID" => $dishID, "optionName" => $optionName[$index], "optionPrice" => $optionPrice[$index]];

                    //Execute the query
                    if (!$this->executeSQL($query, $parameter)) {
                        //Return false if SQL execution caught error and returned false
                        return false;
                    }
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
     * deleteDishOption
     * A function to handle deleting dish option from the database
     */
    public function deleteDishOption($dishID, $optionID){
        try{
            foreach(json_decode($optionID) as $id){
                //Preparing query and parameter
                $query = "DELETE FROM dishOption WHERE optionID = :id AND dishID = :dishID";
                $parameter = ["id" => $id, "dishID" => $dishID];

                //Execute the query
                if(!$this->executeSQL($query, $parameter)){
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
     * retrieveDishOption
     * A function to retrieve details of a specific dishOption from the database
     */
    public function retrieveDishOption($optionID){
        try {
            //Preparing query and parameter
            $query = "SELECT optionName, optionPrice FROM dishOption WHERE optionID = :id";
            $parameter = ["id" => $optionID];

            //Execute the query
            $result = $this->executeSQL($query, $parameter)->fetch();

            if (!empty($result)) {
                //Return the result if result is not empty
                return $result;
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