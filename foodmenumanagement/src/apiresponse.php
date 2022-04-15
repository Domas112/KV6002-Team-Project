<?php

/**
 * apiresponse.php
 *
 * The class will be used to set appropriate API response or set error that will be send back
 * to the webpage.
 *
 * @author Teck Xun Tan W20003691
 */

class APIResponse
{
    private $response;

    /**
     * setResponse
     *
     * The setter method to set the response of the API
     *
     * @visibility protected
     * @param array $response The response of the API
     */
    protected function setResponse($response){
        $this->response = $response;
    }

    /**
     * getResponse
     *
     * The getter method to retrieve the set response
     *
     * @visibility protected
     * @return array The response of the API
     */
    protected function getResponse(){
        return $this->response;
    }

    /**
     * showError
     *
     * To set the response into error if the following error has occurred
     *
     * @visibility protected
     * @param int $errorCode The error code
     * @return string[]|null The error response
     */
    protected function showError($errorCode){
        switch($errorCode){
            case 405:
                http_response_code($errorCode);
                return array("Message" => "Sorry! Method not allowed!");
            case 501:
                http_response_code($errorCode);
                return array("Message" => "Sorry! Request method not found");
            case 400:
                http_response_code($errorCode);
                return array("Message" => "Incorrect parameters");
            case 401:
                http_response_code($errorCode);
                return array("Message" => "Not authorised!");
            case 204:
                http_response_code($errorCode);
                break;
            case 500:
                http_response_code($errorCode);
                return array("Message" => "Internal Server Error!");
        }
    }
}