<?php
    require_once('../repositories/DishesRepository.php');
    class DishesController{
        private $dishesRepo;
        function __construct()
        {
            $this->dishesRepo = new DishesRepository();
        }

        function getAllDishes(){
            $dishes = $this->dishesRepo->SelectAll();
            return json_encode($dishes);
        }

        function getDishesByCategory($category){
            $dishes = $this->dishesRepo->SelectAllByCategory($category);
            return json_encode($dishes);
        }

        function getImageByDishId($id){
            $image = $this->dishesRepo->SelectImageByDishId($id);
            return json_encode($image);
        }



    }

?>