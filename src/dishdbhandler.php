<?php

class DishDBHandler extends Database
{
    public function retrieveDish()
    {
        return $this->executeSQL("SELECT * FROM dish")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addDish($dish)
    {
        $query = "INSERT INTO dish (testValue) VALUES (:test)";
        $parameter = ["test" => $dish->getDishName()];
        $this->executeSQL($query, $parameter);
    }

    public function editDish()
    {

    }

    public function deleteDish()
    {

    }
}
