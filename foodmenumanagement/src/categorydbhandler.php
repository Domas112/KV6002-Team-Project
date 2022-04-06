<?php

class CategoryDBHandler extends Database
{
    public function retrieveAllCategory(){
        $query = "SELECT * FROM category";
        return $this->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}