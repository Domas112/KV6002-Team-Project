<?php

/**
 * dishdbhandler.php
 * The class will be used to handle the dish database request such as adding, editing, deleting, and retrieving.
 *
 * @author Teck Xun Tan W20003691
 */
class DishDBHandler extends Database
{
    /**
     * addDish
     * A function to handle the add/upload dish functionality of the Food Menu Management system
     */
    public function addDish($dish)
    {
        try {
            //Initialise imageDB and logDB handler class
            $imageDB = new ImageDBHandler();
            $logDB = new LogDBHandler();

            //Server side verify if the inputs are all filled in
            if (!$this->verifyInput($dish)) {
                //Return false if one of the input is empty
                return false;

            } else {
                //Begin uploading image to Image database and retrieving image ID to store into Dish database
                //Check if an image is uploaded
                if ($dish->getDishImg() != 1) {
                    //Upload the image
                    if (!$imageDB->uploadImage($dish->getDishImg())) {
                        //Return false if uploadImage SQL execution run into error and returned false
                        return false;

                    } else {
                        //Retrieve the newest uploaded image ID
                        $imgID = $imageDB->retrieveImageID($dish->getDishImg());

                        if (!$imgID) {
                            //Return false if retrieve image return empty
                            return false;
                        }
                    }
                } else {
                    //Set imgID to 1 (ID for default image stored on the database)
                    $imgID = 1;
                }

                //Adding new dish into Dish table
                //Preparing query and parameter
                $query = "INSERT INTO dish (dishName, dishDescription, dishCategoryID, dishImg, dishAvailability)
                  VALUES (:name, :description, :category, :img, :availability)";
                $parameter = ["name" => $dish->getDishName(),
                    "description" => $dish->getDishDescription(),
                    "category" => $dish->getDishCategory(),
                    "img" => $imgID,
                    "availability" => 1];

                ///Execute the query
                if (!$this->executeSQL($query, $parameter)) {
                    //Return false if SQL execution caught error
                    return false;
                }

                //Adding new dish additional option into DishOption table
                $dishOption = $dish->getDishOption();
                $dishPrice = $dish->getDishPrice();

                //If dishOption and dishPrice is not null, add data into option database
                if ($dishOption != null && $dishPrice != null) {

                    //Retrieve the current dishID
                    $dishID = $this->retrieveDishID($dish->getDishName(), $dish->getDishDescription());
                    if (!$dishID) {
                        //Return false if dishID return null or caught error
                        return false;
                    }

                    //Start uploading dish option
                    $optionDB = new DishOptionDBHandler();
                    if (!$optionDB->uploadDishOption($dishID, $dishOption, $dishPrice)) {
                        //Return false if uploadDishOption SQL execution caught error and returned false
                        return false;
                    };
                }

                //Start uploading new log
                //Creating new log object
                $newLog = new Log($_SESSION['username'], "add", $dish->getDishName());

                if (!$logDB->createLog($newLog)) {
                    //Return false if createLog SQL execution caught error and returned false
                    return false;
                }

                //Return true if no error has occurred
                return true;
            }
        }catch(Exception $e){
            //Return false if an exception has been caught
            return false;
        }
    }

