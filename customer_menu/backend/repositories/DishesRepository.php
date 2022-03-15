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

        public function SelectAllDishes(){
            $sql = <<<END
                SELECT 
                    d.dishID, d.dishName, d.dishDescription, d.dishCategoryID, d.dishAvailability,
                    c.categoryName as dishCategoryName
                FROM dish d
                JOIN category c
                ON d.dishCategoryID = c.categoryID;
            END;
            $result = $this->db->executeSQL($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, 'Dish');
        }

        public function SelectAllDishOptions($dishId){
            $sql = <<<END
                SELECT
                    o.optionID, o.dishID, o.optionName, o.optionPrice
                FROM dishoption o
                WHERE o.dishID = :dishID;
            END;
            $result = $this->db->executeSQL($sql, array('dishID'=> $dishId));
            return $result->fetchAll(PDO::FETCH_CLASS, 'DishOption');
        }

        public function SelectAllByCategory($category){
            $sql = <<<END
                SELECT
                    d.dishID, d.dishName, d.dishDescription, d.dishCategoryID, d.dishAvailability,
                    c.categoryName as dishCategoryName
                FROM dish d
                JOIN category c
                ON d.dishCategoryID = c.categoryID
                WHERE d.dishCategoryID = :dishCategoryID;
            END;
            $result = $this->db->executeSQL($sql, array('dishCategoryID'=>$category));
            return $result->fetchAll(PDO::FETCH_CLASS, 'Dish');
        }

        public function SelectImageByDishId($id){
            $sql = <<<END
                SELECT i.imageData as dishImage
                FROM image i
                JOIN dish d
                ON i.imageID = d.dishImg
                WHERE d.dishID = :dishID;
            END;
            $result = $this->db->executeSQL($sql, array('dishID'=>$id));
            return $result->fetchAll()[0]['dishImage'];
        }

        public function SelectAllCategories(){
            $sql = <<<END
                SELECT c.categoryID, c.categoryName
                FROM category c;
            END;
            $result = $this->db->executeSQL($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, 'Category');

        }
    }

?>