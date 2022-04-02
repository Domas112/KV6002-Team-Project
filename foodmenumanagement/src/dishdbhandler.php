<?php
class DishDBHandler extends Database
{
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
        $this->executeSQL($query, $parameter);

        //Adding new dish additional option into DishOption table
        $dishOption = $dish->getDishOption();
        $dishPrice = $dish-> getDishPrice();
        if($dishOption != null && $dishPrice != null){
            $dishID = $this->retrieveDishID($dish->getDishName(),$dish->getDishDescription());
            $optionDB = new DishOptionDBHandler();
            $optionDB->uploadDishOption($dishID,$dishOption,$dishPrice);
        }

        $newLog = new Log(1,"add",null);
        $logDB->createLog($newLog);
    }

    public function editDish($dish,$removedOption)
    {
        //Retrieved the image id saved on the dish
        $imgID = $this->retrieveDishImageID($dish->getDishID());

        //Check if an exist image has already been uploaded to the data
        if($dish->getDishImg() != 1){

            //Initialise the image database class
            $imageDB = new ImageDBHandler();

            if($imgID != 1){
                //If the exist image returned is not 1, update the image data
                $imageDB->updateImage($imgID,$dish->getDishImg());
            }else{
                //If the exist image returned is 1 (Default Image), upload a new image data
                if($imageDB->uploadImage($dish->getDishImg())){
                    $imgID = $imageDB->retrieveImageID($dish->getDishImg());
                }
            }
        }
        //Test Comment
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
        if($this->executeSQL($query, $parameter)){
            //Remove option if existed dish option has been removed on submit
            if($removedOption != null){
                $optionDB = new DishOptionDBHandler();
                $optionDB->deleteDishOption($dish->getDishID(),$removedOption);
            }

            //Edit dish option information to existed dish on submit
            if($dish->getRetrievedID() != null){
                $optionDB = new DishOptionDBHandler();
                $optionDB->editDishOption($dish->getRetrievedID(),$dish->getDishID(),$dish->getRetrievedOption(),$dish->getRetrievedPrice());
            }

            //Add new dish option if it doesn't exist on submit
            $dishOption = $dish->getDishOption();
            $dishPrice = $dish-> getDishPrice();
            if($dishOption != null && $dishPrice != null){
                $optionDB = new DishOptionDBHandler();
                $optionDB->uploadDishOption($dish->getDishID(),$dishOption,$dishPrice);
            }

            //Initialise the log database
            $logDB = new LogDBHandler();

            //Set a new Log object
            $newLog = new Log(1,"edit",$dish->getDishID());

            //Execute the logging query
            $logDB->createLog($newLog);


            return true;
        }else{
            return false;
        }
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
