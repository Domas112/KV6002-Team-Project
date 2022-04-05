<?php

class RetrieveDishAPI extends APIResponse
{
    private $database;

    public function __construct(){
        $this->database = new Database();
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_REQUEST['retrieveAll'])){
                $this->setResponse($this->retrieveAllDish());
            }else if(isset($_REQUEST['retrieveOne'])){
                $this->setResponse($this->retrieveOneDish($_GET['id']));
            }else{
                $this->setResponse($this->showError(400));
            }
        }else{
            $this->setResponse($this->showError(405));
        }
        echo json_encode($this->getResponse());
    }

    private function retrieveAllDish(){
        try{
            $query = "SELECT dish.*, category.categoryName, image.*, COUNT(dishOption.optionID) as numberOfDishOption
                      FROM dish
                      INNER JOIN category
                      ON category.categoryID = dish.dishCategoryID
                      LEFT OUTER JOIN image
                      ON image.imageID = dish.dishImg
                      LEFT OUTER JOIN dishOption
                      ON dishOption.dishID = dish.dishID
                      GROUP BY dishID";
            return $this->database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e){
            return "Error: " . $e->getMessage();
        }
    }

    private function retrieveOneDish($id){
        try{
            $query = "SELECT dish.dishID, dish.dishName, dish.dishDescription, dish.dishCategoryID, dish.dishImg, dishOption.optionID, dishOption.optionName, dishOption.optionPrice
                      FROM dish
                      LEFT JOIN dishOption ON (dish.dishID = dishOption.dishID)
                      WHERE dish.dishID = :id";
            $parameter = ["id" => $id];
            return $this->database->executeSQL($query,$parameter)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e){
            return "Error: " . $e->getMessage();
        }
    }
}