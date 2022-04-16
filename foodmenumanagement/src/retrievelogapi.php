<?php

/**
 * retrievelogapi.php
 * The PHP class has implemented to handle log API calls and call appropriate function according to the request. Since
 * logging could be consider as sensitive data, an authentication check has been implemented to prevent any user from
 * accessing it which means that only authorised users who have logged in to the website have the ability to view the
 * contents. However, the API will mostly be used by webpage internally to handle data and it is not a function
 * available to all user.
 *
 * @author Teck Xun Tan W20003691
 */
class RetrieveLogAPI extends APIResponse
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
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            //Check if user is logged in
            if(isset($_SESSION['username'])) {
                //If user is logged in and is using the correct request method, proceed with handling the API request
                if (isset($_REQUEST['retrieveAll'])) {
                    //If webpage request for retrieveAll, set the response to the retrieveAllLog returned array
                    $this->setResponse($this->retrieveAllLog());

                } else if (isset($_REQUEST['retrieveLogDetail'])) {
                    //If webpage request for retrieveLogDetail, set the response to the retrieveLogDetail returned array
                    $this->setResponse($this->retrieveLogDetail($_GET['id']));

                } else {
                    //If did not request for anything or have typed in the incorrect request, set the response to show error 400 (Bad Request)
                    $this->setResponse($this->showError(400));

                }
            }else {
                //If did not request for anything or have typed in the incorrect request, set the response to show error 401 (Not logged in)
                $this->setResponse($this->showError(401));
            }
        }else{
            //If did not request for anything or have typed in the incorrect request, set the response to show error 405 (Method not allowed)
            $this->showError(405);
        }

        //Encode the response into JSON and display it
        echo json_encode($this->getResponse());
    }

    /**
     * retrieveAllLog
     * A function used to retrieve all available log from the database
     */
    private function retrieveAllLog(){
        try {
            //Preparing query
            $query = "SELECT * FROM logRecord";

            //Execute the query
            $result = $this->database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($result)) {
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
    }

    /**
     * retrieveLogDetail
     * A function used to retrieve all available log details from the database
     */
    private function retrieveLogDetail($logID){
        try {
            //Preparing query and parameter
            $query = "SELECT logChanges FROM logDetail WHERE logID = :logID";
            $parameter = ["logID" => $logID];

            //Execute the query
            $result = $this->database->executeSQL($query, $parameter)->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($result)) {
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
    }
}