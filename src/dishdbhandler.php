<?php
class DishDBHandler extends Database
{

    public function addDish($dish)
    {
        $imgID = "";
        $imageDB = new ImageDBHandler();

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
    }

    public function editDish($dish,$removedOption)
    {
        $imgID = $this->retrieveDishImageID($dish->getDishID());

        if($dish->getDishImg() != 1){
            $imageDB = new ImageDBHandler();
            if($imgID != 1){
                $imageDB->updateImage($imgID,$dish->getDishImg());
            }else{
                if($imageDB->uploadImage($dish->getDishImg())){
                    $imgID = $imageDB->retrieveImageID($dish->getDishImg());
                }
            }
        }

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
        $this->executeSQL($query, $parameter);

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
            $dishID = $this->retrieveDishID($dish->getDishName(),$dish->getDishDescription());
            $optionDB = new DishOptionDBHandler();
            $optionDB->uploadDishOption($dishID,$dishOption,$dishPrice);
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
