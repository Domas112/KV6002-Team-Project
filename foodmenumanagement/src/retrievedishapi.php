<?php

/**
 * retrievedishapi.php
 * The PHP class has implemented to handle dish API calls and call appropriate function according to the request. Since
 * some of the data could be consider as sensitive data, an authentication check has been implemented in some of the
 * function to prevent any user from accessing it which means that only authorised users who have logged in to the
 * website have the ability to view the contents. However, the API will mostly be used by webpage internally to handle
 * data and it is not a function available to all user.
 *
 * @author Teck Xun Tan W20003691
 */
class RetrieveDishAPI extends APIResponse
{
    private $database;

    /**
     * Default constructor function to handle API requests
     */
    public function __construct(){
        //Start session
        session_start();

        //Initialising database class
        $this->database = new Database();

        //Check if user is using the correct request method
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            //If the user is using the correct request method, proceed with handling the API request
            if(isset($_REQUEST['retrieveAll'])){
                //If webpage request for retrieveAll, set the response to the retrieveAllDish returned array
                $this->setResponse($this->retrieveAllDish());

            }else if(isset($_REQUEST['retrieveOne'])){
                //If webpage request for retrieveOne, set the response to the retrieveOne returned array
                $this->setResponse($this->retrieveOneDish($_GET['id']));

            }else if(isset($_REQUEST['retrieveDishMenu'])){
                //If webpage request for category, set the response to the retrieveDishMenu returned array
                if(isset($_GET['category'])){
                    //If the category query is provided in the URL, call the retrieveDishMenu function with the category parameter
                    $this->setResponse($this->retrieveDishMenu($_GET['category']));

                }else{
                    //If the category query is not provided in the URL, call the retrieveDishMenu function with null parameter
                    $this->setResponse($this->retrieveDishMenu(null));

                }
            }else{
                //If did not request for anything or have typed in the incorrect request, set the response to show error 400 (Bad Request)
                $this->setResponse($this->showError(400));
            }
        }else{
            //If did not request for anything or have typed in the incorrect request, set the response to show error 405 (Method not allowed)
            $this->setResponse($this->showError(405));
        }

        //Encode the response into JSON and display it
        echo json_encode($this->getResponse());
    }

    /**
     * retrieveAllDish
     * A function used to retrieve all dish available from the database
     */
    private function retrieveAllDish(){
        //Check if user is logged in
        if(isset($_SESSION['username'])){
            try{
                //Preparing query
                $query = "SELECT dish.*, category.categoryName, image.*, COUNT(dishOption.optionID) as numberOfDishOption
                  FROM dish
                  INNER JOIN category
                  ON category.categoryID = dish.dishCategoryID
                  LEFT OUTER JOIN image
                  ON image.imageID = dish.dishImg
                  LEFT OUTER JOIN dishOption
                  ON dishOption.dishID = dish.dishID
                  GROUP BY dishID";

                //Execute the query
                $result = $this->database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);


                if(!empty($result)){
                    //Return the result if result is not empty
                    return $result;
                }else{
                    //Return error 204 (No content)
                    return $this->showError(204);
                }
            }catch(Exception $e){
                //Return error 500 (Internal Server Error) if exception has been caught
                return $this->showError(500);
            }
        }else{
            //Return error 401 (Not logged in) if user is not logged in
            return $this->showError(401);
        }

    }

    /**
     * retrieveOneDish
     * A function used to retrieve a specific dish from the database
     */
    private function retrieveOneDish($id){
        //Check if user is logged in
        if(isset($_SESSION['username'])) {
            try {
                //Preparing query and parameter
                $query = "SELECT dish.dishID, dish.dishName, dish.dishDescription, dish.dishCategoryID, dish.dishImg, dishOption.optionID, dishOption.optionName, dishOption.optionPrice
                      FROM dish
                      LEFT JOIN dishOption ON (dish.dishID = dishOption.dishID)
                      WHERE dish.dishID = :id";
                $parameter = ["id" => $id];

                //Execute the query
                $result = $this->database->executeSQL($query, $parameter)->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($result)) {
                    //Set the session variable with retrieved name, description, and category
                    $_SESSION['retrievedName'] = $result[0]['dishName'];
                    $_SESSION['retrievedDescription'] = $result[0]['dishDescription'];
                    $_SESSION['retrievedCategory'] = $result[0]['dishCategoryID'];

                    //Return the result if result is not empty
                    return $result;
                } else {
                    //Return error 204 (No content)
                    return $this->showError(204);
                }
            } catch (Exception $e) {
                //Return error 500 (Internal Server Error) if exception has been caught
                return $this->showError(500);
            }
        }else{
            //Return error 401 (Not logged in) if user is not logged in
            return $this->showError(401);
        }
    }

    /**
     * retrieveDishMenu
     * A function used to retrieve all available dish from the database (Customer side menu)
     */
    private function retrieveDishMenu($category){
        //Initialise an empty array
        $result = [];
        try {
            //Preparing query
            $query = "SELECT dish.*, category.categoryName, image.*, COUNT(dishOption.optionID) as numberOfDishOption
                      FROM dish  
                      INNER JOIN category
                      ON category.categoryID = dish.dishCategoryID
                      LEFT OUTER JOIN image
                      ON image.imageID = dish.dishImg
                      LEFT OUTER JOIN dishOption
                      ON dishOption.dishID = dish.dishID
                      WHERE dish.dishAvailability = 1 ";

            //Check if category parameter has been provided
            if ($category != null) {
                //If its provided, prepare the rest of the query and parameter
                $query .= "AND dish.dishCategoryID = :category
                           GROUP BY dishID";
                $parameter = ["category" => $category];

                //Execute the query
                $dishResult = $this->database->executeSQL($query, $parameter)->fetchAll(PDO::FETCH_ASSOC);

            } else {
                //If its not provided, prepare the rest of the query
                $query .= "GROUP BY dishID";

                //Execute the query
                $dishResult = $this->database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
            }

            //Retrieve the dishOption available for each dish item
            foreach ($dishResult as $dishItem) {
                //Preparing query and parameter
                $query = "SELECT * FROM dishOption WHERE dishID = :id ORDER BY optionPrice ASC";
                $parameter = ["id" => $dishItem['dishID']];

                //Execute the query
                $dishOptionResult = $this->database->executeSQL($query, $parameter)->fetchAll(PDO::FETCH_ASSOC);

                //Reconstructing the response
                $processedResult = [
                    "dishName" => $dishItem['dishName'],
                    "dishDescription" => $dishItem['dishDescription'],
                    "dishImageData" => $dishItem['imageData'],
                    "dishOption" => $dishOptionResult
                ];

                //Push the new response into the empty array variable
                array_push($result, $processedResult);
            }

            if (!empty($result)) {
                //Return the result if result is not empty
                return $result;
            } else {
                //Return error 204 (No content)
                return $this->showError(204);
            }
        }catch(Exception $e){
            //Return error 500 (Internal Server Error) if exception has been caught
            return $this->showError(500);
        }
    }
}