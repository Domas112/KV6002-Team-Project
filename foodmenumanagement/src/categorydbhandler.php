<?php

class CategoryDBHandler extends Database
{
    public function retrieveAllCategory(){
        try {
            $query = "SELECT * FROM category";
            $result = $this->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                return $result;
            } else {
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
}