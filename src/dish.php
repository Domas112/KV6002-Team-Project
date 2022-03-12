<?php

class Dish
{
    private $dishID, $dishName, $dishDescription, $dishCategory, $dishImg, $dishAvailability, $dishOption, $dishRetrievedID, $dishRetrievedOption, $dishRetrievedPrice, $dishPrice;

    public function __construct($dishID, $dishName, $dishDescription, $dishCategory, $dishImg, $dishAvailability, $dishOption, $dishPrice){
        $this->setDishID($dishID);
        $this->setDishName($dishName);
        $this->setDishDescription($dishDescription);
        $this->setDishCategory($dishCategory);
        $this->setDishImg($dishImg);
        $this->setDishAvailability($dishAvailability);
        $this->setDishOption($dishOption);
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

    public function setDishImg($dishImg){
        $this->dishImg = $dishImg;
    }

    public function getDishImg(){
        return $this->dishImg;
    }

    public function setDishAvailability($dishAvailability){
        $this->dishAvailability = $dishAvailability;
    }

    public function getDishAvailability(){
        return $this->dishAvailability;
    }

    public function setDishOption($dishOption){
        $this->dishOption = $dishOption;
    }

    public function getDishOption(){
        return $this->dishOption;
    }

    public function setRetrievedID($dishRetrievedID){
        $this->dishRetrievedID = $dishRetrievedID;
    }

    public function getRetrievedID(){
        return $this->dishRetrievedID;
    }

    public function setRetrievedOption($dishRetrievedOption){
        $this->dishRetrievedOption = $dishRetrievedOption;
    }

    public function getRetrievedOption(){
        return $this->dishRetrievedOption;
    }

    public function setRetrievedPrice($dishRetrievedPrice){
        $this->dishRetrievedPrice = $dishRetrievedPrice;
    }

    public function getRetrievedPrice(){
        return $this->dishRetrievedPrice;
    }

    public function setDishPrice($dishPrice){
        $this->dishPrice = $dishPrice;
    }

    public function getDishPrice(){
        return $this->dishPrice;
    }
}