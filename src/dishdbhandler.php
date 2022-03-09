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

        $query = "INSERT INTO dish (dishName, dishDescription, dishCategoryID, dishImg, dishAvailability, dishPrice)
                  VALUES (:name, :description, :category, :img, :availability, :price)";
        $parameter = ["name" => $dish->getDishName(),
                      "description" => $dish->getDishDescription(),
                      "category" => $dish->getDishCategory(),
                      "img" => $imgID,
                      "availability" => 1,
                      "price" => $dish->getDishPrice()];
        $this->executeSQL($query, $parameter);
    }

    public function editDish($dish)
    {
        if($dish->getDishImg() != 1){
            $imageDB = new ImageDBHandler();
            $imageDB->updateImage($this->retrieveDishImageID($dish->getDishID()), $dish->getDishImg());
        }

        $query = "UPDATE dish SET dishName = :name, 
                                  dishDescription = :description,
                                  dishCategoryID = :category,
                                  dishPrice = :price
                  WHERE dishID = :id";
        $parameter = ["id" => $dish->getDishID(),
                      "name" => $dish->getDishName(),
                      "description" => $dish->getDishDescription(),
                      "category" => $dish->getDishCategory(),
                      "price" => $dish->getDishPrice()];
        if($this->executeSQL($query, $parameter)){
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
}
