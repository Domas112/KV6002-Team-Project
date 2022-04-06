<?php

class ErrorUIController extends ErrorUIElement
{
    private $errorCode, $errorTitle, $errorMessage;

    public function __construct($errorCode){
        $this->setErrorCode($errorCode);
        $this->setError($errorCode);

        echo $this->generateHeader("Error {$errorCode}");
        echo $this->generateLogo();
        echo $this->generateNavigation();
        $this->generateErrorPage();
    }

    private function setErrorCode($errorCode){
        $this->errorCode = $errorCode;
    }

    private function getErrorCode(){
        return $this->errorCode;
    }

    private function getErrorTitle(){
        return $this->errorTitle;
    }

    private function setError($errorCode){
        switch($errorCode){
            case 404:
                $this->errorTitle = "Webpage Not Found!";
                $this->errorMessage = "Well looks like the URL you requested does not exist. Please try again :(";
                break;
            case 401:
                $this->errorTitle = "Login Error!";
                $this->errorMessage = "Opps! Looks like you forgot to login. Please login before accessing this page :)";
                break;
            case 403:
                $this->errorTitle = "Unauthorised Accessed!";
                $this->errorMessage = "Opps! Unfortunately you are not authorised to access this feature :(";
                break;
            case '':
            default:
                $this->errorTitle = "General Error!";
                $this->errorMessage = "Oh no! Something went wrong! Please try again later :(";
        }
    }

    private function generateErrorPage(){
        $errorPage = $this->generateDiv(array(
            $this->generateTitle("Error {$this->getErrorCode()}: {$this->getErrorTitle()}"),
            $this->generateHorizontalLine(),
            $this->generateErrorMessage($this->errorMessage)
        ),"container-fluid");
        echo $errorPage;
    }
}