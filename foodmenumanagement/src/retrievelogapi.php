
<?php

class RetrieveLogAPI extends APIResponse
{
    private $database;

    public function __construct(){
        $this->database = new Database();
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_REQUEST['retrieveAll'])){
                $this->setResponse($this->retrieveAllLog());
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
            return $this->database->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e){
            return "Error: " . $e->getMessage();
        }
    }

    private function retrieveLogDetail($logID){

    }
}