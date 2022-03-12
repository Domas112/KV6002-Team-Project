<?php
try{
    require_once('../src/database.php');

    if(isset($_REQUEST['retrieveAll'])){
        echo retrieveAllDish();
    }
    else if(isset($_REQUEST['retrieveOne'])){
        echo retrieveOneDish($_GET['id']);
    }
    else if(isset($_REQUEST['searchData'])){
        echo searchDish($_GET['search']);
    }
}
catch (Exception $e){
    throw new Exception("Error" . $e->getMessage(), 0, $e);
}

function retrieveAllDish(){
    $database = new Database();
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
        $result = $database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json; charset=UTF-8");
        return json_encode($result);
    }
    catch (Exception $e){
        return "Error: " . $e->getMessage();
    }
}

function retrieveOneDish($id){
    $database = new Database();
    try{
        $query = "SELECT dish.dishID, dish.dishName, dish.dishDescription, dish.dishCategoryID, dish.dishImg, dishOption.optionID, dishOption.optionName, dishOption.optionPrice
                  FROM dish
                  LEFT JOIN dishOption ON (dish.dishID = dishOption.dishID)
                  WHERE dish.dishID = :id";
        $parameter = ["id" => $id];
        $result = $database->executeSQL($query,$parameter)->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json; charset=UTF-8");
        return json_encode($result);
    }
    catch (Exception $e){
        return "Error: " . $e->getMessage();
    }
}

function searchDish($search){
    $database = new Database();
    try{
        $search = "%".$search."%";
        $query = "SELECT dish.*, category.categoryName, image.*, COUNT(dishOption.optionID) as numberOfDishOption 
                  FROM dish
                  INNER JOIN category
                  ON category.categoryID = dish.dishCategoryID
                  LEFT OUTER JOIN image
                  ON image.imageID = dish.dishImg
                  LEFT OUTER JOIN dishOption
                  ON dishOption.dishID = dish.dishID
                  WHERE dish.dishID LIKE :id OR dish.dishName LIKE :name
                  GROUP BY dishID";
        $parameter = ["id" => $search, "name" => $search];
        $result = $database->executeSQL($query,$parameter)->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json; charset=UTF-8");
        return json_encode($result);
    }
    catch (Exception $e){
        return "Error: " . $e->getMessage();
    }
}