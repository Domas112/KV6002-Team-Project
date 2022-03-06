<?php
class DishDBHandler extends Database
{
    public function addDish($dish)
    {
        $query = "INSERT INTO dish (dishName, dishDescription, dishCategoryID, dishIngredient, dishImg, dishAvailability, dishPrice) 
                  VALUES (:name, :description, :category, :ingredient, :img, :availability, :price)";
        $parameter = ["name" => $dish->getDishName(),
            "description" => $dish->getDishDescription(),
            "category" => $dish->getDishCategory(),
            "ingredient" => $dish->getDishIngredient(),
            "img" => $dish->getDishImg(),
            "availability" => 1,
            "price" => $dish->getDishPrice()];
        $this->executeSQL($query, $parameter);
    }

    public function editDish()
    {
    }

    public function deleteDish($id)
    {
        $query = "DELETE FROM dish WHERE dishID = :id";
        $parameter = ["id" => $id];
        $this->executeSQL($query,$parameter);
        return true;
    }
}
