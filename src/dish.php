<?php

class Dish
{
    private $dishID, $dishName, $dishDescription, $dishCategory, $dishIngredient, $dishImgPath, $dishAvailability, $dishPrice;

    public function __construct($dishID, $dishName, $dishDescription, $dishCategory, $dishIngredient, $dishImgPath, $dishAvailability,$dishPrice){
        $this->setDishID($dishID);
        $this->setDishName($dishName);
        $this->setDishDescription($dishDescription);
        $this->setDishCategory($dishCategory);
        $this->setDishIngredient($dishIngredient);
        $this->setDishImgPath($dishImgPath);
        $this->setDishAvailability($dishAvailability);
        $this->setDishPrice($dishPrice);
    }

    public function setDishID($dishID){
        $this->dishID = $dishID;
    }

    public function getDishID(){
        return $this->dishID;
    }

    public function setDishName($dishName){
        $this->dishName = $dishName;
    }

    public function getDishName(){
        return $this->dishName;
    }

    public function setDishDescription($dishDescription){
        $this->dishDescription = $dishDescription;
    }

    public function getDishDescription(){
        return $this->dishDescription;
    }

    public function setDishCategory($dishCategory){
        $this->dishCategory = $dishCategory;
    }

    public function getDishCategory(){
        return $this->dishCategory;
    }

    public function setDishIngredient($dishIngredient){
        $this->dishIngredient = $dishIngredient;
    }

    public function getDishIngredient(){
        return $this->dishIngredient;
    }

    public function setDishImgPath($dishImgPath){
        $this->dishImgPath = $dishImgPath;
    }

    public function getDishImgPath(){
        return $this->dishImgPath;
    }

    public function setDishAvailability($dishAvailability){
        $this->dishAvailability = $dishAvailability;
    }

    public function getDishAvailability(){
        return $this->dishAvailability;
    }

    public function setDishPrice($dishPrice){
        $this->dishPrice = $dishPrice;
    }

    public function getDishPrice(){
        return $this->dishPrice;
    }
}