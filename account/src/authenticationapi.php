<?php

class AuthenticationAPI extends AccountDB
{
    private $response;
    public function __construct(){
        parent::__construct();
        session_start();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_REQUEST['authenticate'])){
                if(isset($_POST['username']) && isset($_POST['password'])){
                    $this->response = $this->authenticateUser($_POST['username'], $_POST['password']);
                }else{
                    $this->response = $this->setLogonError(400);
                }
            }else if(isset($_REQUEST['isLoggedIn'])){
                $this->response = $this->checkIsLoggedIn();
            }else if(isset($_REQUEST['accountType'])) {
                $this->response = $this->retrieveAccountType();
            }else if(isset($_REQUEST['logout'])){
                $this->response = $this->logout();
            }else{
                $this->response = $this->setLogonError(501);
            }
        }else{
            $this->response = $this->setLogonError(405);
        }
        echo json_encode($this->response);
    }

    public function authenticateUser($username,$password){
        $query = "SELECT password FROM account WHERE username = :username";
        $parameter = ["username" => $username];
        $result = $this->executeSQL($query,$parameter)->fetch();
        if(!empty($result)){
            if(password_verify($password, $result[0])){
                $_SESSION['username'] = $username;
                $_SESSION['accountType'] = $this->getUserAccountType($username);
                return true;
            }else{
                return $this->setLogonError(401);
            }
        }else{
            return $this->setLogonError(401);
        }
    }

    public function checkIsLoggedIn(){
        if(isset($_SESSION['username'])){
            return array("authenticated" => true);
        }else{
            return array("authenticated" => false);
        }
    }

    public function getUserAccountType($username){
        $query = "SELECT accountType FROM account WHERE username = :username";
        $parameter = ["username" => $username];
        $result = $this->executeSQL($query,$parameter)->fetch();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }

    public function retrieveAccountType(){
        return array("accountType" => $_SESSION['accountType']);
    }

    public function logout(){
        return session_destroy();
    }

    public function setLogonError($errCode){
        switch($errCode){
            case 405:
                http_response_code($errCode);
                return array("Message" => "Sorry! Method not allowed!");
            case 501:
                http_response_code($errCode);
                return array("Message" => "Sorry! Request method not found");
            case 400:
                http_response_code($errCode);
                return array("Message" => "Incorrect parameters");
            case 401:
                http_response_code($errCode);
                return array("Message" => "Not authorised!");
            case 204:
                http_response_code(204);
                break;
        }
    }
}