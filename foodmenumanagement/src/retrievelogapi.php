
<?php

class RetrieveLogAPI extends APIResponse
{
    private $database;

    public function __construct(){
        $this->database = new Database();
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_REQUEST['retrieveAll'])){
                $this->setResponse($this->retrieveAllLog());
            }else if(isset($_REQUEST['retrieveLogDetail'])){
                $this->setResponse($this->retrieveLogDetail($_GET['id']));
            }else{
                $this->setResponse($this->showError(400));
            }
        }else{
            $this->setResponse($this->showError(405));
        }
        echo json_encode($this->getResponse());
    }

    private function retrieveAllLog(){
        try{
            $query = "SELECT * FROM logRecord";
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

    private function retrieveLogDetail($logID){
        try{
            $query = "SELECT logChanges FROM logDetail WHERE logID = :logID";
            $parameter = ["logID" => $logID];
            $result = $this->database->executeSQL($query,$parameter)->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
                return $result;
            }else{
                return $this->showError(204);
            }
        }catch(Exception $e){
            return $this->showError(500);
        }
    }
}