    /**
     * editDish
     * A function to handle the edit dish functionality of the Food Menu Management system
     */
    public function editDish($dish,$removedOption)
    {
        try {
            //Server side verify if the inputs are all filled in
            if(!$this->verifyInput($dish)) {
                //Return false if one of the input is empty
                return false;

            }else{
                //Initialise empty array variable
                $logChangesDetail = [];

                //Compare difference
                //Compare retrieved dish name from database with edited dish name
                if ((strcmp($_SESSION['retrievedName'], $dish->getDishName())) != 0) {
                    array_push($logChangesDetail, "Name \"" . $_SESSION['retrievedName'] . "\" has been changed to \"" . $dish->getDishName() . "\"");
                }

                //Compare retrieved description from database with edited description
                if ((strcmp($_SESSION['retrievedDescription'], $dish->getDishDescription())) != 0) {
                    array_push($logChangesDetail, "Description \"" . $_SESSION['retrievedDescription'] . "\" has been changed to \"" . $dish->getDishDescription() . "\"");
                }

                //Compare retrieved category from database with edited category
                if ((strcmp($_SESSION['retrievedCategory'], $dish->getDishCategory())) != 0) {
                    array_push($logChangesDetail, "Category " . $_SESSION['retrievedCategory'] . " has been changed to Category " . $dish->getDishCategory());
                }

                //Retrieved the image id saved on the dish
                $imgID = $this->retrieveDishImageID($dish->getDishID());
                if (!$imgID) {
                    //Return false if retrieve image ID return empty or caught error and returned false
                    return false;
                }

                //Check if an exist image has already been uploaded to the data
                if ($dish->getDishImg() != 1) {

                    //Start update/upload image
                    //Initialise image DB handler class
                    $imageDB = new ImageDBHandler();

                    //Check if the retrieved image ID is assigned to a default image (1) or not
                    if ($imgID != 1) {
                        //If the exist image returned is not 1, update the image data
                        if (!$imageDB->updateImage($imgID, $dish->getDishImg())) {
                            //Return false if updateImage SQL execution caught error and returned false
                            return false;

                        } else {
                            //Pushing a new log message into array
                            array_push($logChangesDetail, "Image has been updated!");

                        }

                    } else {
                        //If the exist image returned is 1 (Default Image), upload a new image data
                        if (!$imageDB->uploadImage($dish->getDishImg())) {
                            //Return false if uploadImage SQL execution caught error and returned false
                            return false;

                        } else {
                            //Pushing a new log message into array
                            array_push($logChangesDetail, "New image has been uploaded!");

                            //Retrieve the new image ID
                            $imgID = $imageDB->retrieveImageID($dish->getDishImg());

                            if (!$imgID) {
                                //Return false if retrieveImageID return empty or caught error
                                return false;
                            }
                        }
                    }
                }

                //Preparing the query and parameters
                $query = "UPDATE dish SET dishName = :name,
                                  dishDescription = :description,
                                  dishCategoryID = :category,
                                  dishImg = :dishImg
                  WHERE dishID = :id";
                $parameter = ["id" => $dish->getDishID(),
                    "name" => $dish->getDishName(),
                    "description" => $dish->getDishDescription(),
                    "category" => $dish->getDishCategory(),
                    "dishImg" => $imgID];

                //Execute the editing process
                if (!$this->executeSQL($query, $parameter)) {
                    //Return false if SQL execution caught error
                    return false;
                }

                //Remove option if existed dish option has been removed on submit
                if ($removedOption != null) {

                    //Initialise DishOptionDBHandler
                    $optionDB = new DishOptionDBHandler();

                    //For each option ID in the $removedOption
                    foreach (json_decode($removedOption) as $removed) {

                        //Retrieve option name using the Option ID
                        $option = $optionDB->retrieveDishOption($removed);
                        if (!$option) {
                            //Return false if retrieveDishOption return empty or caught error
                            return false;
                        }

                        //Pushing a new log message into array
                        array_push($logChangesDetail, "Option \"" . $option['optionName'] . "\" has been deleted!");
                    }

                    //Execute option deletion
                    if (!$optionDB->deleteDishOption($dish->getDishID(), $removedOption)) {
                        //Return false if deleteDishOption SQL execution caught error and returned false
                        return false;
                    };
                }

                //Edit dish option information to existed dish on submit
                if ($dish->getRetrievedID() != null) {
                    //Initialise optionDB handler class
                    $optionDB = new DishOptionDBHandler();

                    foreach ($dish->getRetrievedID() as $index => $changesID) {
                        //Retrieve option name using the Option ID
                        $option = $optionDB->retrieveDishOption($changesID);
                        if (!$option) {
                            //Return false if retrieveDishOption returned empty or caught error
                            return false;
                        }

                        //Push a new log message if the edited optionName is different from the optionName stored in database
                        if ((strcmp($option['optionName'], $dish->getRetrievedOption()[$index])) != 0) {
                            array_push($logChangesDetail, "Option \"" . $option['optionName'] . "\" has been updated to \"" . $dish->getRetrievedOption()[$index] . "\"!");
                        }

                        //Push a new log message if the edited optionPrice is different from the optionName stored in database
                        if((strcmp($option['optionPrice'], $dish->getRetrievedPrice()[$index])) != 0) {
                            array_push($logChangesDetail, "Option \"" . $option['optionName'] . "\" price has been changed from \"" . $option['optionPrice'] . "\" to \"" . $dish->getRetrievedPrice()[$index] . "\"!");
                        }
                    }

                    //Execute option edit
                    if (!$optionDB->editDishOption($dish->getRetrievedID(), $dish->getDishID(), $dish->getRetrievedOption(), $dish->getRetrievedPrice())) {
                        //Return false if editDishOption SQL execution caught error and returned false
                        return false;
                    }
                }

                //Add new dish option if it doesn't exist on submit
                $dishOption = $dish->getDishOption();
                $dishPrice = $dish->getDishPrice();

                if ($dishOption != null && $dishPrice != null) {
                    //Initialise optionDB handler class
                    $optionDB = new DishOptionDBHandler();

                    foreach ($dishOption as $option) {
                        //Pushing a new log message into array
                        array_push($logChangesDetail, "Option \"" . $option . "\" has been added!");
                    }

                    //Execute option upload
                    if (!$optionDB->uploadDishOption($dish->getDishID(), $dishOption, $dishPrice)) {
                        //Return false if uploadDishOption caught error and returned false
                        return false;
                    }
                }

                //Check if logChangesDetail contains any data
                if (!empty($logChangesDetail)) {

                    //If the array is not empty
                    //Initialise the log database
                    $logDB = new LogDBHandler();

                    //Set a new Log object
                    $newLog = new Log($_SESSION['username'], "edit", $dish->getDishName());

                    //Execute the logging query
                    if (!$logDB->createLog($newLog)) {
                        //Return false if createLog SQL execution caught error and returned false
                        return false;
                    }

                    //Get the latest/recent uploaded log ID
                    $currentLogID = $logDB->retrieveLatestLogID($_SESSION['username']);
                    if (!$currentLogID) {
                        //Return false if retrieveLatestLogID return empty or caught error
                        return false;
                    }

                    //Upload the log details to the database
                    if (!$logDB->createLogDetails($currentLogID, $logChangesDetail)) {
                        //Return false if createLogDetails SQL execution caught error and returned false
                        return false;
                    }
                }

                //Return true if no error occurred
                return true;
            }
        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }

    /**
     * deleteDish
     * A function to handle the delete dish functionality of the Food Menu Management system
     */
    public function deleteDish($id,$name)
    {
        try {
            //Retrieve the image ID
            $imgID = $this->retrieveDishImageID($id);
            if (!$imgID) {
                //Return false if retrieveDishImageID return empty or caught error
                return false;
            }

            //Execute image deletion
            if ($imgID != 1) {
                //Initialise imageDB handler class
                $imageDB = new ImageDBHandler();

                if (!$imageDB->deleteImage($imgID)) {
                    //Return false if deleteImage SQL execution caught error and returned false
                    return false;
                }
            }

            //Preparing the query and parameters
            $query = "DELETE FROM dish WHERE dishID = :id";
            $parameter = ["id" => $id];

            if (!$this->executeSQL($query, $parameter)) {
                //Return false if SQL execution caught error and returned false
                return false;
            }

            //Initialise the log database
            $logDB = new LogDBHandler();

            //Set a new Log object
            $newLog = new Log($_SESSION['username'], "delete", $name);

            //Execute the logging query
            if (!$logDB->createLog($newLog)) {
                //Return false if createLog SQL execution caught error and returned false
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
     * updateDishAvailability
     * A function to handle the update dish availability functionality of the Food Menu Management system
     */
    public function updateDishAvailability($id,$name){
        try {
            //Preparing the query and parameters
            $query = "UPDATE dish SET dishAvailability = !dishAvailability WHERE dishID = :id";
            $parameter = ["id" => $id];

            //Execute the SQL query
            if ($this->executeSQL($query, $parameter)) {
                //Initialise the log database
                $logDB = new LogDBHandler();

                //Set a new Log object
                $newLog = new Log($_SESSION['username'], "availability", $name);

                //Execute the logging query
                if (!$logDB->createLog($newLog)) {
                    //Return false if createLog SQL execution caught error and returned false
                    return false;
                }

                //Return true if no error occurred
                return true;

            } else {
                //Return false if SQL execution caught error and returned false
                return false;
            }
        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }

    /**
     * retrieveDishImageID
     * A function to used to retrieve the dish image ID from the database
     */
    private function retrieveDishImageID($id){
        try {
            //Preparing the query and parameters
            $query = "SELECT dishImg FROM dish WHERE dishID = :id";
            $parameter = ["id" => $id];

            //Execute SQL
            $result = $this->executeSQL($query, $parameter)->fetch();

            if (!empty($result)) {
                //Return the result if the returned result is not empty
                return $result[0];

            } else {
                //Return false if the SQL execution caught error and returned false
                return false;
            }
        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }

    /**
     * retrieveDishID
     * A function to used to retrieve the dish ID from the database
     */
    private function retrieveDishID($dishName,$dishDescription){
        try {
            //Preparing the query and parameters
            $query = "SELECT dishID FROM dish WHERE dishName = :name AND dishDescription = :description";
            $parameter = ["name" => $dishName, "description" => $dishDescription];

            //Execute SQL
            $result = $this->executeSQL($query, $parameter)->fetch();

            if (!empty($result)) {
                //Return the result if the returned result is not empty
                return $result[0];

            } else {
                //Return false if the SQL execution caught error and returned false
                return false;
            }
        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }

    /**
     * verifyInput
     * A function used to verify if an input is empty
     */
    private function verifyInput($dish){
        if($dish->getDishName() == "" || $dish->getDishDescription() == ""){
            //Return false if any input is empty
            return false;

        }else{
            //Return true if all input are filled
            return true;
        }
    }
}
