<?php
    require_once('../repositories/DishesRepository.php');
    class DishesController{
        private $dishesRepo;
        function __construct()
        {
            $this->dishesRepo = new DishesRepository();
        }

        function getAllDishes(){
            $dishes = $this->dishesRepo->SelectAllDishes();
            return json_encode($dishes);
        }

        function getAllDishOptions($dishId){
            $dishOptions = $this->dishesRepo->SelectAllDishOptions($dishId);
            return json_encode($dishOptions);
        }

        function getDishesByCategory($category){
            $dishes = $this->dishesRepo->SelectAllByCategory($category);
            return json_encode($dishes);
        }

        function getImageByDishId($dishId){
            $image = $this->dishesRepo->SelectImageByDishId($dishId);
            
            return json_encode($image);
        }

        function getCategories(){
            $categories = $this->dishesRepo->SelectAllCategories();

            return json_encode($categories);
        }



    }

?>