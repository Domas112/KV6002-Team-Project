<?php

class APIResponse
{
    private $response;

    protected function setResponse($response){
        $this->response = $response;
    }

    protected function getResponse(){
        return $this->response;
    }

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
        }
    }
}