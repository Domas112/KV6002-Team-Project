<?php
    require_once('Database.php');
    require_once('../models/Dish.php');
    require_once('../models/Category.php');
    require_once('../models/DishOption.php');
    class DishesRepository{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }

        public function selectAllDishes(){
            $sql = "
                SELECT 
                    d.dishID, d.dishName, d.dishDescription, d.dishCategoryID, d.dishAvailability,
                    c.categoryName as dishCategoryName
                FROM dish d
                JOIN category c
                ON d.dishCategoryID = c.categoryID;
            ";
            $result = $this->db->executeSQL($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, 'Dish');
        }

        public function selectAllDishOptions($dishID){
            $sql = "
                SELECT
                    o.optionID, o.dishID, o.optionName, o.optionPrice
                FROM dishOption o
                WHERE o.dishID = :dishID;
            ";
            $result = $this->db->executeSQL($sql, array('dishID'=> $dishID));
            return $result->fetchAll(PDO::FETCH_CLASS, 'DishOption');
        }

        public function selectAllByCategory($category){
            $sql = "
                SELECT
                    d.dishID, d.dishName, d.dishDescription, d.dishCategoryID, d.dishAvailability,
                    c.categoryName as dishCategoryName
                FROM dish d
                JOIN category c
                ON d.dishCategoryID = c.categoryID
                WHERE d.dishCategoryID = :dishCategoryID;
            ";
            $result = $this->db->executeSQL($sql, array('dishCategoryID'=>$category));
            return $result->fetchAll(PDO::FETCH_CLASS, 'Dish');
        }

        public function selectImageByDishId($dishID){
            $sql = "
                SELECT i.imageData as dishImage
                FROM image i
                JOIN dish d
                ON i.imageID = d.dishImg
                WHERE d.dishID = :dishID;
            ";
            $result = $this->db->executeSQL($sql, array('dishID'=>$dishID));
            return $result->fetchAll()[0]['dishImage'];
        }

        public function selectAllCategories(){
            $sql = "
                SELECT c.categoryID, c.categoryName
                FROM category c;
            ";
            $result = $this->db->executeSQL($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, 'Category');

        }
    }

?>