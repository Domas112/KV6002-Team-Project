<?php
    require_once('../repositories/DishesRepository.php');
    class DishesController{
        private $dishesRepo;
        function __construct()
        {
            $this->dishesRepo = new DishesRepository();
        }

        function getAllDishes(){
            $dishes = $this->dishesRepo->selectAllDishes();
            return json_encode($dishes);
        }

        function getAllDishOptions($dishId){
            $dishOptions = $this->dishesRepo->selectAllDishOptions($dishId);
            return json_encode($dishOptions);
        }

        function getDishesByCategory($category){
            $dishes = $this->dishesRepo->selectAllByCategory($category);
            return json_encode($dishes);
        }

        function getImageByDishId($dishId){
            $image = $this->dishesRepo->selectImageByDishId($dishId);
            
            return json_encode($image);
        }

        function getCategories(){
            $categories = $this->dishesRepo->selectAllCategories();

            return json_encode($categories);
        }



    }

?>