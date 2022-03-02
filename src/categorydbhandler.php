<?php

class CategoryDBHandler extends Database
{
    public function retrieveAllCategory(){
        return $this->executeSQL("SELECT * from category")->fetchAll(PDO::FETCH_ASSOC);
    }
}