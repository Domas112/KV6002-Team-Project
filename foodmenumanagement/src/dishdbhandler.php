<?php
class DishDBHandler extends Database
{
    /**
     * addDish
     *
     * @param $dish
     * @return bool
     */
    public function addDish($dish)
    {
        $imgID = "";
        $imageDB = new ImageDBHandler();
        $logDB = new LogDBHandler();

        if($dish->getDishImg() != 1){
            if($imageDB->uploadImage($dish->getDishImg())){
                $imgID .= $imageDB->retrieveImageID($dish->getDishImg());
            }
        }else{
            $imgID .= 1;
        }

        //Adding new dish into Dish table
        $query = "INSERT INTO dish (dishName, dishDescription, dishCategoryID, dishImg, dishAvailability)
                  VALUES (:name, :description, :category, :img, :availability)";
        $parameter = ["name" => $dish->getDishName(),
                      "description" => $dish->getDishDescription(),
                      "category" => $dish->getDishCategory(),
                      "img" => $imgID,
                      "availability" => 1];
        if(!$this->executeSQL($query, $parameter)){
            return false;
        }

        //Adding new dish additional option into DishOption table
        $dishOption = $dish->getDishOption();
        $dishPrice = $dish-> getDishPrice();

        //If dishOption and dishPrice is not null, add data into option database
        if($dishOption != null && $dishPrice != null){

            //Retrieve the current dishID
            $dishID = $this->retrieveDishID($dish->getDishName(),$dish->getDishDescription());

            //Initialise DishOptionDBHandler
            $optionDB = new DishOptionDBHandler();

            if(!$optionDB->uploadDishOption($dishID,$dishOption,$dishPrice)){
                return false;
            };
        }

        $newLog = new Log(1,"add",null);
        if(!$logDB->createLog($newLog)){
            return false;
        }

        return true;
    }

