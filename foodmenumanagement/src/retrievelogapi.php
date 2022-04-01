
<?php

class RetrieveLogAPI extends APIResponse
{
    private $database;

    public function __construct(){
        $this->database = new Database();
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_REQUEST['retrieveAll'])){
                $this->setResponse($this->retrieveAllLog());
//            }else if(isset($_REQUEST['searchData'])){
//                $this->setResponse($this->searchLog($_GET['search'],$_GET['sort']));
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

//    private function searchLog($search,$sort){
//        try{
//            $query = "SELECT * FROM logRecord
//                      WHERE logID LIKE :search OR userID LIKE :search
//                      ORDER BY ".$sort;
//            $parameter = ["search" => $search];
//            return $this->database->executeSQL($query,$parameter)->fetchAll(PDO::FETCH_ASSOC);
//        }
//        catch (Exception $e){
//            return "Error: " . $e->getMessage();
//        }
//    }
}