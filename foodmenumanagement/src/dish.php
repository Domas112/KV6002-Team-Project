<?php

/**
 * dish.php
 * The class is used for handling dish object using setter and getter methods
 *
 * @author Teck Xun Tan W20003691
 */
class Dish
{
    private $dishID, $dishName, $dishDescription, $dishCategory, $dishImg, $dishAvailability, $dishOption, $dishRetrievedID, $dishRetrievedOption, $dishRetrievedPrice, $dishPrice;

    /**
     * Default constructor to preset some of the variable of the object.
     */
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

    /**
     * setDishID
     * A setter function for setting the dishID variable
     */
    public function setDishID($dishID){
        $this->dishID = $dishID;
    }

    /**
     * getDishID
     * A getter function for retrieving the dishID variable
     */
    public function getDishID(){
        return $this->dishID;
    }

    /**
     * setDishName
     * A setter function for setting dishName variable
     */
    public function setDishName($dishName){
        $this->dishName = $dishName;
    }

    /**
     * getDishName
     * A getter function for retrieving dishName variable
     */
    public function getDishName(){
        return $this->dishName;
    }

    /**
     * setDishDescription
     * A setter function for setting dishDescription variable
     */
    public function setDishDescription($dishDescription){
        $this->dishDescription = $dishDescription;
    }

    /**
     * getDishDescription
     * A getter function for retrieving dishDescription variable
     */
    public function getDishDescription(){
        return $this->dishDescription;
    }

    /**
     * setDishCategory
     * A setter function for setting dishCategory variable
     */
    public function setDishCategory($dishCategory){
        $this->dishCategory = $dishCategory;
    }

    /**
     * getDishCategory
     * A getter function for retrieving dishCategory variable
     */
    public function getDishCategory(){
        return $this->dishCategory;
    }

    /**
     * setDishImg
     * A setter function for setting dishImg variable
     */
    public function setDishImg($dishImg){
        $this->dishImg = $dishImg;
    }

    /**
     * getDishImg
     * A getter function for retrieving dishImg variable
     */
    public function getDishImg(){
        return $this->dishImg;
    }

    /**
     * setDishAvailability
     * A setter function for setting dishAvailability variable
     */
    public function setDishAvailability($dishAvailability){
        $this->dishAvailability = $dishAvailability;
    }

    /**
     * getDishAvailability
     * A getter function for retrieving dishAvailability variable
     */
    public function getDishAvailability(){
        return $this->dishAvailability;
    }

    /**
     * setDishOption
     * A setter function for setting dishOption variable
     */
    public function setDishOption($dishOption){
        $this->dishOption = $dishOption;
    }

    /**
     * getDishOption
     * A getter function for retrieving dishOption variable
     */
    public function getDishOption(){
        return $this->dishOption;
    }

    /**
     * setDishPrice
     * A setter function for setting dishPrice variable
     */
    public function setDishPrice($dishPrice){
        $this->dishPrice = $dishPrice;
    }

    /**
     * getDishPrice
     * A getter function for retrieving dishPrice variable
     */
    public function getDishPrice(){
        return $this->dishPrice;
    }

    /**
     * setRetrievedID
     * A setter function for setting dishRetrievedID variable
     * (dishRetrievedID is the option ID retrieved from database)
     */
    public function setRetrievedID($dishRetrievedID){
        $this->dishRetrievedID = $dishRetrievedID;
    }

    /**
     * getRetrievedID
     * A getter function for retrieving dishRetrievedID variable
     */
    public function getRetrievedID(){
        return $this->dishRetrievedID;
    }

    /**
     * setRetrievedOption
     * A setter function for setting dishRetrievedOption variable
     * (dishRetrievedOption is the option name retrieved from database)
     */
    public function setRetrievedOption($dishRetrievedOption){
        $this->dishRetrievedOption = $dishRetrievedOption;
    }

    /**
     * getRetrievedOption
     * A getter function for retrieving dishRetrievedOption variable
     */
    public function getRetrievedOption(){
        return $this->dishRetrievedOption;
    }

    /**
     * setRetrievedPrice
     * A setter function for setting dishRetrievedPrice variable
     * (dishRetrievedPrice is the option price retrieved from database)
     */
    public function setRetrievedPrice($dishRetrievedPrice){
        $this->dishRetrievedPrice = $dishRetrievedPrice;
    }

    /**
     * getRetrievedPrice
     * A getter function for retrieving dishRetrievedPrice variable
     */
    public function getRetrievedPrice(){
        return $this->dishRetrievedPrice;
    }
}