    /**
     * editDish
     *
     * To handle the edit functionality of the Food Menu Management system
     *
     * @param Dish $dish The dish object
     * @param string $removedOption A list of removed option
     * @return bool If queries have been executed successfully
     */
    public function editDish($retrievedDish,$dish,$removedOption)
    {
        $logChangesDetail = [];

        //Compare difference
        //Compare original dish name with edited dish name
        if((strcmp($retrievedDish->getDishName(), $dish->getDishName())) != 0){
            array_push($logChangesDetail,"Name \"".$retrievedDish->getDishName()."\" has been changed to \"".$dish->getDishName()."\"");
        }

        //Compare original description with edited description
        if((strcmp($retrievedDish->getDishDescription(), $dish->getDishDescription())) != 0){
            array_push($logChangesDetail,"Description \"".$retrievedDish->getDishDescription()."\" has been changed to \"".$dish->getDishDescription()."\"");
        }

        //Compare original category with edited category
        if((strcmp($retrievedDish->getDishCategory(), $dish->getDishCategory())) != 0){
            array_push($logChangesDetail,"Category ".$retrievedDish->getDishCategory()." has been changed to Category ".$dish->getDishCategory());
        }

        //Retrieved the image id saved on the dish
        $imgID = $this->retrieveDishImageID($dish->getDishID());

        //Check if an exist image has already been uploaded to the data
        if($dish->getDishImg() != 1){

            //Initialise the image database class
            $imageDB = new ImageDBHandler();

            //Check if the retrieved image ID is assigned to a default image (1) or not
            if($imgID != 1){

                //If the exist image returned is not 1, update the image data
                if(!$imageDB->updateImage($imgID,$dish->getDishImg())){
                    return false;
                }else{
                    //Pushing a new log message into array
                    array_push($logChangesDetail,"Image has been updated!");
                }
            }else{

                //If the exist image returned is 1 (Default Image), upload a new image data
                if(!$imageDB->uploadImage($dish->getDishImg())){
                    return false;
                }else{

                    //Pushing a new log message into array
                    array_push($logChangesDetail,"New image has been uploaded!");

                    //Retrieve the new image ID
                    $imgID = $imageDB->retrieveImageID($dish->getDishImg());
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
        if(!$this->executeSQL($query, $parameter)){
            return false;
        }

        //Remove option if existed dish option has been removed on submit
        if($removedOption != null){

            //Initialise DishOptionDBHandler
            $optionDB = new DishOptionDBHandler();

            //For each option ID in the $removedOption
            foreach(json_decode($removedOption) as $removed){

                //Retrieve option name using the Option ID
                $optionName = $optionDB->retrieveDishOptionName($removed);

                //Pushing a new log message into array
                array_push($logChangesDetail,"Option \"".$optionName."\" has been deleted!");
            }

            //Execute option deletion
            if(!$optionDB->deleteDishOption($dish->getDishID(),$removedOption)){
                return false;
            };
        }

        //Edit dish option information to existed dish on submit
        if($dish->getRetrievedID() != null){
            $optionDB = new DishOptionDBHandler();
            foreach($dish->getRetrievedID() as $index => $changes){

                //Retrieve option name using the Option ID
                $optionName = $optionDB->retrieveDishOptionName($changes);

                //Pushing a new log message if the option ID has been changed
                if((strcmp($optionName,$dish->getRetrievedOption()[$index]))!=0){
                    array_push($logChangesDetail, "Option \"".$optionName."\" has been updated to \"".$dish->getRetrievedOption()[$index]."\"!");
                }
            }

            //Execute option edit
            if(!$optionDB->editDishOption($dish->getRetrievedID(),$dish->getDishID(),$dish->getRetrievedOption(),$dish->getRetrievedPrice())){
                return false;
            }
        }

        //Add new dish option if it doesn't exist on submit
        $dishOption = $dish->getDishOption();
        $dishPrice = $dish-> getDishPrice();
        if($dishOption != null && $dishPrice != null) {
            $optionDB = new DishOptionDBHandler();

            //Execute upload dish
            if(!$optionDB->uploadDishOption($dish->getDishID(), $dishOption, $dishPrice)){
                return false;
            }

            foreach($dishOption as $option){
                //Pushing a new log message into array
                array_push($logChangesDetail, "Option \"".$option."\" has been added!");
            }
        }

        //Check if logChangesDetail contains any data
        if(!empty($logChangesDetail)){

            //If the array is not empty
            //Initialise the log database
            $logDB = new LogDBHandler();

            //Set a new Log object
            $newLog = new Log(1,"edit",$dish->getDishID());

            //Execute the logging query
            if(!$logDB->createLog($newLog)){
                return false;
            }

            //Get the latest log ID
            $currentLogID = $logDB->retrieveLatestLogID(1);

            //Upload the log details to the database
            if(!$logDB->createLogDetails($currentLogID,$logChangesDetail)){
                return false;
            }
        }
        return true;
    }

    public function deleteDish($id)
    {
        $imgID = $this->retrieveDishImageID($id);

        if($imgID != 1){
            $imageDB = new ImageDBHandler();
            $imageDB->deleteImage($imgID);
        }

        $query = "DELETE FROM dish WHERE dishID = :id";
        $parameter = ["id" => $id];
        $this->executeSQL($query,$parameter);
        $logDB = new LogDBHandler();
        $newLog = new Log(1,"delete",$id);
        $logDB->createLog($newLog);
        return true;
    }

    public function updateDishAvailability($id){
        $query = "UPDATE dish SET dishAvailability = !dishAvailability WHERE dishID = :id";
        $parameter = ["id" => $id];
        if($this->executeSQL($query,$parameter)){
            return true;
        }else{
            return false;
        }
    }

    private function retrieveDishImageID($id){
        $query = "SELECT dishImg FROM dish WHERE dishID = :id";
        $parameter = ["id" => $id];
        $result = $this->executeSQL($query,$parameter);
        foreach($result as $row){
            return $row['dishImg'];
        }
    }

    private function retrieveDishID($dishName,$dishDescription){
        $query = "SELECT dishID FROM dish WHERE dishName = :name AND dishDescription = :description";
        $parameter = ["name" => $dishName, "description" => $dishDescription];
        $result = $this->executeSQL($query,$parameter);
        foreach($result as $row){
            return $row['dishID'];
        }
    }
}
