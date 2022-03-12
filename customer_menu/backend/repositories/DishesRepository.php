<?php
    require_once('Database.php');
    require_once('../models/Dish.php');
    class DishesRepository{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }

        public function SelectAll(){
            $sql = <<<END
                SELECT 
                    d.dishID, d.dishName, d.dishDescription, d.dishPrice, d.dishCategoryID, d.dishAvailability,
                    c.categoryName as dishCategoryName
                FROM dishes d
                JOIN categories c
                ON d.dishCategoryID = c.categoryID;
            END;
            $result = $this->db->executeSQL($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, 'Dish');
        }

        public function SelectAllByCategory($category){
            $sql = <<<END
                SELECT
                    d.dishID, d.dishName, d.dishDescription, d.dishCategoryID, d.dishPrice, d.dishAvailability,
                    c.categoryName as dishCategoryName
                FROM dishes d
                JOIN categories c
                ON d.dishCategoryID = c.categoryID
                WHERE d.dishCategoryID = :dishCategoryID;
            END;
            $result = $this->db->executeSQL($sql, array('dishCategoryID'=>$category));
            return $result->fetchAll(PDO::FETCH_CLASS, 'Dish');
        }

        public function SelectImageByDishId($id){
            $sql = <<<END
                SELECT i.imageData as dishImage
                FROM images i
                JOIN dishes d
                ON i.imageID = d.dishImageID
                WHERE d.dishID = :dishID;
            END;
            $result = $this->db->executeSQL($sql, array('dishID'=>$id));
            return $result->fetchAll()[0]['dishImage'];
        }
    }

?>