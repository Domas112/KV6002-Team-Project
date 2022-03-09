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

    public function editDish()
    {
    }

    public function deleteDish($id, $imgID)
    {
        if($imgID != 1){
            $imageDB = new ImageDBHandler();
            $imageDB->deleteImage($imgID);
        }

        $query="DELETE FROM dish WHERE dishID = :id";
        $parameter = ["id" => $id];
        $this->executeSQL($query,$parameter);
        return true;
    }
}
