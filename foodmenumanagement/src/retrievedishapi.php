<?php

class RetrieveDishAPI extends APIResponse
{
    private $database;

    public function __construct(){
        session_start();
        $this->database = new Database();
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_REQUEST['retrieveAll'])){
                $this->setResponse($this->retrieveAllDish());
            }else if(isset($_REQUEST['retrieveOne'])){
                $this->setResponse($this->retrieveOneDish($_GET['id']));
            }else if(isset($_REQUEST['retrieveDishMenu'])){
                if(isset($_GET['category'])){
                    $this->setResponse($this->retrieveDishMenu($_GET['category']));
                }else{
                    $this->setResponse($this->retrieveDishMenu(null));
                }
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
            $result = $this->database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
                return $result;
            }else{
                return $this->showError(204);
            }
        }catch(Exception $e){
            return $this->showError(500);
        }
    }

    private function retrieveOneDish($id){
        try{
            $query = "SELECT dish.dishID, dish.dishName, dish.dishDescription, dish.dishCategoryID, dish.dishImg, dishOption.optionID, dishOption.optionName, dishOption.optionPrice
                      FROM dish
                      LEFT JOIN dishOption ON (dish.dishID = dishOption.dishID)
                      WHERE dish.dishID = :id";
            $parameter = ["id" => $id];
            $result = $this->database->executeSQL($query,$parameter)->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
                $_SESSION['retrievedName'] = $result[0]['dishName'];
                $_SESSION['retrievedDescription'] = $result[0]['dishDescription'];
                $_SESSION['retrievedCategory'] = $result[0]['dishCategoryID'];
                return $result;
            }else{
                return $this->showError(204);
            }
        }catch(Exception $e){
            return $this->showError(500);
        }
    }

    private function retrieveDishMenu($category){
        $result = [];
        try {
            $query = "SELECT dish.*, category.categoryName, image.*, COUNT(dishOption.optionID) as numberOfDishOption
                      FROM dish  
                      INNER JOIN category
                      ON category.categoryID = dish.dishCategoryID
                      LEFT OUTER JOIN image
                      ON image.imageID = dish.dishImg
                      LEFT OUTER JOIN dishOption
                      ON dishOption.dishID = dish.dishID
                      WHERE dish.dishAvailability = 1 ";
            if ($category != null) {
                $query .= "AND dish.dishCategoryID = :category
                           GROUP BY dishID";
                $parameter = ["category" => $category];
                $dishResult = $this->database->executeSQL($query, $parameter)->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $query .= "GROUP BY dishID";
                $dishResult = $this->database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
            }

            foreach ($dishResult as $dishItem) {
                $query = "SELECT * FROM dishOption WHERE dishID = :id ORDER BY optionPrice ASC";
                $parameter = ["id" => $dishItem['dishID']];
                $dishOptionResult = $this->database->executeSQL($query, $parameter)->fetchAll(PDO::FETCH_ASSOC);
                $processedResult = [
                    "dishName" => $dishItem['dishName'],
                    "dishDescription" => $dishItem['dishDescription'],
                    "dishImageData" => $dishItem['imageData'],
                    "dishOption" => $dishOptionResult
                ];
                array_push($result, $processedResult);
            }

            if (!empty($result)) {
                return $result;
            } else {
                return $this->showError(204);
            }
        }catch(Exception $e){
            return $this->showError(500);
        }
    }
}