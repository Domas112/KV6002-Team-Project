<?php

/**
 * apiresponse.php
 * The class will be used to set appropriate API response or set error that will be send back to the webpage.
 *
 * @author Teck Xun Tan W20003691
 */

class APIResponse
{
    private $response;

    /**
     * setResponse
     * The setter method to set the response of the API
     */
    protected function setResponse($response){
        //Set the response
        $this->response = $response;
    }

    /**
     * getResponse
     * The getter method to retrieve the set response
     */
    protected function getResponse(){
        //Return the response
        return $this->response;
    }

    /**
     * showError
     * To set the response into error if the following error has occurred
     */
    protected function showError($errorCode){
        //Set the response code and return appropriate error message
        switch($errorCode){
            //No Content error
            case 204:
                http_response_code($errorCode);
                return null;

            //Incorrect Parameter error
            case 400:
                http_response_code($errorCode);
                return array("Message" => "Incorrect parameters");

            //Not Authorised error
            case 401:
                http_response_code($errorCode);
                return array("Message" => "Not authorised!");

            //Method not Allowed error
            case 405:
                http_response_code($errorCode);
                return array("Message" => "Sorry! Method not allowed!");

            //Internal Server error
            case 500:
                http_response_code($errorCode);
                return array("Message" => "Internal Server Error!");

            //Request Method Not Available error
            case 501:
                http_response_code($errorCode);
                return array("Message" => "Sorry! Request method not found");
        }
    }
}