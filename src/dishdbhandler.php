<?php
class DishDBHandler extends Database
{
    public function addDish($dish)
    {
        $imgID = "";
        if($dish->getDishImg() != 1){
            $imgID .= $this->getImageID($dish->getDishImg());
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
            $query = "DELETE FROM image WHERE ImageID = :id";
            $parameter = ["id" => $imgID];
            $this->executeSQL($query,$parameter);
        }

        $query="DELETE FROM dish WHERE dishID = :id";
        $parameter = ["id" => $id];
        $this->executeSQL($query,$parameter);
        return true;
    }

    public function getImageID($blob){
        $query = "SELECT MAX(imageID) AS imageID FROM image WHERE imageData = :data";
        $parameter = ["data" => $blob];
        $result = $this->executeSQL($query,$parameter)->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            return $row['imageID'];
        }
    }

    public function uploadDishImage($img){
        if($img != 1){
            $query = "INSERT INTO image (imageData) VALUES (:img)";
            $parameter = ["img" => $img];
            $this->executeSQL($query,$parameter);
        }else{
            return null;
        }
    }

    public function deleteDishImage($id){
        $query = "DELETE FROM image WHERE imageID = :id";
        $parameter = ["id" => $id];
        $this->executeSQL($query,$parameter);
    }
}
